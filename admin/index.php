<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/ContentModel.php';
require_once __DIR__ . '/../models/Blog.php';
require_once __DIR__ . '/../models/BlogCategory.php';
require_once __DIR__ . '/../models/UserModel.php';

session_start();

// Initialize models early so they are available for request handling logic
$content = new ContentModel();
$blogModel = new Blog();
$categoryModel = new BlogCategory();
$userModel = new UserModel();

$loggedIn = $_SESSION['admin_logged_in'] ?? false;
$module = $_GET['module'] ?? 'dashboard';

if ($loggedIn) {
    $allowedAuthorModules = ['dashboard', 'blogs', 'profile', 'change_password'];
    if (is_role('author') && !in_array($module, $allowedAuthorModules, true)) {
        redirect('/admin/index.php?module=dashboard');
    }
    if (is_role('admin') && in_array($module, ['settings', 'audit_logs', 'translations'], true)) {
        redirect('/admin/index.php?module=dashboard');
    }
}

if (is_post()) {
    verify_csrf();
    
    // Login Handling
    if (($_POST['action'] ?? '') === 'login') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $user = $userModel->findByEmail($email);
        
        if ($user && $user['status'] === 'active' && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['name'];
            
            $userModel->updateLastLogin((int)$user['id']);
            $userModel->logAudit((int)$user['id'], 'User Login', $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
            redirect('/admin/index.php');
        }
        flash('admin_error', 'Invalid login credentials or inactive account.');
        redirect('/admin/index.php');
    }
    
    // Logout Handling
    if (($_POST['action'] ?? '') === 'logout') {
        if (isset($_SESSION['user_id'])) {
            $userModel->logAudit((int)$_SESSION['user_id'], 'User Logout', $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
        }
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_name']);
        session_destroy();
        session_start();
        redirect('/admin/index.php');
    }

    // Blog CRUD (Role and Ownership Aware)
    if ($loggedIn && (($_POST['action'] ?? '') === 'create_blog' || ($_POST['action'] ?? '') === 'update_blog')) {
        $isEdit = $_POST['action'] === 'update_blog';
        $id = (int)($_POST['id'] ?? 0);
        
        $existing = null;
        if ($isEdit) {
            $existing = $blogModel->find($id);
            if (!$existing) {
                flash('admin_error', 'Blog not found.');
                redirect('/admin/index.php?module=blogs');
            }
            // Authors can only edit their own blogs
            if (is_role('author') && (int)$existing['author_id'] !== (int)$_SESSION['user_id']) {
                http_response_code(403);
                exit('Unauthorized access: You do not own this blog post.');
            }
        }

        $blogData = [
            'title' => trim($_POST['title'] ?? ''),
            'category_id' => (int) ($_POST['category_id'] ?? 0),
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'en_title' => trim($_POST['en_title'] ?? ''),
            'content' => $_POST['content'] ?? '',
            'author' => trim($_POST['author'] ?? $_SESSION['user_name']),
            'seo_title' => trim($_POST['seo_title'] ?? ''),
            'meta_description' => trim($_POST['meta_description'] ?? ''),
            'meta_keywords' => trim($_POST['meta_keywords'] ?? ''),
            'canonical_url' => trim($_POST['canonical_url'] ?? ''),
        ];

        $errors = [];
        if (empty($blogData['title'])) $errors[] = 'Title is required.';
        if (empty($blogData['content'])) $errors[] = 'Content is required.';
        if ($blogData['category_id'] <= 0) $errors[] = 'Category is required.';
        if (empty($blogData['en_title'])) $errors[] = 'English title is required.';
        if ($isEdit && $id <= 0) $errors[] = 'Invalid blog ID.';

        if (empty($errors)) {
            $blogData['title'] = htmlspecialchars($blogData['title']);
            $blogData['en_title'] = htmlspecialchars($blogData['en_title']);
            $blogData['excerpt'] = htmlspecialchars($blogData['excerpt']);
            $blogData['author'] = htmlspecialchars($blogData['author']);
            
            // Generate or manually set slug
            $slugInput = trim($_POST['slug'] ?? '');
            if (!empty($slugInput)) {
                $blogData['slug'] = $blogModel->normalizeSlug($slugInput, $isEdit ? $id : null);
            } else {
                $blogData['slug'] = $blogModel->normalizeSlug($blogData['en_title'], $isEdit ? $id : null);
            }

            // Role limitations on status
            if (is_role('author')) {
                // Authors can only choose draft or pending review
                $statusInput = $_POST['status'] ?? 'draft';
                if (!in_array($statusInput, ['draft', 'pending'], true)) {
                    $statusInput = 'draft';
                }
                $blogData['status'] = $statusInput;
                $blogData['author_id'] = (int)$_SESSION['user_id'];
                
                // Author editing a published post moves it back to draft/pending
                if ($isEdit && $existing['status'] === 'published') {
                    $blogData['published_at'] = null;
                } elseif ($isEdit) {
                    $blogData['published_at'] = $existing['published_at'];
                } else {
                    $blogData['published_at'] = null;
                }
            } else {
                // Admins and Super Admins can set any status and publishing dates
                $blogData['status'] = $_POST['status'] ?? 'published';
                $blogData['published_at'] = ($blogData['status'] === 'published') ? ($_POST['published_at'] ?: date('Y-m-d H:i:s')) : null;
                if ($isEdit) {
                    $blogData['author_id'] = $existing['author_id'] ?: (int)$_SESSION['user_id'];
                } else {
                    $blogData['author_id'] = (int)$_SESSION['user_id'];
                }
            }

            if ($isEdit) {
                $blogData['updated_by'] = (int)$_SESSION['user_id'];
            } else {
                $blogData['created_by'] = (int)$_SESSION['user_id'];
                $blogData['updated_by'] = (int)$_SESSION['user_id'];
            }

            // File uploading for banner image & featured image
            $bannerPath = $_POST['existing_banner'] ?? '';
            if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] === UPLOAD_ERR_OK) {
                $errorUpload = '';
                $uploaded = upload_file($_FILES['banner_image'], $errorUpload, 'blogs');
                if ($uploaded) {
                    $bannerPath = $uploaded;
                } else {
                    flash('admin_error', 'Banner upload failed: ' . $errorUpload);
                }
            }
            $blogData['banner_image'] = $bannerPath;
            $blogData['featured_image'] = $bannerPath;
            $blogData['og_image'] = $bannerPath;

            // Optional explicit OG Image
            if (isset($_FILES['og_image_file']) && $_FILES['og_image_file']['error'] === UPLOAD_ERR_OK) {
                $errorUpload = '';
                $uploaded = upload_file($_FILES['og_image_file'], $errorUpload, 'seo');
                if ($uploaded) {
                    $blogData['og_image'] = $uploaded;
                }
            }

            try {
                if ($isEdit) {
                    $blogModel->update($id, $blogData);
                    $userModel->logAudit((int)$_SESSION['user_id'], 'Blog Updated: ' . $id, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                    
                    // Trigger notification if submitted for review
                    if ($blogData['status'] === 'pending' && $existing['status'] !== 'pending') {
                        $admins = $userModel->all();
                        foreach ($admins as $adm) {
                            if (in_array($adm['role'], ['super_admin', 'admin'], true)) {
                                $userModel->addNotification((int)$adm['id'], 'Blog Submission', 'Blog "' . $blogData['title'] . '" was submitted by author ' . $_SESSION['user_name'] . ' for review.');
                            }
                        }
                    }
                    flash('admin_success', 'Blog updated successfully.');
                } else {
                    $newBlogId = $blogModel->create($blogData);
                    $userModel->logAudit((int)$_SESSION['user_id'], 'Blog Created: ' . $newBlogId, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                    
                    if ($blogData['status'] === 'pending') {
                        $admins = $userModel->all();
                        foreach ($admins as $adm) {
                            if (in_array($adm['role'], ['super_admin', 'admin'], true)) {
                                $userModel->addNotification((int)$adm['id'], 'Blog Submission', 'Blog "' . $blogData['title'] . '" was submitted by author ' . $_SESSION['user_name'] . ' for review.');
                            }
                        }
                    }
                    flash('admin_success', 'Blog created successfully.');
                }
            } catch (Throwable $e) {
                flash('admin_error', 'Database error: ' . $e->getMessage());
            }
            redirect('/admin/index.php?module=blogs');
        } else {
            flash('admin_error', implode(' ', $errors));
        }
    }

    // Blog Deletion (Role and Ownership Aware)
    if ($loggedIn && ($_POST['action'] ?? '') === 'delete_blog') {
        $id = (int)($_POST['id'] ?? 0);
        $existing = $blogModel->find($id);
        if ($existing) {
            if (is_role('author')) {
                if ((int)$existing['author_id'] !== (int)$_SESSION['user_id']) {
                    http_response_code(403);
                    exit('Unauthorized access: You do not own this blog post.');
                }
                if ($existing['status'] === 'published') {
                    flash('admin_error', 'Authors cannot delete published blog posts.');
                    redirect('/admin/index.php?module=blogs');
                }
            }
            try {
                $blogModel->delete($id);
                $userModel->logAudit((int)$_SESSION['user_id'], 'Blog Deleted: ' . $id, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                flash('admin_success', 'Blog deleted successfully.');
            } catch (Throwable $e) {
                flash('admin_error', 'Delete failed: ' . $e->getMessage());
            }
        }
        redirect('/admin/index.php?module=blogs');
    }


    if ($loggedIn && (($_POST['action'] ?? '') === 'create_timeline' || ($_POST['action'] ?? '') === 'update_timeline')) {
        $isEdit = $_POST['action'] === 'update_timeline';
        $id = (int)($_POST['id'] ?? 0);
        $data = [
            'year' => trim($_POST['year'] ?? ''),
            'title' => trim($_POST['title'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
        ];

        if (empty($data['year']) || empty($data['title'])) {
            flash('admin_error', 'Year and Title are required.');
        } else {
            try {
                if ($isEdit) {
                    $content->updateTimeline($id, $data);
                    flash('admin_success', 'Timeline updated.');
                } else {
                    $content->createTimeline($data);
                    flash('admin_success', 'Timeline added.');
                }
            } catch (Throwable $e) {
                flash('admin_error', 'Timeline error: ' . $e->getMessage());
            }
            redirect('/admin/index.php?module=timeline');
        }
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'delete_timeline') {
        $id = (int)($_POST['id'] ?? 0);
        try {
            $content->deleteTimeline($id);
            flash('admin_success', 'Timeline entry deleted.');
        } catch (Throwable $e) {
            flash('admin_error', 'Delete failed: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=timeline');
    }

    if ($loggedIn && (($_POST['action'] ?? '') === 'create_campaign' || ($_POST['action'] ?? '') === 'update_campaign')) {
        $isEdit = $_POST['action'] === 'update_campaign';
        $id = (int)($_POST['id'] ?? 0);
        $campaignData = [
            'title' => trim($_POST['title'] ?? ''),
            'en_title' => trim($_POST['en_title'] ?? ''),
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
            'goal_amount' => (float)($_POST['goal_amount'] ?? 0),
            'raised_amount' => (float)($_POST['raised_amount'] ?? 0),
            'status' => $_POST['status'] ?? 'active',
        ];

        if (empty($campaignData['title'])) {
            flash('admin_error', 'Title is required.');
        } else {
            $campaignData['slug'] = $content->normalizeCampaignSlug($campaignData['en_title'], $isEdit ? $id : null);
            $imagePath = $_POST['existing_image'] ?? '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $errorUpload = '';
                $uploaded = upload_file($_FILES['image'], $errorUpload);
                if ($uploaded) {
                    $imagePath = $uploaded;
                } else {
                    flash('admin_error', 'Image upload failed: ' . $errorUpload);
                }
            }
            $campaignData['image'] = $imagePath;

            try {
                if ($isEdit) {
                    $content->updateCampaign($id, $campaignData);
                    flash('admin_success', 'Campaign updated successfully.');
                } else {
                    $content->createCampaign($campaignData);
                    flash('admin_success', 'Campaign created successfully.');
                }
            } catch (Throwable $e) {
                flash('admin_error', 'Campaign error: ' . $e->getMessage());
            }
            redirect('/admin/index.php?module=campaigns');
        }
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'delete_campaign') {
        $id = (int)($_POST['id'] ?? 0);
        try {
            $content->deleteCampaign($id);
            flash('admin_success', 'Campaign deleted.');
        } catch (Throwable $e) {
            flash('admin_error', 'Delete failed: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=campaigns');
    }

    if ($loggedIn && (($_POST['action'] ?? '') === 'create_page' || ($_POST['action'] ?? '') === 'update_page')) {
        $isEdit = $_POST['action'] === 'update_page';
        $id = (int)($_POST['id'] ?? 0);
        $pageData = [
            'title' => trim($_POST['title'] ?? ''),
            'content' => $_POST['content'] ?? '',
            'meta_title' => trim($_POST['meta_title'] ?? ''),
            'meta_description' => trim($_POST['meta_description'] ?? ''),
            'language_code' => $_POST['language_code'] ?? 'en',
        ];

        if (empty($pageData['title'])) {
            flash('admin_error', 'Title is required.');
        } else {
            $pageData['slug'] = $content->normalizePageSlug($pageData['title'], $isEdit ? $id : null);
            try {
                if ($isEdit) {
                    $content->updatePage($id, $pageData);
                    flash('admin_success', 'Page updated successfully.');
                } else {
                    $content->createPage($pageData);
                    flash('admin_success', 'Page created successfully.');
                }
            } catch (Throwable $e) {
                flash('admin_error', 'Page CMS error: ' . $e->getMessage());
            }
            redirect('/admin/index.php?module=pages');
        }
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'delete_page') {
        $id = (int)($_POST['id'] ?? 0);
        try {
            $content->deletePage($id);
            flash('admin_success', 'Page deleted.');
        } catch (Throwable $e) {
            flash('admin_error', 'Delete failed: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=pages');
    }

    if ($loggedIn && (($_POST['action'] ?? '') === 'create_event' || ($_POST['action'] ?? '') === 'update_event')) {
        $isEdit = $_POST['action'] === 'update_event';
        $id = (int)($_POST['id'] ?? 0);
        $eventData = [
            'title' => trim($_POST['title'] ?? ''),
            'event_date' => $_POST['event_date'] ?? date('Y-m-d'),
            'location' => trim($_POST['location'] ?? ''),
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
            'status' => $_POST['status'] ?? 'upcoming',
        ];
        $eventData['slug'] = $content->normalizeEventSlug($eventData['title'], $isEdit ? $id : null);
        $imagePath = $_POST['existing_image'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $errorUpload = '';
            $uploaded = upload_file($_FILES['image'], $errorUpload);
            if ($uploaded) {
                $imagePath = $uploaded;
            } else {
                flash('admin_error', 'Event image failed: ' . $errorUpload);
            }
        }
        $eventData['image'] = $imagePath;

        try {
            if ($isEdit) { $content->updateEvent($id, $eventData); flash('admin_success', 'Event updated.'); }
            else { $content->createEvent($eventData); flash('admin_success', 'Event created.'); }
        } catch (Throwable $e) {
            flash('admin_error', 'Event error: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=events');
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'delete_event') {
        $id = (int)($_POST['id'] ?? 0);
        try {
            $content->deleteEvent($id);
            flash('admin_success', 'Event deleted.');
        } catch (Throwable $e) {
            flash('admin_error', 'Delete failed: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=events');
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'create_gallery') {
        if (!empty($_FILES['images']['name'][0])) {
            $successCount = 0;
            $errors = [];
            $title = trim($_POST['title'] ?? '');

            foreach ($_FILES['images']['name'] as $i => $name) {
                $file = [
                    'name'     => $_FILES['images']['name'][$i],
                    'type'     => $_FILES['images']['type'][$i],
                    'tmp_name' => $_FILES['images']['tmp_name'][$i],
                    'error'    => $_FILES['images']['error'][$i],
                    'size'     => $_FILES['images']['size'][$i],
                ];

                $errorUpload = '';
                $uploaded = upload_file($file, $errorUpload);
                if ($uploaded) {
                    try {
                        $content->createGallery(['title' => $title, 'image' => $uploaded]);
                        $successCount++;
                    } catch (Throwable $e) {
                        $errors[] = "Error saving $name: " . $e->getMessage();
                    }
                } else {
                    $errors[] = "Upload failed for $name: $errorUpload";
                }
            }

            if ($successCount > 0) flash('admin_success', "$successCount images successfully added to Gallery Bank.");
            if (!empty($errors)) flash('admin_error', implode(' ', $errors));
        } else {
            flash('admin_error', 'Please select one or more valid image files.');
        }
        redirect('/admin/index.php?module=gallery');
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'update_donation_status') {
        $id = (int)($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? 'pending';
        try {
            $content->updateDonationStatus($id, $status);
            flash('admin_success', 'Donation status updated.');
        } catch (Throwable $e) {
            flash('admin_error', 'Update failed: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=donations');
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'update_donation_settings') {
        $data = [
            'org_name' => trim($_POST['org_name'] ?? ''),
            'account_name' => trim($_POST['account_name'] ?? ''),
            'bank_name' => trim($_POST['bank_name'] ?? ''),
            'account_number' => trim($_POST['account_number'] ?? ''),
            'ifsc' => trim($_POST['ifsc'] ?? ''),
            'upi_id' => trim($_POST['upi_id'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'thank_you_msg' => trim($_POST['thank_you_msg'] ?? ''),
        ];

        $qrPath = $_POST['existing_qr'] ?? '';
        if (isset($_FILES['qr_code']) && $_FILES['qr_code']['error'] === UPLOAD_ERR_OK) {
            $errorUpload = '';
            $uploaded = upload_file($_FILES['qr_code'], $errorUpload);
            if ($uploaded) {
                $qrPath = $uploaded;
            } else {
                flash('admin_error', 'QR upload failed: ' . $errorUpload);
            }
        }
        $data['qr_code'] = $qrPath;

        try {
            $content->updateDonationSettings($data);
            flash('admin_success', 'Donation settings updated.');
        } catch (Throwable $e) {
            flash('admin_error', 'Update failed: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=donation_settings');
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'update_settings') {
        if (!is_role('super_admin')) {
            http_response_code(403);
            exit('Unauthorized access.');
        }

        $data = [
            'site_tagline' => trim($_POST['site_tagline'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'facebook' => trim($_POST['facebook'] ?? ''),
            'instagram' => trim($_POST['instagram'] ?? ''),
            'linkedin' => trim($_POST['linkedin'] ?? ''),
            'youtube' => trim($_POST['youtube'] ?? ''),
            'footer_text' => trim($_POST['footer_text'] ?? ''),
        ];

        $logoPath = $_POST['existing_logo'] ?? '';
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $errorUpload = '';
            $uploaded = upload_file($_FILES['logo'], $errorUpload, 'logo');
            if ($uploaded) {
                $logoPath = $uploaded;
            } else {
                flash('admin_error', 'Logo upload failed: ' . $errorUpload);
            }
        }
        $data['logo'] = $logoPath;

        try {
            $content->updateSettings($data);
            flash('admin_success', 'Website settings updated successfully.');
        } catch (Throwable $e) {
            flash('admin_error', 'Update failed: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=settings');
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'generate_sitemap') {
        if (!is_role('super_admin')) {
            http_response_code(403);
            exit('Unauthorized access.');
        }

        try {
            $urls = [
                '',
                '/about',
                '/campaigns',
                '/events',
                '/portfolio',
                '/contact',
                '/volunteer',
                '/donation',
                '/blog'
            ];

            // Fetch published blogs
            $blogs = $blogModel->allPublished(200);
            foreach ($blogs as $b) {
                $urls[] = '/blog/' . $b['slug'];
            }

            // Fetch campaigns
            $campaigns = $content->all('campaigns');
            foreach ($campaigns as $c) {
                $urls[] = '/campaigns/' . $c['slug'];
            }

            // Fetch events
            $events = $content->all('events');
            foreach ($events as $e) {
                $urls[] = '/events/' . $e['slug'];
            }

            // Fetch custom pages
            $pages = $content->allPages();
            foreach ($pages as $p) {
                $urls[] = '/' . $p['slug'];
            }

            // Build dynamic XML
            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
            foreach ($urls as $url) {
                $absolute = base_url($url);
                $xml .= '  <url>' . PHP_EOL;
                $xml .= '    <loc>' . htmlspecialchars($absolute, ENT_XML1) . '</loc>' . PHP_EOL;
                $xml .= '    <changefreq>weekly</changefreq>' . PHP_EOL;
                $xml .= '    <priority>' . ($url === '' ? '1.0' : '0.8') . '</priority>' . PHP_EOL;
                $xml .= '  </url>' . PHP_EOL;
            }
            $xml .= '</urlset>' . PHP_EOL;

            // Write to the root directory
            $sitemapFile = __DIR__ . '/../sitemap.xml';
            if (file_put_contents($sitemapFile, $xml) !== false) {
                flash('admin_success', 'sitemap.xml generated successfully at ' . date('Y-m-d H:i:s'));
            } else {
                flash('admin_error', 'Failed to write sitemap.xml to root folder. Please check file permissions.');
            }
        } catch (Throwable $e) {
            flash('admin_error', 'Sitemap generation failed: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=settings');
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'create_newspaper') {
        if (!empty($_FILES['images']['name'][0])) {
            $successCount = 0;
            $errors = [];
            $title = trim($_POST['title'] ?? '');

            foreach ($_FILES['images']['name'] as $i => $name) {
                $file = [
                    'name'     => $_FILES['images']['name'][$i],
                    'type'     => $_FILES['images']['type'][$i],
                    'tmp_name' => $_FILES['images']['tmp_name'][$i],
                    'error'    => $_FILES['images']['error'][$i],
                    'size'     => $_FILES['images']['size'][$i],
                ];

                $errorUpload = '';
                $uploaded = upload_file($file, $errorUpload, 'newspaper');
                if ($uploaded) {
                    try {
                        $content->createNewspaperCutting(['title' => $title, 'image' => $uploaded]);
                        $successCount++;
                    } catch (Throwable $e) {
                        $errors[] = "Error saving $name: " . $e->getMessage();
                    }
                } else {
                    $errors[] = "Upload failed for $name: $errorUpload";
                }
            }

            if ($successCount > 0) flash('admin_success', "$successCount newspaper cuttings added.");
            if (!empty($errors)) flash('admin_error', implode(' ', $errors));
        } else {
            flash('admin_error', 'Please select one or more valid files.');
        }
        redirect('/admin/index.php?module=newspaper');
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'delete_newspaper') {
        $id = (int)($_POST['id'] ?? 0);
        $item = $content->findNewspaperCutting($id);
        if ($item) {
            @unlink(__DIR__ . '/../' . $item['image']);
            try {
                $content->deleteNewspaperCutting($id);
                flash('admin_success', 'Cutting removed.');
            } catch (Throwable $e) { flash('admin_error', 'Delete failed: ' . $e->getMessage()); }
        }
        redirect('/admin/index.php?module=newspaper');
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'delete_gallery') {
        $id = (int)($_POST['id'] ?? 0);
        $item = $content->findGallery($id);
        if ($item) {
            @unlink(__DIR__ . '/../' . $item['image']);
            $content->deleteGallery($id);
            try {
                flash('admin_success', 'Image removed.');
            } catch (Throwable $e) {
                flash('admin_error', 'Remove failed: ' . $e->getMessage());
            }
        }
        redirect('/admin/index.php?module=gallery');
    }

    // Blog Status Updates (Approval / Rejection workflow)
    if ($loggedIn && ($_POST['action'] ?? '') === 'update_blog_status') {
        if (is_role('super_admin', 'admin')) {
            $id = (int)($_POST['id'] ?? 0);
            $status = $_POST['status'] ?? '';
            $reason = trim($_POST['rejection_reason'] ?? '');
            
            $blog = $blogModel->find($id);
            if ($blog && in_array($status, ['published', 'rejected', 'archived', 'draft'], true)) {
                $updateData = $blog;
                $updateData['status'] = $status;
                if ($status === 'published') {
                    $updateData['published_at'] = date('Y-m-d H:i:s');
                }
                $blogModel->update($id, $updateData);
                
                $userModel->logAudit((int)$_SESSION['user_id'], 'Blog status updated to ' . $status . ': ' . $id, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                
                // Notify the author
                if ($blog['author_id']) {
                    if ($status === 'published') {
                        $userModel->addNotification((int)$blog['author_id'], 'Blog Published', 'Your blog "' . $blog['title'] . '" has been approved and published.');
                    } elseif ($status === 'rejected') {
                        $msg = 'Your blog "' . $blog['title'] . '" was rejected.';
                        if (!empty($reason)) {
                            $msg .= ' Reason: ' . $reason;
                        }
                        $userModel->addNotification((int)$blog['author_id'], 'Blog Rejected', $msg);
                    }
                }
                flash('admin_success', 'Blog status updated successfully.');
            } else {
                flash('admin_error', 'Invalid blog or status.');
            }
        } else {
            flash('admin_error', 'Unauthorized access.');
        }
        redirect('/admin/index.php?module=blogs');
    }

    // User CRUD actions (Role management)
    if ($loggedIn && (($_POST['action'] ?? '') === 'create_user' || ($_POST['action'] ?? '') === 'update_user')) {
        $isEdit = $_POST['action'] === 'update_user';
        $id = (int)($_POST['id'] ?? 0);
        
        $role = $_POST['role'] ?? 'author';
        $status = $_POST['status'] ?? 'active';
        
        if (is_role('admin')) {
            if ($role !== 'author') {
                flash('admin_error', 'Admins can only manage Authors.');
                redirect('/admin/index.php?module=authors');
            }
            if ($isEdit) {
                $targetUser = $userModel->find($id);
                if ($targetUser && $targetUser['role'] !== 'author') {
                    flash('admin_error', 'Admins can only edit Authors.');
                    redirect('/admin/index.php?module=authors');
                }
            }
        } elseif (!is_role('super_admin')) {
            http_response_code(403);
            exit('Unauthorized');
        }

        $userData = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'role' => $role,
            'status' => $status,
            'biography' => trim($_POST['biography'] ?? ''),
            'facebook_link' => trim($_POST['facebook_link'] ?? ''),
            'twitter_link' => trim($_POST['twitter_link'] ?? ''),
            'linkedin_link' => trim($_POST['linkedin_link'] ?? ''),
        ];

        $errors = [];
        if (empty($userData['name'])) $errors[] = 'Name is required.';
        if (empty($userData['email'])) $errors[] = 'Email is required.';
        if (!$isEdit && empty($_POST['password'])) $errors[] = 'Password is required for new users.';
        
        $existingUser = $userModel->findByEmail($userData['email']);
        if ($existingUser && (!$isEdit || (int)$existingUser['id'] !== $id)) {
            $errors[] = 'Email is already in use.';
        }

        if (empty($errors)) {
            if (!empty($_POST['password'])) {
                $userData['password'] = $_POST['password'];
            }
            
            if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
                $errorUpload = '';
                $uploaded = upload_file($_FILES['profile_photo'], $errorUpload, 'profiles');
                if ($uploaded) {
                    $userData['profile_photo'] = $uploaded;
                }
            }

            try {
                if ($isEdit) {
                    $userModel->update($id, $userData);
                    $userModel->logAudit((int)$_SESSION['user_id'], 'User Updated: ' . $id, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                    flash('admin_success', 'User updated successfully.');
                } else {
                    $userData['password'] = $_POST['password'];
                    $newUserId = $userModel->create($userData);
                    $userModel->logAudit((int)$_SESSION['user_id'], 'User Created: ' . $newUserId, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                    flash('admin_success', 'User created successfully.');
                }
            } catch (Throwable $e) {
                flash('admin_error', 'Error: ' . $e->getMessage());
            }
            redirect('/admin/index.php?module=authors');
        } else {
            flash('admin_error', implode(' ', $errors));
            redirect('/admin/index.php?module=authors');
        }
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'delete_user') {
        $id = (int)($_POST['id'] ?? 0);
        $targetUser = $userModel->find($id);
        
        if ($targetUser) {
            if (is_role('admin') && $targetUser['role'] !== 'author') {
                flash('admin_error', 'Admins can only delete Authors.');
            } elseif ($targetUser['role'] === 'super_admin' && $id === (int)$_SESSION['user_id']) {
                flash('admin_error', 'You cannot delete your own Super Admin account.');
            } elseif (!is_role('super_admin', 'admin')) {
                flash('admin_error', 'Unauthorized.');
            } else {
                try {
                    $userModel->delete($id);
                    $userModel->logAudit((int)$_SESSION['user_id'], 'User Deleted: ' . $id, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                    flash('admin_success', 'User deleted successfully.');
                } catch (Throwable $e) {
                    flash('admin_error', 'Error: ' . $e->getMessage());
                }
            }
        }
        redirect('/admin/index.php?module=authors');
    }

    // Profile updates and password changes
    if ($loggedIn && ($_POST['action'] ?? '') === 'update_profile') {
        $id = (int)$_SESSION['user_id'];
        $userData = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'biography' => trim($_POST['biography'] ?? ''),
            'facebook_link' => trim($_POST['facebook_link'] ?? ''),
            'twitter_link' => trim($_POST['twitter_link'] ?? ''),
            'linkedin_link' => trim($_POST['linkedin_link'] ?? ''),
            'role' => $_SESSION['user_role'],
            'status' => 'active',
        ];
        
        $errors = [];
        if (empty($userData['name'])) $errors[] = 'Name is required.';
        if (empty($userData['email'])) $errors[] = 'Email is required.';
        
        $existingUser = $userModel->findByEmail($userData['email']);
        if ($existingUser && (int)$existingUser['id'] !== $id) {
            $errors[] = 'Email is already in use.';
        }
        
        if (empty($errors)) {
            if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
                $errorUpload = '';
                $uploaded = upload_file($_FILES['profile_photo'], $errorUpload, 'profiles');
                if ($uploaded) {
                    $userData['profile_photo'] = $uploaded;
                }
            }
            try {
                $userModel->update($id, $userData);
                $_SESSION['user_name'] = $userData['name'];
                $userModel->logAudit($id, 'Profile Updated', $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                flash('admin_success', 'Profile updated successfully.');
            } catch (Throwable $e) {
                flash('admin_error', 'Profile error: ' . $e->getMessage());
            }
        } else {
            flash('admin_error', implode(' ', $errors));
        }
        redirect('/admin/index.php?module=profile');
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'change_password') {
        $id = (int)$_SESSION['user_id'];
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        $errors = [];
        $user = $userModel->find($id);
        if (!$user || !password_verify($currentPassword, $user['password'])) {
            $errors[] = 'Incorrect current password.';
        }
        if (strlen($newPassword) < 6) {
            $errors[] = 'New password must be at least 6 characters.';
        }
        if ($newPassword !== $confirmPassword) {
            $errors[] = 'New passwords do not match.';
        }
        
        if (empty($errors)) {
            try {
                $userModel->changePassword($id, $newPassword);
                $userModel->logAudit($id, 'Password Changed', $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                flash('admin_success', 'Password changed successfully.');
            } catch (Throwable $e) {
                flash('admin_error', 'Error: ' . $e->getMessage());
            }
        } else {
            flash('admin_error', implode(' ', $errors));
        }
        redirect('/admin/index.php?module=change_password');
    }

    // Ajax notifications read handler
    if ($loggedIn && ($_POST['action'] ?? '') === 'mark_notifications_read') {
        $userModel->markNotificationsRead((int)$_SESSION['user_id']);
        json_response(['status' => 'success']);
    }
}

$error = flash('admin_error');
$module = $_GET['module'] ?? 'dashboard';
$metrics = $content->metrics();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | <?= e(app_config('name')) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="<?= e(asset('css/admin.css')) ?>" rel="stylesheet">
</head>
<body class="admin-body">
<?php if (!$loggedIn): ?>
    <div class="admin-login-shell">
        <form method="post" class="admin-login-card">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="login">
            <span class="admin-kicker">Secure CMS</span>
            <h1>Admin Login</h1>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
            <input class="form-control mb-3" type="email" name="email" placeholder="admin@example.com" required>
            <input class="form-control mb-3" type="password" name="password" placeholder="password" required>
            <button class="btn btn-dark w-100" type="submit">Login</button>
        </form>
    </div>
<?php else: ?>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="admin-brand"> CMS</div>
            <nav>
                <?php if (is_role('super_admin', 'admin')): ?>
                    <a href="?module=dashboard" class="<?= $module === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
                    <a href="?module=timeline" class="<?= $module === 'timeline' ? 'active' : '' ?>">Timeline</a>
                    <a href="?module=blogs" class="<?= $module === 'blogs' ? 'active' : '' ?>">Blogs</a>
                    <a href="?module=events" class="<?= $module === 'events' ? 'active' : '' ?>">Events</a>
                    <a href="?module=campaigns" class="<?= $module === 'campaigns' ? 'active' : '' ?>">Campaigns</a>
                    <a href="?module=donations" class="<?= $module === 'donations' ? 'active' : '' ?>">Donations</a>
                    <a href="?module=donation_settings" class="<?= $module === 'donation_settings' ? 'active' : '' ?>">Donation Settings</a>
                    <a href="?module=gallery" class="<?= $module === 'gallery' ? 'active' : '' ?>">Gallery Bank</a>
                    <a href="?module=newspaper" class="<?= $module === 'newspaper' ? 'active' : '' ?>">Newspaper Cuttings</a>
                    <a href="?module=volunteers" class="<?= $module === 'volunteers' ? 'active' : '' ?>">Volunteers</a>
                    <a href="?module=authors" class="<?= $module === 'authors' ? 'active' : '' ?>">Manage Users</a>
                    <?php if (is_role('super_admin')): ?>
                        <a href="?module=settings" class="<?= $module === 'settings' ? 'active' : '' ?>">SEO & Settings</a>
                        <a href="?module=audit_logs" class="<?= $module === 'audit_logs' ? 'active' : '' ?>">Audit Logs</a>
                    <?php endif; ?>
                <?php elseif (is_role('author')): ?>
                    <a href="?module=dashboard" class="<?= $module === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
                    <a href="?module=blogs" class="<?= $module === 'blogs' ? 'active' : '' ?>">My Blogs</a>
                    <a href="?module=profile" class="<?= $module === 'profile' ? 'active' : '' ?>">My Profile</a>
                    <a href="?module=change_password" class="<?= $module === 'change_password' ? 'active' : '' ?>">Change Password</a>
                <?php endif; ?>
            </nav>
            <form method="post" class="mt-auto">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="logout">
                <button class="btn btn-outline-light w-100" type="submit">Logout</button>
            </form>
        </aside>
        <main class="admin-main">
            <div class="admin-topbar d-flex justify-content-between align-items-center py-2 px-4 bg-white border-bottom shadow-sm">
                <h1 class="h4 mb-0"><?= e(ucfirst(str_replace('_', ' ', $module))) ?></h1>
                
                <div class="d-flex align-items-center gap-3">
                    <!-- Notifications Dropdown -->
                    <?php 
                    $sessUserId = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;
                    $sessUserName = $_SESSION['user_name'] ?? 'Admin';
                    $sessUserRole = $_SESSION['user_role'] ?? 'super_admin';
                    
                    $unreadCount = $sessUserId > 0 ? $userModel->getUnreadNotificationsCount($sessUserId) : 0;
                    $notifications = $sessUserId > 0 ? $userModel->getNotifications($sessUserId, false) : [];
                    ?>
                    <div class="dropdown">
                        <button class="btn btn-outline-dark position-relative py-1 px-2 border-0" type="button" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bell fs-5"></i>
                            <?php if ($unreadCount > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notifBadge" style="margin-top: 3px; margin-left: -5px;">
                                    <?= $unreadCount ?>
                                </span>
                            <?php endif; ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-0 shadow-lg border-0" aria-labelledby="notifDropdown" style="width: 320px; max-height: 400px; overflow-y: auto; z-index: 1050;">
                            <div class="bg-dark text-white p-3 d-flex justify-content-between align-items-center rounded-top">
                                <h6 class="mb-0">Notifications</h6>
                                <?php if ($unreadCount > 0): ?>
                                    <button class="btn btn-sm btn-link text-white-50 p-0 text-decoration-none" onclick="markAllRead()">Mark all read</button>
                                <?php endif; ?>
                            </div>
                            <div class="list-group list-group-flush" id="notifList">
                                <?php if (empty($notifications)): ?>
                                    <div class="list-group-item text-center text-muted py-3">No notifications.</div>
                                <?php else: ?>
                                    <?php foreach (array_slice($notifications, 0, 10) as $notif): ?>
                                        <div class="list-group-item p-3 <?= !$notif['is_read'] ? 'bg-light' : '' ?>">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <strong class="small"><?= e($notif['title']) ?></strong>
                                                <span class="text-muted" style="font-size: 10px;"><?= date('H:i, d M', strtotime($notif['created_at'])) ?></span>
                                            </div>
                                            <p class="mb-0 text-muted small"><?= e($notif['message']) ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- User Account Badge -->
                    <div class="d-flex align-items-center gap-2">
                        <div class="text-end">
                            <div class="fw-bold small text-dark"><?= e($sessUserName) ?></div>
                            <div class="text-muted text-uppercase" style="font-size: 10px; font-weight: 700;"><?= e(str_replace('_', ' ', $sessUserRole)) ?></div>
                        </div>
                        <?php 
                        $curUser = $sessUserId > 0 ? $userModel->find($sessUserId) : null;
                        $avatarUrl = ($curUser && $curUser['profile_photo']) ? base_url($curUser['profile_photo']) : 'https://ui-avatars.com/api/?name=' . urlencode($sessUserName) . '&background=random';
                        ?>
                        <img src="<?= $avatarUrl ?>" class="rounded-circle border" style="width: 36px; height: 36px; object-fit: cover;">
                    </div>
                </div>
            </div>

            <?php if ($module === 'dashboard'): ?>
                <?php if (is_role('author')): ?>
                    <?php 
                    $authorId = (int)$_SESSION['user_id'];
                    $tBlogs = $blogModel->count($authorId);
                    $pBlogs = $blogModel->count($authorId, 'published');
                    $dBlogs = $blogModel->count($authorId, 'draft');
                    $penBlogs = $blogModel->count($authorId, 'pending');
                    $rBlogs = $blogModel->count($authorId, 'rejected');
                    $recentLogs = $userModel->getAuditLogs($authorId, 10);
                    ?>
                    <div class="row g-4 mb-4">
                        <div class="col-md-4 col-xl-2">
                            <div class="metric-card bg-primary text-white border-0 shadow-sm">
                                <strong><?= $tBlogs ?></strong>
                                <span>Total Blogs</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-2">
                            <div class="metric-card bg-success text-white border-0 shadow-sm">
                                <strong><?= $pBlogs ?></strong>
                                <span>Published</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-2">
                            <div class="metric-card bg-secondary text-white border-0 shadow-sm">
                                <strong><?= $dBlogs ?></strong>
                                <span>Drafts</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-2">
                            <div class="metric-card bg-warning text-dark border-0 shadow-sm">
                                <strong><?= $penBlogs ?></strong>
                                <span>Pending Review</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-2">
                            <div class="metric-card bg-danger text-white border-0 shadow-sm">
                                <strong><?= $rBlogs ?></strong>
                                <span>Rejected</span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-7">
                            <div class="admin-card">
                                <h2>Author Quick Actions</h2>
                                <div class="d-flex flex-wrap gap-2 mt-3 mb-4">
                                    <a href="?module=blogs#createBlogForm" class="btn btn-dark"><i class="fa-solid fa-plus me-2"></i>Create New Blog</a>
                                    <a href="?module=profile" class="btn btn-outline-dark"><i class="fa-solid fa-user me-2"></i>Update Profile</a>
                                    <a href="?module=change_password" class="btn btn-outline-secondary"><i class="fa-solid fa-key me-2"></i>Change Password</a>
                                </div>
                                <h3 class="h5 mt-4">Getting Started</h3>
                                <p class="text-muted small">You can manage your own drafts, submit them for review to the administrators, and check notification status updates on your dashboard.</p>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="admin-card">
                                <h2>Recent Activities</h2>
                                <div class="list-group list-group-flush mt-3" style="max-height: 250px; overflow-y: auto;">
                                    <?php if (empty($recentLogs)): ?>
                                        <div class="text-muted text-center py-3">No recent activities.</div>
                                    <?php else: ?>
                                        <?php foreach ($recentLogs as $log): ?>
                                            <div class="list-group-item px-0 py-2">
                                                <div class="d-flex justify-content-between">
                                                    <span class="fw-bold small text-dark"><?= e($log['action']) ?></span>
                                                    <span class="text-muted" style="font-size: 10px;"><?= date('H:i, d M', strtotime($log['created_at'])) ?></span>
                                                </div>
                                                <div class="text-muted" style="font-size: 11px;">IP: <?= e($log['ip_address']) ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row g-4 mb-4">
                        <?php foreach ($metrics as $label => $value): ?>
                            <div class="col-md-4 col-xl-2">
                                <a href="?module=<?= e($label) ?>" class="text-decoration-none">
                                    <div class="metric-card">
                                    <strong><?= e((string) $value) ?></strong>
                                    <span><?= e(ucfirst($label)) ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-7">
                            <div class="admin-card">
                                <h2>Quick Actions</h2>
                                <div class="d-flex flex-wrap gap-2 mt-3">
                                    <a href="?module=campaigns" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Create New Campaign</a>
                                    <a href="?module=blogs" class="btn btn-dark"><i class="fa-solid fa-plus me-2"></i>Create New Blog</a>
                                    <a href="?module=timeline" class="btn btn-outline-dark"><i class="fa-solid fa-plus me-2"></i>Add Timeline Entry</a>
                                </div>
                                <p class="mt-4">Use this dashboard to manage blogs, events, causes, portfolio items, and other site content.</p>
                            </div>
                        </div>
                        <div class="col-lg-5"><div class="admin-card"><h2>Website Settings</h2><p>Logo, footer, social links, contact details, SEO meta, and sitemap generation are all represented in this CMS structure.</p></div></div>
                    </div>
                <?php endif; ?>
            <?php elseif ($module === 'pages'): ?>
                <?php
                $pages = $content->allPages();
                $success = flash('admin_success');
                $editId = (int)($_GET['edit_id'] ?? 0);
                $editPage = $editId > 0 ? $content->findPage($editId) : null;
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="mb-0">Pages CMS</h2>
                        <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#pageForm"><?= $editPage ? 'Editing Page' : 'Add New' ?></button>
                    </div>
                    <div class="collapse mb-3 <?= $editPage ? 'show' : '' ?>" id="pageForm">
                        <div class="card card-body">
                            <form method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="<?= $editPage ? 'update_page' : 'create_page' ?>">
                                <?php if ($editPage): ?><input type="hidden" name="id" value="<?= $editPage['id'] ?>"><?php endif; ?>
                                <div class="row g-3">
                                    <div class="col-md-9">
                                        <label class="form-label">Title *</label>
                                        <input type="text" name="title" class="form-control" value="<?= e($editPage['title'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Language</label>
                                        <select name="language_code" class="form-select">
                                            <option value="en" <?= ($editPage['language_code'] ?? '') === 'en' ? 'selected' : '' ?>>English</option>
                                            <option value="hi" <?= ($editPage['language_code'] ?? '') === 'hi' ? 'selected' : '' ?>>Hindi</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Content</label>
                                        <textarea name="content" id="pageContentEditor" class="form-control" rows="10"><?= e($editPage['content'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control" value="<?= e($editPage['meta_title'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Meta Description</label>
                                        <input type="text" name="meta_description" class="form-control" value="<?= e($editPage['meta_description'] ?? '') ?>">
                                    </div>
                                    <div class="col-12 text-muted small">
                                        Slug: <?= $editPage ? e($editPage['slug']) : 'Generated from title' ?>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary"><?= $editPage ? 'Update Page' : 'Create Page' ?></button>
                                        <?php if ($editPage): ?><a href="?module=pages" class="btn btn-outline-secondary">Cancel</a><?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead><tr><th>Title</th><th>Slug</th><th>Language</th><th>Actions</th></tr></thead>
                            <tbody>
                                <?php foreach ($pages as $p): ?>
                                    <tr>
                                        <td><?= e($p['title']) ?></td>
                                        <td><code>/<?= e($p['slug']) ?></code></td>
                                        <td><span class="badge text-bg-light"><?= strtoupper(e($p['language_code'])) ?></span></td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="?module=pages&edit_id=<?= $p['id'] ?>#pageForm" class="btn btn-sm btn-outline-dark">Edit</a>
                                                <form method="post" onsubmit="return confirm('Delete this page?')">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="action" value="delete_page">
                                                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php elseif ($module === 'timeline'): ?>
                <?php
                $timeline = $content->getTimeline();
                $success = flash('admin_success');
                $editId = (int)($_GET['edit_id'] ?? 0);
                $editTimeline = $editId > 0 ? $content->findTimeline($editId) : null;
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="mb-0">Timeline Management</h2>
                        <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#timelineForm"><?= $editTimeline ? 'Editing Entry' : 'Add New' ?></button>
                    </div>
                    <div class="collapse mb-3 <?= $editTimeline ? 'show' : '' ?>" id="timelineForm">
                        <div class="card card-body">
                            <form method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="<?= $editTimeline ? 'update_timeline' : 'create_timeline' ?>">
                                <?php if ($editTimeline): ?>
                                    <input type="hidden" name="id" value="<?= $editTimeline['id'] ?>">
                                <?php endif; ?>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Year *</label>
                                        <input type="text" name="year" class="form-control" value="<?= e($editTimeline['year'] ?? '') ?>" placeholder="e.g. 2024" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Title *</label>
                                        <input type="text" name="title" class="form-control" value="<?= e($editTimeline['title'] ?? '') ?>" placeholder="Entry title" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" class="form-control" value="<?= e((string)($editTimeline['sort_order'] ?? 0)) ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="Optional details..."><?= e($editTimeline['description'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary"><?= $editTimeline ? 'Update Entry' : 'Add Entry' ?></button>
                                        <?php if ($editTimeline): ?>
                                            <a href="?module=timeline" class="btn btn-outline-secondary">Cancel</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Title</th>
                                    <th>Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($timeline)): ?>
                                    <tr><td colspan="4" class="text-center py-4">No timeline entries found in the database.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($timeline as $t): ?>
                                        <tr>
                                            <td><strong><?= e($t['year']) ?></strong></td>
                                            <td><?= e($t['title']) ?></td>
                                            <td><?= e((string)$t['sort_order']) ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="?module=timeline&edit_id=<?= $t['id'] ?>#timelineForm" class="btn btn-sm btn-outline-dark">Edit</a>
                                                    <form method="post" onsubmit="return confirm('Delete this timeline entry?')">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="action" value="delete_timeline">
                                                        <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php elseif ($module === 'blogs'): ?>
                <?php
                $blogs = is_role('author') 
                    ? $blogModel->all(100, 0, (int)$_SESSION['user_id']) 
                    : $blogModel->all(100, 0);
                $categories = $categoryModel->all();
                $success = flash('admin_success');

                $editId = (int)($_GET['edit_id'] ?? 0);
                $editBlog = $editId > 0 ? $blogModel->find($editId) : null;
                
                // Enforce author edit restrictions
                if ($editBlog && is_role('author') && (int)$editBlog['author_id'] !== (int)$_SESSION['user_id']) {
                    $editBlog = null;
                    flash('admin_error', 'Unauthorized access: You do not own this blog post.');
                }
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="mb-0">Blogs Management</h2>
                        <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#createBlogForm"><?= $editBlog ? 'Editing Blog' : 'Add New' ?></button>
                    </div>
                    <div class="collapse mb-3 <?= $editBlog ? 'show' : '' ?>" id="createBlogForm">
                        <div class="card card-body">
                            <form method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="<?= $editBlog ? 'update_blog' : 'create_blog' ?>">
                                <?php if ($editBlog): ?>
                                    <input type="hidden" name="id" value="<?= $editBlog['id'] ?>">
                                    <input type="hidden" name="existing_banner" value="<?= e($editBlog['banner_image']) ?>">
                                <?php endif; ?>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Title *</label>
                                        <input type="text" name="title" class="form-control" value="<?= e($editBlog['title'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Category *</label>
                                        <select name="category_id" class="form-select" required>
                                            <option value="">Select Category</option>
                                            <?php foreach ($categories as $cat): ?>
                                                <option value="<?= $cat['id'] ?>" <?= ($editBlog && $editBlog['category_id'] == $cat['id']) ? 'selected' : '' ?>><?= e($cat['name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">English Title *</label>
                                        <input type="text" name="en_title" class="form-control" value="<?= e($editBlog['en_title'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">URL Slug (Optional - auto-generated if blank)</label>
                                        <input type="text" name="slug" class="form-control" value="<?= e($editBlog['slug'] ?? '') ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Excerpt</label>
                                        <textarea name="excerpt" class="form-control" rows="2"><?= e($editBlog['excerpt'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Content *</label>
                                        <textarea name="content" id="blogContentEditor" class="form-control" rows="5"><?= e($editBlog['content'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Author String</label>
                                        <input type="text" name="author" class="form-control" value="<?= e($editBlog['author'] ?? ($editBlog ? '' : $_SESSION['user_name'])) ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Featured Image / Banner</label>
                                        <input type="file" name="banner_image" class="form-control" accept="image/*">
                                        <?php if ($editBlog && $editBlog['banner_image']): ?>
                                            <div class="form-text">Current: <?= e($editBlog['banner_image']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Status *</label>
                                        <select name="status" class="form-select" required>
                                            <?php if (is_role('author')): ?>
                                                <option value="draft" <?= ($editBlog && $editBlog['status'] === 'draft') ? 'selected' : '' ?>>Draft</option>
                                                <option value="pending" <?= ($editBlog && $editBlog['status'] === 'pending') ? 'selected' : '' ?>>Submit for Review (Pending)</option>
                                            <?php else: ?>
                                                <option value="draft" <?= ($editBlog && $editBlog['status'] === 'draft') ? 'selected' : '' ?>>Draft</option>
                                                <option value="pending" <?= ($editBlog && $editBlog['status'] === 'pending') ? 'selected' : '' ?>>Pending Review</option>
                                                <option value="published" <?= ($editBlog && $editBlog['status'] === 'published') ? 'selected' : '' ?>>Published</option>
                                                <option value="rejected" <?= ($editBlog && $editBlog['status'] === 'rejected') ? 'selected' : '' ?>>Rejected</option>
                                                <option value="archived" <?= ($editBlog && $editBlog['status'] === 'archived') ? 'selected' : '' ?>>Archived</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <!-- SEO Fields section -->
                                    <div class="col-12"><hr class="my-4"><h5 class="mb-3 text-secondary">SEO & Meta Information</h5></div>
                                    <div class="col-md-6">
                                        <label class="form-label">SEO Title</label>
                                        <input type="text" name="seo_title" class="form-control" value="<?= e($editBlog['seo_title'] ?? '') ?>" placeholder="Search Engine Title">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Canonical URL</label>
                                        <input type="url" name="canonical_url" class="form-control" value="<?= e($editBlog['canonical_url'] ?? '') ?>" placeholder="https://example.com/canonical-link">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" class="form-control" value="<?= e($editBlog['meta_keywords'] ?? '') ?>" placeholder="key1, key2, key3">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Custom Open Graph Image (Upload)</label>
                                        <input type="file" name="og_image_file" class="form-control" accept="image/*">
                                        <?php if ($editBlog && $editBlog['og_image']): ?>
                                            <div class="form-text">Current: <?= e($editBlog['og_image']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="2" placeholder="Brief search engine snippet..."><?= e($editBlog['meta_description'] ?? '') ?></textarea>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary"><?= $editBlog ? 'Update Blog' : 'Create Blog' ?></button>
                                        <?php if ($editBlog): ?>
                                            <a href="?module=blogs" class="btn btn-outline-secondary">Cancel</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($blogs)): ?>
                                    <tr><td colspan="6" class="text-center">No blogs found.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($blogs as $b): ?>
                                        <tr>
                                            <td>
                                                <strong><?= e($b['title']) ?></strong>
                                                <?php if ($b['slug']): ?><br><small class="text-muted">Slug: <?= e($b['slug']) ?></small><?php endif; ?>
                                            </td>
                                            <td><?= e($b['category_name'] ?? 'Uncategorized') ?></td>
                                            <td><?= e($b['author_name'] ?: ($b['author'] ?: 'System')) ?></td>
                                            <td>
                                                <?php 
                                                $badgeMap = [
                                                    'published' => 'success',
                                                    'draft' => 'secondary',
                                                    'pending' => 'warning',
                                                    'rejected' => 'danger',
                                                    'archived' => 'info'
                                                ];
                                                $badgeClass = $badgeMap[$b['status']] ?? 'secondary';
                                                ?>
                                                <span class="badge text-bg-<?= $badgeClass ?>"><?= ucfirst($b['status']) ?></span>
                                            </td>
                                            <td><?= date('d M Y', strtotime($b['created_at'])) ?></td>
                                            <td>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <a href="?module=blogs&edit_id=<?= $b['id'] ?>#createBlogForm" class="btn btn-sm btn-outline-dark">Edit</a>
                                                    
                                                    <?php if (is_role('super_admin', 'admin') && $b['status'] === 'pending'): ?>
                                                        <form method="post" class="d-inline">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="action" value="update_blog_status">
                                                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                                            <input type="hidden" name="status" value="published">
                                                            <button type="submit" class="btn btn-sm btn-success">Publish</button>
                                                        </form>
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="rejectBlog(<?= $b['id'] ?>)">Reject</button>
                                                    <?php endif; ?>

                                                    <?php if (!is_role('author') || $b['status'] !== 'published'): ?>
                                                        <form method="post" onsubmit="return confirm('Delete this blog?')" class="d-inline">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="action" value="delete_blog">
                                                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <script>
                function rejectBlog(id) {
                    Swal.fire({
                        title: 'Reject Blog Post',
                        input: 'text',
                        inputLabel: 'Rejection Reason',
                        inputPlaceholder: 'e.g. Please correct typos in title...',
                        showCancelButton: true,
                        confirmButtonText: 'Submit Rejection',
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        preConfirm: (value) => {
                            if (!value) {
                                Swal.showValidationMessage('Rejection reason is required');
                            }
                            return value;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let form = document.createElement('form');
                            form.method = 'POST';
                            form.innerHTML = `
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="update_blog_status">
                                <input type="hidden" name="id" value="${id}">
                                <input type="hidden" name="status" value="rejected">
                                <input type="hidden" name="rejection_reason" value="${result.value}">
                            `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
                </script>
            <?php elseif ($module === 'campaigns'): ?>
                <?php
                $campaigns = $content->allCampaigns();
                $success = flash('admin_success');
                $editId = (int)($_GET['edit_id'] ?? 0);
                $editCampaign = $editId > 0 ? $content->findCampaign($editId) : null;
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="mb-0">Campaign Management</h2>
                        <div class="d-flex gap-2">
                            <?php if ($editId > 0): ?>
                                <a href="?module=campaigns" class="btn btn-outline-dark"><i class="fa-solid fa-plus me-2"></i>Add New</a>
                            <?php endif; ?>
                            <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#campaignForm">
                                <i class="fa-solid <?= $editCampaign ? 'fa-eye' : 'fa-plus' ?> me-2"></i><?= $editCampaign ? 'View Form' : 'Add New' ?>
                            </button>
                        </div>
                    </div>
                    <div class="collapse mb-3 <?= $editCampaign ? 'show' : '' ?>" id="campaignForm">
                        <div class="card card-body">
                            <form method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="<?= $editCampaign ? 'update_campaign' : 'create_campaign' ?>">
                                <?php if ($editCampaign): ?>
                                    <input type="hidden" name="id" value="<?= $editCampaign['id'] ?>">
                                    <input type="hidden" name="existing_image" value="<?= e($editCampaign['image']) ?>">
                                <?php endif; ?>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Title *</label>
                                        <input type="text" name="title" class="form-control" value="<?= e($editCampaign['title'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">English Title *</label>
                                        <input type="text" name="en_title" class="form-control" value="<?= e($editCampaign['en_title'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Goal Amount (₹)</label>
                                        <input type="number" name="goal_amount" class="form-control" value="<?= e((string)($editCampaign['goal_amount'] ?? 0)) ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Raised Amount (₹)</label>
                                        <input type="number" name="raised_amount" class="form-control" value="<?= e((string)($editCampaign['raised_amount'] ?? 0)) ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" <?= ($editCampaign['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                            <option value="closed" <?= ($editCampaign['status'] ?? '') === 'closed' ? 'selected' : '' ?>>Closed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        <?php if ($editCampaign && $editCampaign['image']): ?>
                                            <div class="form-text">Current: <?= e($editCampaign['image']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Excerpt</label>
                                        <textarea name="excerpt" class="form-control" rows="2"><?= e($editCampaign['excerpt'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Full Description</label>
                                        <textarea name="content" id="causeContentEditor" class="form-control" rows="5"><?= e($editCampaign['content'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary"><?= $editId > 0 ? 'Update Campaign' : 'Create Campaign' ?></button>
                                        <?php if ($editId > 0): ?>
                                            <a href="?module=campaigns" class="btn btn-outline-secondary">Cancel</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead><tr><th>Title</th><th>Goal</th><th>Raised</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                <?php foreach ($campaigns as $c): ?>
                                    <tr>
                                        <td><?= e($c['title']) ?></td>
                                        <td>₹<?= number_format((float)$c['goal_amount']) ?></td>
                                        <td>₹<?= number_format((float)$c['raised_amount']) ?></td>
                                        <td><span class="badge text-bg-<?= $c['status'] === 'active' ? 'success' : 'secondary' ?>"><?= ucfirst($c['status']) ?></span></td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="?module=campaigns&edit_id=<?= $c['id'] ?>#campaignForm" class="btn btn-sm btn-outline-dark">Edit</a>
                                                <form method="post" onsubmit="return confirm('Delete this cause?')">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="action" value="delete_campaign">
                                                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php elseif ($module === 'events'): ?>
                <?php
                $events = $content->allEvents();
                $editId = (int)($_GET['edit_id'] ?? 0);
                $editEvent = $editId > 0 ? $content->findEvent($editId) : null;
                ?>
                <div class="admin-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>Events Management</h2>
                        <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#eventForm"><?= $editEvent ? 'Editing' : 'Add New' ?></button>
                    </div>
                    <div class="collapse mb-3 <?= $editEvent ? 'show' : '' ?>" id="eventForm">
                        <div class="card card-body">
                            <form method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="<?= $editEvent ? 'update_event' : 'create_event' ?>">
                                <?php if ($editEvent): ?><input type="hidden" name="id" value="<?= $editEvent['id'] ?>"><input type="hidden" name="existing_image" value="<?= e($editEvent['image']) ?>"><?php endif; ?>
                                <div class="row g-3">
                                    <div class="col-md-12"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="<?= e($editEvent['title'] ?? '') ?>" required></div>
                                    <div class="col-md-4"><label class="form-label">Date</label><input type="date" name="event_date" class="form-control" value="<?= e($editEvent['event_date'] ?? '') ?>"></div>
                                    <div class="col-md-4"><label class="form-label">Location</label><input type="text" name="location" class="form-control" value="<?= e($editEvent['location'] ?? '') ?>"></div>
                                    <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select"><option value="upcoming" <?= ($editEvent['status'] ?? '') === 'upcoming' ? 'selected' : '' ?>>Upcoming</option><option value="past" <?= ($editEvent['status'] ?? '') === 'past' ? 'selected' : '' ?>>Past</option></select></div>
                                    <div class="col-md-12"><label class="form-label">Image</label><input type="file" name="image" class="form-control"></div>
                                    <div class="col-md-12"><label class="form-label">Excerpt</label><textarea name="excerpt" class="form-control"><?= e($editEvent['excerpt'] ?? '') ?></textarea></div>
                                    <div class="col-12"><button type="submit" class="btn btn-primary">Save Event</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table align-middle">
                        <thead><tr><th>Title</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
                        <tbody>
                            <?php foreach ($events as $ev): ?>
                            <tr>
                                <td><?= e($ev['title']) ?></td>
                                <td><?= e($ev['event_date']) ?></td>
                                <td><span class="badge text-bg-<?= $ev['status'] === 'upcoming' ? 'primary' : 'secondary' ?>"><?= ucfirst($ev['status']) ?></span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="?module=events&edit_id=<?= $ev['id'] ?>#eventForm" class="btn btn-sm btn-outline-dark">Edit</a>
                                        <form method="post" onsubmit="return confirm('Delete?')">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="action" value="delete_event"><input type="hidden" name="id" value="<?= $ev['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Del</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif ($module === 'gallery'): ?>
                
                <?php
                $gallery = $content->allGallery();
                $success = flash('admin_success');
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">Gallery Bank</h2>
                        <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#galleryForm">Upload Image</button>
                    </div>
                    <div class="collapse mb-4" id="galleryForm">
                        <div class="card card-body">
                            <form method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="create_gallery">
                                <div class="row g-3">
                                    <div class="col-md-8"><input type="text" name="title" class="form-control" placeholder="Alt Title (Applies to all)"></div>
                                    <div class="col-md-4"><input type="file" name="images[]" class="form-control" multiple required></div>
                                    <div class="col-12"><button type="submit" class="btn btn-primary">Start Upload</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row g-3">
                        <?php foreach ($gallery as $img): ?>
                            <div class="col-md-2">
                                <div class="card h-100 position-relative">
                                    <img src="<?= e(base_url($img['image'])) ?>" class="card-img-top object-fit-cover" style="height:120px">
                                                                        <form method="post" class="position-absolute top-0 end-0 p-1" onsubmit="return confirm('Delete this image?')">

                                        <?= csrf_field() ?>
                                        <input type="hidden" name="action" value="delete_gallery"><input type="hidden" name="id" value="<?= $img['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger py-0 px-1"><i class="fa-solid fa-times"></i></button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php elseif ($module === 'newspaper'): ?>
                <?php
                $cuttings = $content->allNewspaperCuttings();
                $success = flash('admin_success');
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">Newspaper Cuttings</h2>
                        <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#newspaperForm">Upload Cuttings</button>
                    </div>
                    <div class="collapse mb-4" id="newspaperForm">
                        <div class="card card-body">
                            <form method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="create_newspaper">
                                <div class="row g-3">
                                    <div class="col-md-8"><input type="text" name="title" class="form-control" placeholder="Alt Title (Applies to all selected)"></div>
                                    <div class="col-md-4"><input type="file" name="images[]" class="form-control" multiple required></div>
                                    <div class="col-12"><button type="submit" class="btn btn-primary">Start Upload</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row g-3">
                        <?php foreach ($cuttings as $cutting): ?>
                            <div class="col-md-2">
                                <div class="card h-100 position-relative">
                                    <img src="<?= e(base_url($cutting['image'])) ?>" class="card-img-top object-fit-cover" style="height:120px">
                                    <form method="post" class="position-absolute top-0 end-0 p-1" onsubmit="return confirm('Delete this item?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="action" value="delete_newspaper">
                                        <input type="hidden" name="id" value="<?= $cutting['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger py-0 px-1"><i class="fa-solid fa-times"></i></button>
                                    </form>
                                    <div class="p-1 small text-truncate text-center"><?= e($cutting['title'] ?: 'Untitled') ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                 <?php elseif ($module === 'volunteers'): ?>
                <?php include __DIR__ . '/volunteers.php'; ?> 
                <?php elseif ($module === 'contacts'): ?>
                <div class="admin-card">
                    <h2 class="mb-0">Contacts</h2>
                    <p class="mt-3">Contact messages and inquiries from the website will appear here.</p>
                </div>
            <?php elseif ($module === 'donations'): ?>
                <?php
                $donations = $content->allDonations();
                $success = flash('admin_success');
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <h2 class="mb-4">Donation Listing</h2>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Receipt</th>
                                    <th>Donor</th>
                                    <th>Amount</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($donations as $dn): ?>
                                    <tr>
                                        <td><small class="text-muted"><?= e($dn['receipt_no']) ?></small></td>
                                        <td>
                                            <strong><?= e($dn['full_name']) ?></strong><br>
                                            <small><?= e($dn['mobile']) ?></small>
                                        </td>
                                        <td>₹<?= number_format((float)$dn['amount']) ?></td>
                                        <td>
                                            <small><?= e($dn['payment_method']) ?>: <code><?= e($dn['transaction_id']) ?></code></small><br>
                                            <small class="text-muted"><?= date('d M Y', strtotime($dn['created_at'])) ?></small>
                                        </td>
                                        <td>
                                            <span class="badge text-bg-<?= $dn['status'] === 'verified' ? 'success' : ($dn['status'] === 'rejected' ? 'danger' : 'warning text-dark') ?>">
                                                <?= ucfirst($dn['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <form method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="action" value="update_donation_status">
                                                <input type="hidden" name="id" value="<?= $dn['id'] ?>">
                                                <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                                    <option value="pending" <?= $dn['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="verified" <?= $dn['status'] === 'verified' ? 'selected' : '' ?>>Verify</option>
                                                    <option value="rejected" <?= $dn['status'] === 'rejected' ? 'selected' : '' ?>>Reject</option>
                                                </select>
                                            </form>
                                            <?php if ($dn['screenshot']): ?>
                                                <a href="<?= e(base_url($dn['screenshot'])) ?>" target="_blank" class="btn btn-sm btn-outline-info ms-1"><i class="fa-solid fa-image"></i></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php elseif ($module === 'donation_settings'): ?>
                <?php
                $dsettings = $content->getDonationSettings();
                $success = flash('admin_success');
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <h2 class="mb-4">Donation Settings</h2>
                    <form method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="update_donation_settings">
                        <input type="hidden" name="existing_qr" value="<?= e($dsettings['qr_code'] ?? '') ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Organization Name</label>
                                <input type="text" name="org_name" class="form-control" value="<?= e($dsettings['org_name'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Account Holder Name</label>
                                <input type="text" name="account_name" class="form-control" value="<?= e($dsettings['account_name'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control" value="<?= e($dsettings['bank_name'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Account Number</label>
                                <input type="text" name="account_number" class="form-control" value="<?= e($dsettings['account_number'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">IFSC Code</label>
                                <input type="text" name="ifsc" class="form-control" value="<?= e($dsettings['ifsc'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">UPI ID</label>
                                <input type="text" name="upi_id" class="form-control" value="<?= e($dsettings['upi_id'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Phone</label>
                                <input type="text" name="phone" class="form-control" value="<?= e($dsettings['phone'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Email</label>
                                <input type="email" name="email" class="form-control" value="<?= e($dsettings['email'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">QR Code Image</label>
                                <input type="file" name="qr_code" class="form-control" accept="image/*">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Thank You Message</label>
                                <textarea name="thank_you_msg" class="form-control" rows="3"><?= e($dsettings['thank_you_msg'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </div>
                        </div>
                    </form>
            <?php elseif ($module === 'subscribers'): ?>
                <div class="admin-card">
                    <h2 class="mb-0">Subscribers</h2>
                    <p class="mt-3">Newsletter subscribers will appear here.</p>
                </div>
            <?php elseif ($module === 'authors'): ?>
                <?php
                if (!is_role('super_admin', 'admin')) {
                    redirect('/admin/index.php?module=dashboard');
                }
                $users = is_role('admin') 
                    ? array_filter($userModel->all(), fn($u) => $u['role'] === 'author') 
                    : $userModel->all();
                $success = flash('admin_success');
                $editId = (int)($_GET['edit_id'] ?? 0);
                $editUser = $editId > 0 ? $userModel->find($editId) : null;
                
                if ($editUser && is_role('admin') && $editUser['role'] !== 'author') {
                    $editUser = null;
                    flash('admin_error', 'Admins can only manage Author accounts.');
                }
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="mb-0">User Management</h2>
                        <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#userForm"><?= $editUser ? 'Editing User' : 'Add New' ?></button>
                    </div>
                    <div class="collapse mb-3 <?= $editUser ? 'show' : '' ?>" id="userForm">
                        <div class="card card-body">
                            <form method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="<?= $editUser ? 'update_user' : 'create_user' ?>">
                                <?php if ($editUser): ?>
                                    <input type="hidden" name="id" value="<?= $editUser['id'] ?>">
                                <?php endif; ?>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" name="name" class="form-control" value="<?= e($editUser['name'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address *</label>
                                        <input type="email" name="email" class="form-control" value="<?= e($editUser['email'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Password <?= $editUser ? '(Leave blank to keep current)' : '*' ?></label>
                                        <input type="password" name="password" class="form-control" <?= $editUser ? '' : 'required' ?>>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Role *</label>
                                        <select name="role" class="form-select" required>
                                            <?php if (is_role('super_admin')): ?>
                                                <option value="super_admin" <?= ($editUser && $editUser['role'] === 'super_admin') ? 'selected' : '' ?>>Super Admin</option>
                                                <option value="admin" <?= ($editUser && $editUser['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                                                <option value="author" <?= ($editUser && $editUser['role'] === 'author') ? 'selected' : '' ?>>Author</option>
                                            <?php else: ?>
                                                <option value="author" selected>Author</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Status *</label>
                                        <select name="status" class="form-select" required>
                                            <option value="active" <?= ($editUser && $editUser['status'] === 'active') ? 'selected' : '' ?>>Active</option>
                                            <option value="inactive" <?= ($editUser && $editUser['status'] === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Profile Photo</label>
                                        <input type="file" name="profile_photo" class="form-control" accept="image/*">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Facebook Profile Link</label>
                                        <input type="url" name="facebook_link" class="form-control" value="<?= e($editUser['facebook_link'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Twitter / X Profile Link</label>
                                        <input type="url" name="twitter_link" class="form-control" value="<?= e($editUser['twitter_link'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">LinkedIn Profile Link</label>
                                        <input type="url" name="linkedin_link" class="form-control" value="<?= e($editUser['linkedin_link'] ?? '') ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Biography</label>
                                        <textarea name="biography" class="form-control" rows="3"><?= e($editUser['biography'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary"><?= $editUser ? 'Update User' : 'Create User' ?></button>
                                        <?php if ($editUser): ?>
                                            <a href="?module=authors" class="btn btn-outline-secondary">Cancel</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($users)): ?>
                                    <tr><td colspan="7" class="text-center">No users found.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($users as $u): ?>
                                        <tr>
                                            <td>
                                                <img src="<?= $u['profile_photo'] ? base_url($u['profile_photo']) : 'https://ui-avatars.com/api/?name=' . urlencode($u['name']) . '&background=random' ?>" class="rounded-circle border" style="width:36px; height:36px; object-fit: cover;">
                                            </td>
                                            <td><strong><?= e($u['name']) ?></strong></td>
                                            <td><?= e($u['email']) ?></td>
                                            <td><span class="badge text-bg-dark text-uppercase"><?= e($u['role']) ?></span></td>
                                            <td><span class="badge text-bg-<?= $u['status'] === 'active' ? 'success' : 'danger' ?>"><?= ucfirst($u['status']) ?></span></td>
                                            <td><?= $u['last_login'] ? date('d M Y, H:i', strtotime($u['last_login'])) : 'Never' ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="?module=authors&edit_id=<?= $u['id'] ?>#userForm" class="btn btn-sm btn-outline-dark">Edit</a>
                                                    <?php if ($u['role'] !== 'super_admin' || is_role('super_admin')): ?>
                                                        <form method="post" onsubmit="return confirm('Delete user? This cannot be undone.')">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="action" value="delete_user">
                                                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($module === 'profile'): ?>
                <?php 
                $curUser = $userModel->find((int)$_SESSION['user_id']);
                $success = flash('admin_success');
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    
                    <form method="post" enctype="multipart/form-data" class="card card-body border-0 shadow-sm">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="update_profile">
                        <div class="row g-3">
                            <div class="col-md-3 text-center mb-3">
                                <img src="<?= $curUser['profile_photo'] ? base_url($curUser['profile_photo']) : 'https://ui-avatars.com/api/?name=' . urlencode($curUser['name']) . '&background=random&size=150' ?>" class="rounded-circle border mb-3 img-thumbnail" style="width:150px; height:150px; object-fit: cover;">
                                <label class="form-label d-block text-muted small">Update profile photo</label>
                                <input type="file" name="profile_photo" class="form-control form-control-sm" accept="image/*">
                            </div>
                            <div class="col-md-9">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= e($curUser['name']) ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" value="<?= e($curUser['email']) ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Facebook Profile Link</label>
                                        <input type="url" name="facebook_link" class="form-control" value="<?= e($curUser['facebook_link'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Twitter / X Profile Link</label>
                                        <input type="url" name="twitter_link" class="form-control" value="<?= e($curUser['twitter_link'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">LinkedIn Profile Link</label>
                                        <input type="url" name="linkedin_link" class="form-control" value="<?= e($curUser['linkedin_link'] ?? '') ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Biography</label>
                                        <textarea name="biography" class="form-control" rows="4"><?= e($curUser['biography'] ?? '') ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4 text-end">
                                <button type="submit" class="btn btn-dark px-4">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>

            <?php elseif ($module === 'change_password'): ?>
                <?php $success = flash('admin_success'); ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    
                    <form method="post" class="card card-body border-0 shadow-sm" style="max-width: 500px;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="change_password">
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 mt-2">Update Password</button>
                    </form>
                </div>

            <?php elseif ($module === 'audit_logs'): ?>
                <?php
                if (!is_role('super_admin')) {
                    redirect('/admin/index.php?module=dashboard');
                }
                $logs = $userModel->getAuditLogs(null, 100);
                ?>
                <div class="admin-card">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Action Logged</th>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($logs)): ?>
                                    <tr><td colspan="5" class="text-center">No logs recorded.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($logs as $l): ?>
                                        <tr>
                                            <td>
                                                <strong><?= e($l['user_name'] ?: 'Guest') ?></strong><br>
                                                <small class="text-muted"><?= e($l['user_email'] ?: 'N/A') ?></small>
                                            </td>
                                            <td><code><?= e($l['action']) ?></code></td>
                                            <td><?= e($l['ip_address']) ?></td>
                                            <td class="small text-muted" style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?= e($l['user_agent']) ?>"><?= e($l['user_agent']) ?></td>
                                            <td><?= date('d M Y, H:i:s', strtotime($l['created_at'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($module === 'settings'): ?>
                <?php
                if (!is_role('super_admin')) {
                    redirect('/admin/index.php?module=dashboard');
                }
                $settings = $content->getSettings();
                $success = flash('admin_success');
                ?>
                <div class="admin-card mb-4">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <h2 class="mb-4">Website Settings</h2>
                    <form method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="update_settings">
                        <input type="hidden" name="existing_logo" value="<?= e($settings['logo'] ?? '') ?>">
                        
                        <div class="row g-4">
                            <!-- Logo and Tagline -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Website Logo</label>
                                <input type="file" name="logo" class="form-control mb-2" accept="image/*">
                                <?php if (!empty($settings['logo'])): ?>
                                    <div class="mt-2">
                                        <small class="text-muted d-block mb-1">Current Logo:</small>
                                        <img src="<?= e(base_url($settings['logo'])) ?>" alt="Logo" style="max-height: 50px; background: #f3f5f8; padding: 5px; border-radius: 8px;">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Site Tagline</label>
                                <textarea name="site_tagline" class="form-control" rows="3"><?= e($settings['site_tagline'] ?? '') ?></textarea>
                            </div>

                            <hr>

                            <!-- Contact Details -->
                            <h4 class="mb-0 text-primary">Contact Details</h4>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="<?= e($settings['phone'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control" value="<?= e($settings['email'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Address</label>
                                <textarea name="address" class="form-control" rows="1"><?= e($settings['address'] ?? '') ?></textarea>
                            </div>

                            <hr>

                            <!-- Social Media Links -->
                            <h4 class="mb-0 text-primary">Social Media Links</h4>
                            <div class="col-md-3">
                                <label class="form-label fw-bold"><i class="fab fa-facebook text-primary me-1"></i> Facebook</label>
                                <input type="text" name="facebook" class="form-control" value="<?= e($settings['facebook'] ?? '') ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold"><i class="fab fa-instagram text-danger me-1"></i> Instagram</label>
                                <input type="text" name="instagram" class="form-control" value="<?= e($settings['instagram'] ?? '') ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold"><i class="fab fa-linkedin text-info me-1"></i> LinkedIn</label>
                                <input type="text" name="linkedin" class="form-control" value="<?= e($settings['linkedin'] ?? '') ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold"><i class="fab fa-youtube text-danger me-1"></i> YouTube</label>
                                <input type="text" name="youtube" class="form-control" value="<?= e($settings['youtube'] ?? '') ?>">
                            </div>

                            <hr>

                            <!-- Footer Text -->
                            <div class="col-12 mt-2">
                                <label class="form-label fw-bold">Footer Text</label>
                                <textarea name="footer_text" class="form-control" rows="2"><?= e($settings['footer_text'] ?? '') ?></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">Save Settings</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="admin-card">
                    <h3 class="text-danger mb-3">Sitemap Generator</h3>
                    <p>Re-generate the XML sitemap of the website containing all static pages, custom dynamic pages, published blogs, campaigns, and events.</p>
                    <form method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="generate_sitemap">
                        <button type="submit" class="btn btn-outline-danger">Generate sitemap.xml</button>
                    </form>
                </div>

            <?php else: ?>
                <div class="admin-card">
                    <h2 class="mb-0">Module Management</h2>
                    <p class="mt-3">Please select a valid module from the sidebar to manage content.</p>
                </div>
            <?php endif; ?>
        </main>
    </div>
<?php endif; ?>
<script>
function markAllRead() {
    $.post('index.php', {
        action: 'mark_notifications_read',
        _csrf: '<?= csrf_token() ?>'
    }, function(res) {
        if(res.status === 'success') {
            $('#notifBadge').remove();
            $('#notifList').html('<div class="list-group-item text-center text-muted py-3">No notifications.</div>');
            Swal.fire({ icon: 'success', title: 'Marked read', text: 'All notifications cleared.' });
        }
    });
}
</script>
<!-- Required for the "Add New" collapse button to function -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="<?= e(asset('css/volunteer.css')) ?>">
<script src="<?= e(asset('js/volunteer.js')) ?>"></script>
<!-- TinyMCE for rich text editing -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
<script>
    // Initialize TinyMCE on the blog content textarea
    tinymce.init({
        selector: '#blogContentEditor', // Select the textarea by its ID
        plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        height: 300, // Set the height of the editor
    });
    tinymce.init({
        selector: '#causeContentEditor',
        plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        height: 300,
    });
    tinymce.init({
        selector: '#pageContentEditor',
        plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        height: 400,
    });
</script>
</body>
</html>
