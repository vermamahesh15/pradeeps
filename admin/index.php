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
    $userRole = $_SESSION['user_role'] ?? 'author';
    if ($module !== 'dashboard' && !$userModel->isModuleAllowed($userRole, $module)) {
        flash('admin_error', 'Access Restricted: Your role (' . ucfirst(str_replace('_', ' ', $userRole)) . ') does not have permission to access the ' . ucfirst(str_replace('_', ' ', $module)) . ' module.');
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

            // All articles written by non-admin roles require Admin (Pradeep Sarang) approval.
            $authorInput = trim($_POST['author'] ?? '');
            if (!empty($authorInput)) {
                $blogData['author'] = htmlspecialchars($authorInput);
            } elseif ($isEdit && !empty($existing['author'])) {
                $blogData['author'] = $existing['author'];
            } else {
                $blogData['author'] = $_SESSION['user_name'] ?? 'प्रदीप सारंग';
            }
            $requestedStatus = $_POST['status'] ?? 'pending';

            if (is_role('admin')) {
                // Admin (Pradeep Sarang) can directly approve and publish
                $blogData['status'] = in_array($requestedStatus, ['draft', 'pending', 'published', 'rejected', 'archived'], true) ? $requestedStatus : 'published';
                $blogData['published_at'] = ($blogData['status'] === 'published') ? ($_POST['published_at'] ?: date('Y-m-d H:i:s')) : null;
                $blogData['author_id'] = $isEdit ? ($existing['author_id'] ?: (int)$_SESSION['user_id']) : (int)$_SESSION['user_id'];
            } else {
                // Non-admin roles (including Super Admin and Authors):
                // Submitting as published automatically converts to pending for Admin (Pradeep Sarang) approval
                if ($requestedStatus === 'draft') {
                    $blogData['status'] = 'draft';
                    $blogData['published_at'] = null;
                } else {
                    $blogData['status'] = 'pending';
                    $blogData['published_at'] = null;
                }
                $blogData['author_id'] = $isEdit ? ($existing['author_id'] ?: (int)$_SESSION['user_id']) : (int)$_SESSION['user_id'];
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

            // Auto-generate SEO metadata if left blank
            $blogData = $blogModel->autoGenerateSeoMeta($blogData, $categoryModel);

            try {
                if ($isEdit) {
                    $blogModel->update($id, $blogData);
                    $userModel->logAudit((int)$_SESSION['user_id'], 'Blog Updated: ' . $id, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                    
                    // Trigger notification if submitted for review
                    if ($blogData['status'] === 'pending' && ($existing['status'] ?? '') !== 'pending') {
                        $admins = $userModel->all();
                        foreach ($admins as $adm) {
                            if ($adm['role'] === 'admin') {
                                $userModel->addNotification((int)$adm['id'], 'Blog Submission', 'Blog "' . $blogData['title'] . '" was submitted by ' . $_SESSION['user_name'] . ' for Admin approval.');
                            }
                        }
                    }

                    if ($blogData['status'] === 'pending') {
                        flash('admin_success', 'Blog article saved & submitted for Admin (Pradeep Sarang) approval.');
                    } else {
                        flash('admin_success', 'Blog article updated successfully.');
                    }
                } else {
                    $newBlogId = $blogModel->create($blogData);
                    $userModel->logAudit((int)$_SESSION['user_id'], 'Blog Created: ' . $newBlogId, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                    
                    if ($blogData['status'] === 'pending') {
                        $admins = $userModel->all();
                        foreach ($admins as $adm) {
                            if ($adm['role'] === 'admin') {
                                $userModel->addNotification((int)$adm['id'], 'Blog Submission', 'Blog "' . $blogData['title'] . '" was submitted by ' . $_SESSION['user_name'] . ' for Admin approval.');
                            }
                        }
                        flash('admin_success', 'Blog article created & submitted for Admin (Pradeep Sarang) approval.');
                    } else {
                        flash('admin_success', 'Blog article created and published by Admin.');
                    }
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
            'entry_type' => trim($_POST['entry_type'] ?? 'yatra'),
            'category' => trim($_POST['category'] ?? 'social'),
            'year' => trim($_POST['year'] ?? ''),
            'title' => trim($_POST['title'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
        ];

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
        $data['image'] = $imagePath;

        if (empty($data['year']) || empty($data['title'])) {
            flash('admin_error', 'Year and Title are required.');
        } else {
            try {
                if ($isEdit) {
                    $content->updateTimeline($id, $data);
                    flash('admin_success', ($data['entry_type'] === 'award' ? 'Samman / Puraskar' : 'Seva Yatra') . ' entry updated successfully.');
                } else {
                    $content->createTimeline($data);
                    flash('admin_success', ($data['entry_type'] === 'award' ? 'Samman / Puraskar' : 'Seva Yatra') . ' entry added successfully.');
                }
            } catch (Throwable $e) {
                flash('admin_error', 'Entry error: ' . $e->getMessage());
            }
            redirect('/admin/index.php?module=timeline&filter_type=' . urlencode($data['entry_type']));
        }
    }

    if ($loggedIn && ($_POST['action'] ?? '') === 'delete_timeline') {
        $id = (int)($_POST['id'] ?? 0);
        $filterType = trim($_POST['filter_type'] ?? 'all');
        try {
            $content->deleteTimeline($id);
            flash('admin_success', 'Entry deleted successfully.');
        } catch (Throwable $e) {
            flash('admin_error', 'Delete failed: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=timeline&filter_type=' . urlencode($filterType));
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
            'is_primary' => isset($_POST['is_primary']) && $_POST['is_primary'] == '1' ? 1 : 0,
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
            'category' => trim($_POST['category'] ?? 'unity'),
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

    if ($loggedIn && ($_POST['action'] ?? '') === 'set_primary_campaign') {
        $id = (int)($_POST['id'] ?? 0);
        try {
            $content->setPrimaryCampaign($id);
            flash('admin_success', 'Campaign set as Primary Flagship Campaign.');
        } catch (Throwable $e) {
            flash('admin_error', 'Failed to set primary campaign: ' . $e->getMessage());
        }
        redirect('/admin/index.php?module=campaigns');
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
        if (!is_role('super_admin', 'admin')) {
            http_response_code(403);
            exit('Unauthorized access.');
        }

        $data = [
            'site_tagline' => trim($_POST['site_tagline'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'facebook' => trim($_POST['facebook'] ?? ''),
            'twitter' => trim($_POST['twitter'] ?? ''),
            'whatsapp' => trim($_POST['whatsapp'] ?? ''),
            'linkedin' => trim($_POST['linkedin'] ?? ''),
            'telegram' => trim($_POST['telegram'] ?? ''),
            'instagram' => trim($_POST['instagram'] ?? ''),
            'youtube' => trim($_POST['youtube'] ?? ''),
            'social_hashtags' => trim($_POST['social_hashtags'] ?? '#PradeepSarang #AwadhiLiterature #GreenGang'),
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

    // Blog Status Updates (Approval / Rejection workflow - Restricted to Admin Pradeep Sarang)
    if ($loggedIn && ($_POST['action'] ?? '') === 'update_blog_status') {
        if (is_role('admin')) {
            $id = (int)($_POST['id'] ?? 0);
            $status = $_POST['status'] ?? '';
            $reason = trim($_POST['rejection_reason'] ?? '');
            
            $blog = $blogModel->find($id);
            if ($blog && in_array($status, ['published', 'rejected', 'archived', 'draft'], true)) {
                $updateData = $blog;
                $updateData['status'] = $status;
                $updateData['author'] = 'प्रदीप सारंग';
                if ($status === 'published') {
                    $updateData['published_at'] = date('Y-m-d H:i:s');
                }
                $blogModel->update($id, $updateData);
                
                $userModel->logAudit((int)$_SESSION['user_id'], 'Blog status updated by Admin (Pradeep Sarang) to ' . $status . ': ' . $id, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
                
                // Notify the author/creator
                if (!empty($blog['author_id'])) {
                    if ($status === 'published') {
                        $userModel->addNotification((int)$blog['author_id'], 'Blog Approved & Published', 'Your blog "' . $blog['title'] . '" has been approved and published by Admin (Pradeep Sarang).');
                    } elseif ($status === 'rejected') {
                        $msg = 'Your blog "' . $blog['title'] . '" was rejected.';
                        if (!empty($reason)) {
                            $msg .= ' Reason: ' . $reason;
                        }
                        $userModel->addNotification((int)$blog['author_id'], 'Blog Rejected', $msg);
                    }
                }
                flash('admin_success', 'Blog article approved and marked as ' . ucfirst($status) . ' by Admin (Pradeep Sarang).');
            } else {
                flash('admin_error', 'Invalid blog or status.');
            }
        } else {
            flash('admin_error', 'Unauthorized: Only Admin (Pradeep Sarang) can approve or publish blog articles.');
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

    // Role-based Module Access Update (Super Admin)
    if ($loggedIn && ($_POST['action'] ?? '') === 'update_role_permissions') {
        if (!is_role('super_admin')) {
            http_response_code(403);
            exit('Unauthorized access: Only Super Admins can manage role permissions.');
        }

        $permissions = [
            'super_admin' => ['dashboard', 'authors', 'timeline', 'blogs', 'events', 'campaigns', 'donations', 'donation_settings', 'gallery', 'newspaper', 'volunteers', 'role_access', 'settings', 'audit_logs'],
            'admin'       => $_POST['perm_admin'] ?? [],
            'author'      => $_POST['perm_author'] ?? [],
        ];

        if (!in_array('dashboard', $permissions['admin'], true)) $permissions['admin'][] = 'dashboard';
        if (!in_array('dashboard', $permissions['author'], true)) $permissions['author'][] = 'dashboard';
        if (!in_array('profile', $permissions['author'], true)) $permissions['author'][] = 'profile';
        if (!in_array('change_password', $permissions['author'], true)) $permissions['author'][] = 'change_password';

        $userModel->updateRolePermissions($permissions);
        $userModel->logAudit((int)$_SESSION['user_id'], 'Role Permissions Updated', $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
        flash('admin_success', 'Role-based module access settings updated successfully.');
        redirect('/admin/index.php?module=role_access');
    }

    // Ajax notifications read handler
    if ($loggedIn && ($_POST['action'] ?? '') === 'mark_notifications_read') {
        $userModel->markNotificationsRead((int)$_SESSION['user_id']);
        json_response(['status' => 'success']);
    }

    // Ajax social accounts config handler
    if ($loggedIn && ($_POST['action'] ?? '') === 'update_social_config') {
        $socialData = [
            'facebook' => trim($_POST['facebook'] ?? ''),
            'twitter' => trim($_POST['twitter'] ?? ''),
            'whatsapp' => trim($_POST['whatsapp'] ?? ''),
            'linkedin' => trim($_POST['linkedin'] ?? ''),
            'telegram' => trim($_POST['telegram'] ?? ''),
            'social_hashtags' => trim($_POST['social_hashtags'] ?? '#PradeepSarang #AwadhiLiterature #GreenGang'),
        ];
        $content->updateSettings($socialData);
        $userModel->logAudit((int)$_SESSION['user_id'], 'Social Accounts Configured', $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
        json_response(['status' => 'success', 'data' => $socialData]);
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
                    <a href="?module=authors" class="<?= $module === 'authors' ? 'active' : '' ?>"><i class="fa-solid fa-user-pen me-1"></i> Authors & Writers</a>
                    <a href="?module=timeline&filter_type=yatra" class="<?= $module === 'timeline' && ($_GET['filter_type'] ?? '') === 'yatra' ? 'active' : '' ?>"><i class="fa-solid fa-route me-1"></i> Seva Yatra</a>
                    <a href="?module=timeline&filter_type=award" class="<?= $module === 'timeline' && ($_GET['filter_type'] ?? '') === 'award' ? 'active' : '' ?>"><i class="fa-solid fa-award me-1"></i> Samman & Puraskar</a>
                    <a href="?module=timeline" class="<?= $module === 'timeline' && !isset($_GET['filter_type']) ? 'active' : '' ?>">All Timeline Entries</a>
                    <a href="?module=blogs" class="<?= $module === 'blogs' ? 'active' : '' ?>">Blogs</a>
                    <a href="?module=events" class="<?= $module === 'events' ? 'active' : '' ?>">Events</a>
                    <a href="?module=campaigns" class="<?= $module === 'campaigns' ? 'active' : '' ?>">Campaigns</a>
                    <a href="?module=donations" class="<?= $module === 'donations' ? 'active' : '' ?>">Donations</a>
                    <a href="?module=donation_settings" class="<?= $module === 'donation_settings' ? 'active' : '' ?>">Donation Settings</a>
                    <a href="?module=gallery" class="<?= $module === 'gallery' ? 'active' : '' ?>">Gallery Bank</a>
                    <a href="?module=newspaper" class="<?= $module === 'newspaper' ? 'active' : '' ?>">Newspaper Cuttings</a>
                    <a href="?module=volunteers" class="<?= $module === 'volunteers' ? 'active' : '' ?>">Volunteers</a>
                    <a href="?module=authors" class="<?= $module === 'authors' ? 'active' : '' ?>"><i class="fa-solid fa-users-gear me-1"></i> Manage Users / Roles</a>
                    <?php if (is_role('super_admin')): ?>
                        <a href="?module=role_access" class="<?= $module === 'role_access' ? 'active' : '' ?>"><i class="fa-solid fa-user-shield me-1"></i> Role Access Control</a>
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
                $filterType = trim($_GET['filter_type'] ?? 'all');
                $timeline = $content->getTimeline($filterType);
                $success = flash('admin_success');
                $editId = (int)($_GET['edit_id'] ?? 0);
                $editTimeline = $editId > 0 ? $content->findTimeline($editId) : null;
                $defaultType = $editTimeline['entry_type'] ?? ($filterType !== 'all' ? $filterType : 'yatra');
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h2 class="mb-1">
                                <?php if ($filterType === 'yatra'): ?>
                                    <i class="fa-solid fa-route text-primary me-2"></i>Seva Yatra Details (सेवा यात्रा)
                                <?php elseif ($filterType === 'award'): ?>
                                    <i class="fa-solid fa-award text-warning me-2"></i>Samman & Puraskar (सम्मान व पुरस्कार)
                                <?php else: ?>
                                    Seva Yatra & Awards Management
                                <?php endif; ?>
                            </h2>
                            <p class="text-muted mb-0 small">Manage timeline milestones, Seva Yatra events, and honors/awards.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#timelineForm">
                                <i class="fa-solid <?= $editTimeline ? 'fa-pen-to-square' : 'fa-plus' ?> me-1"></i><?= $editTimeline ? 'Editing Entry' : 'Add New Entry' ?>
                            </button>
                        </div>
                    </div>

                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link <?= $filterType === 'all' ? 'active fw-bold' : '' ?>" href="?module=timeline&filter_type=all">
                                All Entries
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $filterType === 'yatra' ? 'active fw-bold' : '' ?>" href="?module=timeline&filter_type=yatra">
                                <i class="fa-solid fa-route me-1 text-primary"></i> Seva Yatra Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $filterType === 'award' ? 'active fw-bold' : '' ?>" href="?module=timeline&filter_type=award">
                                <i class="fa-solid fa-award me-1 text-warning"></i> Samman & Puraskar
                            </a>
                        </li>
                    </ul>

                    <div class="collapse mb-4 <?= $editTimeline ? 'show' : '' ?>" id="timelineForm">
                        <div class="card card-body shadow-sm">
                            <h5 class="card-title mb-3"><?= $editTimeline ? 'Edit Entry' : 'Create New Entry' ?></h5>
                            <form method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="<?= $editTimeline ? 'update_timeline' : 'create_timeline' ?>">
                                <input type="hidden" name="filter_type" value="<?= e($filterType) ?>">
                                <?php if ($editTimeline): ?>
                                    <input type="hidden" name="id" value="<?= $editTimeline['id'] ?>">
                                    <input type="hidden" name="existing_image" value="<?= e($editTimeline['image'] ?? '') ?>">
                                <?php endif; ?>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Entry Type *</label>
                                        <select name="entry_type" class="form-select" required>
                                            <option value="yatra" <?= $defaultType === 'yatra' ? 'selected' : '' ?>>🚩 Seva Yatra Detail (सेवा यात्रा)</option>
                                            <option value="award" <?= $defaultType === 'award' ? 'selected' : '' ?>>🏆 Samman & Puraskar (सम्मान व पुरस्कार)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Category *</label>
                                        <select name="category" class="form-select">
                                            <option value="social" <?= ($editTimeline['category'] ?? 'social') === 'social' ? 'selected' : '' ?>>सामाजिक सेवा (Social Service)</option>
                                            <option value="national" <?= ($editTimeline['category'] ?? '') === 'national' ? 'selected' : '' ?>>राष्ट्रीय सम्मान (National Honor)</option>
                                            <option value="literary" <?= ($editTimeline['category'] ?? '') === 'literary' ? 'selected' : '' ?>>भाषा व साहित्य (Language & Literature)</option>
                                            <option value="environment" <?= ($editTimeline['category'] ?? '') === 'environment' ? 'selected' : '' ?>>पर्यावरण व जल (Environment & Nature)</option>
                                            <option value="yatra" <?= ($editTimeline['category'] ?? '') === 'yatra' ? 'selected' : '' ?>>सेवा यात्रा (Journey Milestone)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Year / Time Period *</label>
                                        <input type="text" name="year" class="form-control" value="<?= e($editTimeline['year'] ?? '') ?>" placeholder="e.g. 2024, 1987, 2020-2022" required>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Title / Honor Name *</label>
                                        <input type="text" name="title" class="form-control" value="<?= e($editTimeline['title'] ?? '') ?>" placeholder="e.g. राष्ट्रीय सेवा योजना सम्मान / जन-चेतना यात्रा" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Display Sort Order</label>
                                        <input type="number" name="sort_order" class="form-control" value="<?= e((string)($editTimeline['sort_order'] ?? 0)) ?>" placeholder="0">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Image / Photo (Optional)</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        <?php if (!empty($editTimeline['image'])): ?>
                                            <div class="form-text mt-1">Current: <?= e($editTimeline['image']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Description & Citation Details</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="Provide full details of the Seva Yatra milestone or Samman/Puraskar citation..."><?= e($editTimeline['description'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary"><?= $editTimeline ? 'Update Entry' : 'Add Entry' ?></button>
                                        <a href="?module=timeline&filter_type=<?= urlencode($filterType) ?>" class="btn btn-outline-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Year</th>
                                    <th>Title & Category</th>
                                    <th>Image</th>
                                    <th>Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($timeline)): ?>
                                    <tr><td colspan="6" class="text-center py-4 text-muted">No entries found for this filter.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($timeline as $t): ?>
                                        <tr>
                                            <td>
                                                <?php if (($t['entry_type'] ?? 'yatra') === 'award'): ?>
                                                    <span class="badge text-bg-warning text-dark"><i class="fa-solid fa-award me-1"></i>Samman & Puraskar</span>
                                                <?php else: ?>
                                                    <span class="badge text-bg-primary"><i class="fa-solid fa-route me-1"></i>Seva Yatra</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><strong><?= e($t['year']) ?></strong></td>
                                            <td>
                                                <div class="fw-bold"><?= e($t['title']) ?></div>
                                                <small class="badge text-bg-light border text-secondary me-1"><?= e(ucfirst($t['category'] ?? 'social')) ?></small>
                                                <?php if (!empty($t['description'])): ?>
                                                    <small class="text-muted d-block text-truncate" style="max-width:300px;"><?= e($t['description']) ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($t['image'])): ?>
                                                    <img src="<?= e(base_url($t['image'])) ?>" alt="" class="img-thumbnail" style="height:40px; object-fit:cover;">
                                                <?php else: ?>
                                                    <span class="text-muted small">None</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= e((string)$t['sort_order']) ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="?module=timeline&filter_type=<?= urlencode($filterType) ?>&edit_id=<?= $t['id'] ?>#timelineForm" class="btn btn-sm btn-outline-dark">Edit</a>
                                                    <form method="post" onsubmit="return confirm('Delete this entry?')" class="d-inline">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="action" value="delete_timeline">
                                                        <input type="hidden" name="filter_type" value="<?= e($filterType) ?>">
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
                $action = $_GET['action'] ?? '';
                $editId = (int)($_GET['edit_id'] ?? 0);
                $isCreateOrEdit = ($action === 'create' || $editId > 0);

                $blogs = is_role('author') 
                    ? $blogModel->all(100, 0, (int)$_SESSION['user_id']) 
                    : $blogModel->all(100, 0);
                $categories = $categoryModel->all();
                $success = flash('admin_success');

                $editBlog = $editId > 0 ? $blogModel->find($editId) : null;
                
                // Enforce author edit restrictions
                if ($editBlog && is_role('author') && (int)$editBlog['author_id'] !== (int)$_SESSION['user_id']) {
                    $editBlog = null;
                    flash('admin_error', 'Unauthorized access: You do not own this blog post.');
                    $isCreateOrEdit = false;
                }
                ?>

                <?php if ($isCreateOrEdit): ?>
                    <!-- DEDICATED FULL-PAGE CREATE / EDIT BLOG EDITOR -->
                    <div class="admin-card mb-4">
                        <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                        <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>

                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4 pb-3 border-bottom">
                            <div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-1 small">
                                        <li class="breadcrumb-item"><a href="?module=blogs" class="text-decoration-none">Blogs</a></li>
                                        <li class="breadcrumb-item active"><?= $editBlog ? 'Edit Post' : 'Create New Article' ?></li>
                                    </ol>
                                </nav>
                                <h2 class="mb-0 fw-bold"><i class="fa-solid <?= $editBlog ? 'fa-pen-to-square text-primary' : 'fa-plus-circle text-success' ?> me-2"></i><?= $editBlog ? 'Edit Blog Article' : 'Create New Blog Article' ?></h2>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="?module=blogs" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back to Blogs List</a>
                            </div>
                        </div>

                        <form method="post" enctype="multipart/form-data" id="createBlogForm">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="<?= $editBlog ? 'update_blog' : 'create_blog' ?>">
                            <?php if ($editBlog): ?>
                                <input type="hidden" name="id" value="<?= $editBlog['id'] ?>">
                                <input type="hidden" name="existing_banner" value="<?= e($editBlog['banner_image']) ?>">
                            <?php endif; ?>

                            <div class="row g-4">
                                <!-- Main Content (Left Column) -->
                                <div class="col-lg-8">
                                    <div class="card card-body border shadow-xs mb-4">
                                        <h5 class="card-title mb-3 text-primary"><i class="fa-solid fa-file-pen me-2"></i>Article Information</h5>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label font-semibold">Title (Hindi) *</label>
                                                <input type="text" name="title" class="form-control form-control-lg" value="<?= e($editBlog['title'] ?? '') ?>" required placeholder="e.g. हरियाली संकल्प और पर्यावरण संरक्षण..." onkeyup="updateLiveSEOPreview()">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label font-semibold">English Title (For Slug Generation) *</label>
                                                <input type="text" name="en_title" class="form-control" value="<?= e($editBlog['en_title'] ?? '') ?>" required placeholder="e.g. Hariyali Pledge and Environmental Protection">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Category *</label>
                                                <select name="category_id" class="form-select" required onchange="autoGenerateSEOMetaFields()">
                                                    <option value="">Select Category</option>
                                                    <?php foreach ($categories as $cat): ?>
                                                        <option value="<?= $cat['id'] ?>" <?= ($editBlog && $editBlog['category_id'] == $cat['id']) ? 'selected' : '' ?>><?= e($cat['name']) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">URL Slug <small class="text-muted">(Auto-generated if left blank)</small></label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text"><?= e(base_url('/blog/')) ?></span>
                                                    <input type="text" name="slug" class="form-control" value="<?= e($editBlog['slug'] ?? '') ?>" placeholder="article-url-slug" onkeyup="updateLiveSEOPreview()">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label font-semibold">Excerpt / Summary</label>
                                                <textarea name="excerpt" class="form-control" rows="3" placeholder="Brief 2-3 sentence overview of the article..." onkeyup="updateLiveSEOPreview()"><?= e($editBlog['excerpt'] ?? '') ?></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label font-semibold">Full Content *</label>
                                                <textarea name="content" id="blogContentEditor" class="form-control" rows="12"><?= e($editBlog['content'] ?? '') ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SEO & Meta Card -->
                                    <div class="card card-body border shadow-xs">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                                            <div>
                                                <h5 class="card-title mb-0 text-secondary"><i class="fa-solid fa-searchengin me-2 text-primary"></i> SEO & Meta Information</h5>
                                                <small class="text-muted"><i class="fa-solid fa-wand-magic-sparkles me-1 text-success"></i> Auto-generated on save if left blank.</small>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="autoGenerateSEOMetaFields()"><i class="fa-solid fa-wand-magic-sparkles me-1"></i> Auto-Fill SEO Meta Now</button>
                                        </div>

                                        <!-- Google Live Preview Widget -->
                                        <div class="bg-light border rounded p-3 mb-3" id="googleSeoPreview">
                                            <div class="small text-muted mb-1 font-monospace"><i class="fa-brands fa-google text-primary me-1"></i> Google Search Snippet Preview</div>
                                            <div class="text-primary fw-bold fs-6 text-truncate" id="pvSeoTitle">
                                                <?= e($editBlog['seo_title'] ?? (($editBlog['title'] ?? 'Article Title') . ' | ' . app_config('name'))) ?>
                                            </div>
                                            <div class="text-success small text-truncate" id="pvCanonical">
                                                <?= e($editBlog['canonical_url'] ?? base_url('/blog/' . ($editBlog['slug'] ?? 'post-slug'))) ?>
                                            </div>
                                            <div class="text-muted small" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" id="pvMetaDesc">
                                                <?= e($editBlog['meta_description'] ?? ($editBlog['excerpt'] ?? 'Brief search engine snippet preview will appear here as you write your post content.')) ?>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">SEO Title</label>
                                                <input type="text" name="seo_title" class="form-control" value="<?= e($editBlog['seo_title'] ?? '') ?>" placeholder="Auto-generated from Title if blank..." onkeyup="updateLiveSEOPreview()">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Canonical URL</label>
                                                <input type="url" name="canonical_url" class="form-control" value="<?= e($editBlog['canonical_url'] ?? '') ?>" placeholder="Auto-generated canonical link..." onkeyup="updateLiveSEOPreview()">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Meta Keywords</label>
                                                <input type="text" name="meta_keywords" class="form-control" value="<?= e($editBlog['meta_keywords'] ?? '') ?>" placeholder="key1, key2, key3...">
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
                                                <textarea name="meta_description" class="form-control" rows="2" placeholder="Auto-extracted search engine snippet if blank..." onkeyup="updateLiveSEOPreview()"><?= e($editBlog['meta_description'] ?? '') ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sidebar Controls (Right Column) -->
                                <div class="col-lg-4">
                                    <!-- Publishing & Status Card -->
                                    <div class="card card-body border shadow-xs mb-4">
                                        <h5 class="card-title mb-3 text-secondary"><i class="fa-solid fa-paper-plane me-2"></i> Publish Settings</h5>
                                        <div class="mb-3">
                                            <label class="form-label font-semibold">Post Status *</label>
                                            <select name="status" class="form-select" required>
                                                <?php if (is_role('admin')): ?>
                                                    <option value="published" <?= ($editBlog && $editBlog['status'] === 'published') ? 'selected' : '' ?>>Approve & Publish (Admin)</option>
                                                    <option value="pending" <?= ($editBlog && $editBlog['status'] === 'pending') ? 'selected' : '' ?>>Pending Admin Approval</option>
                                                    <option value="draft" <?= ($editBlog && $editBlog['status'] === 'draft') ? 'selected' : '' ?>>Draft</option>
                                                    <option value="rejected" <?= ($editBlog && $editBlog['status'] === 'rejected') ? 'selected' : '' ?>>Rejected</option>
                                                    <option value="archived" <?= ($editBlog && $editBlog['status'] === 'archived') ? 'selected' : '' ?>>Archived</option>
                                                <?php else: ?>
                                                    <option value="pending" <?= ($editBlog && $editBlog['status'] === 'pending') ? 'selected' : '' ?>>Submit for Admin Approval (Pending)</option>
                                                    <option value="draft" <?= ($editBlog && $editBlog['status'] === 'draft') ? 'selected' : '' ?>>Draft</option>
                                                <?php endif; ?>
                                            </select>
                                            <?php if (!is_role('admin')): ?>
                                                <div class="alert alert-info py-2 px-3 small mt-2 mb-0">
                                                    <i class="fa-solid fa-shield-halved me-1 text-primary"></i> <strong>Admin Approval Required:</strong> All articles (including Super Admin) are submitted to Admin <strong>Pradeep Sarang</strong> for approval before being published.
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-semibold">Author Name</label>
                                            <input type="text" name="author" class="form-control" value="<?= e($editBlog ? ($editBlog['author'] ?: ($editBlog['author_name'] ?: $_SESSION['user_name'])) : ($_SESSION['user_name'] ?? 'प्रदीप सारंग')) ?>" placeholder="Author Name">
                                            <small class="text-muted">Display name of the author writing this article.</small>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary py-2 font-semibold"><i class="fa-solid fa-floppy-disk me-1"></i> <?= $editBlog ? 'Update Blog Post' : 'Save Blog Post' ?></button>
                                            <a href="?module=blogs" class="btn btn-outline-secondary">Cancel</a>
                                        </div>
                                    </div>

                                    <!-- Featured Image / Banner Card -->
                                    <div class="card card-body border shadow-xs mb-4">
                                        <h5 class="card-title mb-3 text-secondary"><i class="fa-solid fa-image me-2"></i> Featured Image / Banner</h5>
                                        <?php if ($editBlog && $editBlog['banner_image']): ?>
                                            <div class="mb-3 text-center">
                                                <img src="<?= e(base_url($editBlog['banner_image'])) ?>" class="img-fluid rounded border mb-2" style="max-height: 180px; object-fit: cover;">
                                                <div class="small text-muted">Current image</div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="mb-3">
                                            <label class="form-label">Upload New Image</label>
                                            <input type="file" name="banner_image" class="form-control" accept="image/*">
                                            <div class="form-text">Recommended resolution: 1200x630 (JPEG, PNG, WebP)</div>
                                        </div>
                                    </div>

                                    <!-- Social Media Quick Publish Card -->
                                    <div class="card card-body border shadow-xs" id="socialPublishPanel">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="card-title mb-0 text-primary"><i class="fa-solid fa-share-nodes me-2"></i> Social Media Publishing</h5>
                                            <a href="index.php?module=settings#social-settings" class="btn btn-sm btn-outline-primary py-1 px-2" title="Configure accounts in Settings module"><i class="fa-solid fa-gear me-1"></i> Configure</a>
                                        </div>
                                        <p class="small text-muted mb-3">Publish and share this story directly to social media platforms:</p>
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-outline-primary text-start btn-sm d-flex justify-content-between align-items-center" onclick="triggerFormSocialPublish('facebook')">
                                                <span><i class="fa-brands fa-facebook me-2 text-primary"></i> Publish to Facebook</span>
                                                <span class="badge bg-light text-primary border font-monospace small" id="badge_fb_status"><?= !empty($settings['facebook']) ? 'Configured' : 'Setup' ?></span>
                                            </button>
                                            <button type="button" class="btn btn-outline-dark text-start btn-sm d-flex justify-content-between align-items-center" onclick="triggerFormSocialPublish('twitter')">
                                                <span><i class="fa-brands fa-x-twitter me-2"></i> Publish to Twitter / X</span>
                                                <span class="badge bg-light text-dark border font-monospace small" id="badge_tw_status"><?= !empty($settings['twitter']) ? e($settings['twitter']) : 'Setup' ?></span>
                                            </button>
                                            <button type="button" class="btn btn-outline-success text-start btn-sm d-flex justify-content-between align-items-center" onclick="triggerFormSocialPublish('whatsapp')">
                                                <span><i class="fa-brands fa-whatsapp me-2 text-success"></i> Share via WhatsApp</span>
                                                <span class="badge bg-light text-success border font-monospace small" id="badge_wa_status"><?= (!empty($settings['whatsapp']) || !empty($settings['phone'])) ? 'Configured' : 'Setup' ?></span>
                                            </button>
                                            <button type="button" class="btn btn-outline-info text-start btn-sm d-flex justify-content-between align-items-center" onclick="triggerFormSocialPublish('linkedin')">
                                                <span><i class="fa-brands fa-linkedin me-2 text-info"></i> Share to LinkedIn</span>
                                                <span class="badge bg-light text-info border font-monospace small" id="badge_ln_status"><?= !empty($settings['linkedin']) ? 'Configured' : 'Setup' ?></span>
                                            </button>
                                            <button type="button" class="btn btn-light border text-start btn-sm d-flex justify-content-between align-items-center" onclick="copyFormSocialCopy()">
                                                <span><i class="fa-solid fa-copy me-2 text-secondary"></i> Copy Post Text & Link</span>
                                                <span class="badge bg-white text-muted border font-monospace small">Clipboard</span>
                                            </button>
                                            <a href="index.php?module=settings#social-settings" class="btn btn-sm btn-link text-primary text-start mt-1 p-0 text-decoration-none"><i class="fa-solid fa-sliders me-1"></i> Configure Social Accounts in Settings Module</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <!-- LISTING VIEW FOR BLOGS -->
                    <div class="admin-card">
                        <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                        <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="mb-0"><i class="fa-solid fa-newspaper me-2 text-primary"></i> Blogs & Writings Management</h2>
                                <p class="text-muted small mb-0">Manage published articles, drafts, and Admin approvals</p>
                            </div>
                            <a href="?module=blogs&action=create" class="btn btn-dark"><i class="fa-solid fa-plus me-2"></i>Create New Blog</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($blogs)): ?>
                                        <tr><td colspan="6" class="text-center py-4 text-muted">No blogs found.</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($blogs as $b): ?>
                                            <tr>
                                                <td>
                                                    <strong><?= e($b['title']) ?></strong>
                                                    <?php if ($b['slug']): ?><br><small class="text-muted">Slug: <?= e($b['slug']) ?></small><?php endif; ?>
                                                </td>
                                                <td><span class="badge text-bg-light border"><?= e($b['category_name'] ?? 'Uncategorized') ?></span></td>
                                                <td><span class="fw-semibold text-success"><i class="fa-solid fa-feather me-1"></i><?= e($b['author'] ?: ($b['author_name'] ?: 'प्रदीप सारंग')) ?></span></td>
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
                                                    $statusLabel = ($b['status'] === 'pending') ? 'Pending Admin Approval' : ucfirst($b['status']);
                                                    ?>
                                                    <span class="badge text-bg-<?= $badgeClass ?>"><?= e($statusLabel) ?></span>
                                                </td>
                                                <td><span class="small text-muted"><?= date('d M Y', strtotime($b['created_at'])) ?></span></td>
                                                <td class="text-end">
                                                    <div class="d-flex justify-content-end gap-2 align-items-center">
                                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="openSocialShareModal(<?= htmlspecialchars(json_encode([
                                                            'id' => $b['id'],
                                                            'title' => $b['title'],
                                                            'excerpt' => $b['excerpt'] ?: ps_excerpt($b['content'] ?? '', 120),
                                                            'url' => base_url('/blog/' . ($b['slug'] ?? ''))
                                                        ]), ENT_QUOTES, 'UTF-8') ?>)" title="Publish story to social media">
                                                            <i class="fa-solid fa-share-nodes me-1"></i> Share Social
                                                        </button>

                                                        <a href="?module=blogs&edit_id=<?= $b['id'] ?>" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-pen-to-square me-1"></i> Edit</a>
                                                        
                                                        <?php if (is_role('admin') && $b['status'] !== 'published'): ?>
                                                            <form method="post" class="d-inline">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="action" value="update_blog_status">
                                                                <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                                                <input type="hidden" name="status" value="published">
                                                                <button type="submit" class="btn btn-sm btn-success" title="Approve and publish by Admin Pradeep Sarang"><i class="fa-solid fa-circle-check me-1"></i> Approve & Publish</button>
                                                            </form>
                                                        <?php endif; ?>

                                                        <?php if (is_role('admin') && $b['status'] === 'pending'): ?>
                                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="rejectBlog(<?= $b['id'] ?>)">Reject</button>
                                                        <?php endif; ?>

                                                        <?php if (!is_role('author') || $b['status'] !== 'published'): ?>
                                                            <form method="post" onsubmit="return confirm('Delete this blog?')" class="d-inline">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="action" value="delete_blog">
                                                                <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
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
                <?php endif; ?>
                
                <script>
                function autoGenerateSEOMetaFields() {
                    const form = document.querySelector('#createBlogForm');
                    if (!form) return;
                    
                    const titleElem = form.querySelector('input[name="title"]');
                    const slugElem = form.querySelector('input[name="slug"]');
                    const excerptElem = form.querySelector('textarea[name="excerpt"]');
                    const contentElem = form.querySelector('textarea[name="content"]');
                    const categoryElem = form.querySelector('select[name="category_id"]');

                    const seoTitleElem = form.querySelector('input[name="seo_title"]');
                    const canonicalElem = form.querySelector('input[name="canonical_url"]');
                    const metaKwElem = form.querySelector('input[name="meta_keywords"]');
                    const metaDescElem = form.querySelector('textarea[name="meta_description"]');

                    const titleVal = titleElem ? titleElem.value.trim() : '';
                    const excerptVal = excerptElem ? excerptElem.value.trim() : '';
                    const contentVal = contentElem ? contentElem.value.replace(/<[^>]*>?/gm, '').trim() : '';
                    const catText = categoryElem && categoryElem.selectedIndex >= 0 ? categoryElem.options[categoryElem.selectedIndex].text : '';
                    const slugVal = slugElem ? slugElem.value.trim() : '';

                    if (titleVal) {
                        if (!seoTitleElem.value || seoTitleElem.dataset.auto === 'true') {
                            seoTitleElem.value = titleVal + ' | <?= e(app_config("name")) ?>';
                            seoTitleElem.dataset.auto = 'true';
                        }
                        
                        if (!metaKwElem.value || metaKwElem.dataset.auto === 'true') {
                            let kw = [titleVal];
                            if (catText && !catText.includes('Select')) kw.push(catText);
                            kw.push('प्रदीप सारंग', 'अवधी साहित्य', 'Pradeep Sarang', 'आलेख व विचार');
                            metaKwElem.value = Array.from(new Set(kw)).join(', ');
                            metaKwElem.dataset.auto = 'true';
                        }

                        if (!canonicalElem.value || canonicalElem.dataset.auto === 'true') {
                            const rawSlug = slugVal || titleVal.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                            canonicalElem.value = window.location.origin + '<?= e(base_url("/blog/")) ?>' + (rawSlug || 'article');
                            canonicalElem.dataset.auto = 'true';
                        }
                    }

                    const descSource = excerptVal || contentVal;
                    if (descSource && (!metaDescElem.value || metaDescElem.dataset.auto === 'true')) {
                        const clean = descSource.replace(/\s+/g, ' ').trim();
                        metaDescElem.value = clean.length > 160 ? clean.substring(0, 157) + '...' : clean;
                        metaDescElem.dataset.auto = 'true';
                    }

                    updateLiveSEOPreview();
                }

                function updateLiveSEOPreview() {
                    const form = document.querySelector('#createBlogForm');
                    if (!form) return;
                    
                    const titleVal = form.querySelector('input[name="title"]')?.value.trim() || 'Article Title';
                    const seoTitleVal = form.querySelector('input[name="seo_title"]')?.value.trim();
                    const slugVal = form.querySelector('input[name="slug"]')?.value.trim();
                    const canonicalVal = form.querySelector('input[name="canonical_url"]')?.value.trim();
                    const excerptVal = form.querySelector('textarea[name="excerpt"]')?.value.trim();
                    const metaDescVal = form.querySelector('textarea[name="meta_description"]')?.value.trim();

                    const pvTitle = document.getElementById('pvSeoTitle');
                    const pvUrl = document.getElementById('pvCanonical');
                    const pvDesc = document.getElementById('pvMetaDesc');

                    if (pvTitle) {
                        pvTitle.textContent = (seoTitleVal || (titleVal + ' | <?= e(app_config("name")) ?>'));
                    }
                    if (pvUrl) {
                        pvUrl.textContent = (canonicalVal || (window.location.origin + '<?= e(base_url("/blog/")) ?>' + (slugVal || titleVal.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, ''))));
                    }
                    if (pvDesc) {
                        pvDesc.textContent = (metaDescVal || excerptVal || 'Brief search engine snippet preview will appear here as you write your post content.');
                    }
                }

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
                                    <div class="col-md-8">
                                        <label class="form-label">Title (Hindi) *</label>
                                        <input type="text" name="title" class="form-control" value="<?= e($editCampaign['title'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Category *</label>
                                        <select name="category" class="form-select">
                                            <option value="unity" <?= ($editCampaign['category'] ?? 'unity') === 'unity' ? 'selected' : '' ?>>राष्ट्रीय एकता (Unity)</option>
                                            <option value="environment" <?= ($editCampaign['category'] ?? '') === 'environment' ? 'selected' : '' ?>>पर्यावरण व संरक्षण (Environment)</option>
                                            <option value="education" <?= ($editCampaign['category'] ?? '') === 'education' ? 'selected' : '' ?>>शिक्षा व कौशल (Education & Skills)</option>
                                            <option value="culture" <?= ($editCampaign['category'] ?? '') === 'culture' ? 'selected' : '' ?>>भाषा एवं संस्कृति (Language & Culture)</option>
                                            <option value="welfare" <?= ($editCampaign['category'] ?? '') === 'welfare' ? 'selected' : '' ?>>जन कल्याण (Social Welfare)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">English Title *</label>
                                        <input type="text" name="en_title" class="form-control" value="<?= e($editCampaign['en_title'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Display Sort Order</label>
                                        <input type="number" name="sort_order" class="form-control" value="<?= e((string)($editCampaign['sort_order'] ?? 0)) ?>" placeholder="0">
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
                                        <div class="form-check form-switch bg-light p-3 rounded border">
                                            <input class="form-check-input ms-0 me-2" type="checkbox" name="is_primary" value="1" id="isPrimaryCheck" <?= !empty($editCampaign['is_primary']) ? 'checked' : '' ?>>
                                            <label class="form-check-label fw-bold text-dark" for="isPrimaryCheck">
                                                <i class="fa-solid fa-star text-warning me-1"></i> Flagship / Primary Campaign
                                            </label>
                                            <div class="form-text text-muted">Selecting this sets the campaign as the #1 Flagship campaign across the website home page, presentation spotlight, and footer.</div>
                                        </div>
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
                            <thead><tr><th>Campaign Title</th><th>Category</th><th>Goal</th><th>Raised</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                <?php foreach ($campaigns as $c): ?>
                                    <tr class="<?= !empty($c['is_primary']) ? 'table-warning' : '' ?>">
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-bold"><?= e($c['title']) ?></span>
                                                <?php if (!empty($c['is_primary'])): ?>
                                                    <span class="badge text-bg-warning"><i class="fa-solid fa-star me-1"></i>Primary</span>
                                                <?php endif; ?>
                                            </div>
                                            <small class="text-muted"><?= e($c['en_title'] ?? '') ?> (<?= e($c['slug'] ?? '') ?>)</small>
                                        </td>
                                        <td><span class="badge text-bg-info"><?= e(ucfirst($c['category'] ?? 'unity')) ?></span></td>
                                        <td>₹<?= number_format((float)$c['goal_amount']) ?></td>
                                        <td>₹<?= number_format((float)$c['raised_amount']) ?></td>
                                        <td><span class="badge text-bg-<?= $c['status'] === 'active' ? 'success' : 'secondary' ?>"><?= ucfirst($c['status']) ?></span></td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <?php if (empty($c['is_primary'])): ?>
                                                    <form method="post" class="d-inline">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="action" value="set_primary_campaign">
                                                        <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="Set as Primary Campaign"><i class="fa-solid fa-star me-1"></i>Make Primary</button>
                                                    </form>
                                                <?php endif; ?>
                                                <a href="?module=campaigns&edit_id=<?= $c['id'] ?>#campaignForm" class="btn btn-sm btn-outline-dark">Edit</a>
                                                <form method="post" onsubmit="return confirm('Delete this cause?')" class="d-inline">
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

                $roleFilter = trim($_GET['role'] ?? '');
                $statusFilter = trim($_GET['status'] ?? '');
                $searchQuery = trim($_GET['q'] ?? '');
                $page = max(1, (int)($_GET['page'] ?? 1));
                $limit = max(1, min(50, (int)($_GET['limit'] ?? 5)));
                $offset = ($page - 1) * $limit;

                if (is_role('admin') && ($roleFilter === '' || $roleFilter === 'all')) {
                    $roleFilter = 'author';
                }

                $users = $userModel->getAdminUsersFiltered($roleFilter, $statusFilter, $searchQuery, $limit, $offset);
                $totalUsers = $userModel->getAdminUsersFilteredCount($roleFilter, $statusFilter, $searchQuery);
                $totalPages = max(1, (int)ceil($totalUsers / $limit));

                $success = flash('admin_success');
                $editId = (int)($_GET['edit_id'] ?? 0);
                $editUser = $editId > 0 ? $userModel->find($editId) : null;
                
                if ($editUser && is_role('admin') && $editUser['role'] !== 'author') {
                    $editUser = null;
                    flash('admin_error', 'Admins can only manage Author accounts.');
                }
                ?>
                <div class="admin-card mb-4">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                        <div>
                            <h2 class="mb-0"><i class="fa-solid fa-users me-2 text-primary"></i> Authors & User Management</h2>
                            <p class="text-muted small mb-0">View, filter, edit, and manage all authors, writers, advisors, and admin profiles</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="<?= e(base_url('/authors')) ?>" target="_blank" class="btn btn-outline-success"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Public Directory (/authors)</a>
                            <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#userForm"><?= $editUser ? 'Editing User' : '<i class="fa-solid fa-plus me-1"></i> Add New Author' ?></button>
                        </div>
                    </div>

                    <!-- Create / Edit Form Collapse -->
                    <div class="collapse mb-4 <?= $editUser ? 'show' : '' ?>" id="userForm">
                        <div class="card card-body bg-light border-0 shadow-sm">
                            <h4 class="h5 mb-3"><?= $editUser ? 'Edit User / Author Details' : 'Add New User / Author' ?></h4>
                            <form method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="<?= $editUser ? 'update_user' : 'create_user' ?>">
                                <?php if ($editUser): ?>
                                    <input type="hidden" name="id" value="<?= $editUser['id'] ?>">
                                <?php endif; ?>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" name="name" class="form-control" value="<?= e($editUser['name'] ?? '') ?>" required placeholder="e.g. Pradeep Sarang">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address *</label>
                                        <input type="email" name="email" class="form-control" value="<?= e($editUser['email'] ?? '') ?>" required placeholder="author@example.com">
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
                                                <option value="author" <?= ($editUser && $editUser['role'] === 'author') ? 'selected' : '' ?>>Author / Writer</option>
                                            <?php else: ?>
                                                <option value="author" selected>Author / Writer</option>
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
                                        <label class="form-label">Biography & Expertise</label>
                                        <textarea name="biography" class="form-control" rows="3" placeholder="Brief author bio, achievements and area of literature/social work"><?= e($editUser['biography'] ?? '') ?></textarea>
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

                    <!-- Filter Control Bar -->
                    <form method="get" action="index.php" class="bg-light p-3 rounded mb-3 border">
                        <input type="hidden" name="module" value="authors">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" name="q" class="form-control" placeholder="Search by name, email or bio..." value="<?= e($searchQuery) ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="role" class="form-select form-select-sm">
                                    <option value="all" <?= $roleFilter === '' || $roleFilter === 'all' ? 'selected' : '' ?>>All Roles</option>
                                    <option value="super_admin" <?= $roleFilter === 'super_admin' ? 'selected' : '' ?>>Super Admin</option>
                                    <option value="admin" <?= $roleFilter === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="author" <?= $roleFilter === 'author' ? 'selected' : '' ?>>Author / Writer</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-select form-select-sm">
                                    <option value="all" <?= $statusFilter === '' || $statusFilter === 'all' ? 'selected' : '' ?>>All Statuses</option>
                                    <option value="active" <?= $statusFilter === 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= $statusFilter === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <select name="limit" class="form-select form-select-sm" title="Per page">
                                    <option value="5" <?= $limit === 5 ? 'selected' : '' ?>>5 / page</option>
                                    <option value="10" <?= $limit === 10 ? 'selected' : '' ?>>10 / page</option>
                                    <option value="25" <?= $limit === 25 ? 'selected' : '' ?>>25 / page</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex gap-1">
                                <button type="submit" class="btn btn-sm btn-dark w-100"><i class="fa-solid fa-filter me-1"></i> Filter</button>
                                <a href="?module=authors" class="btn btn-sm btn-outline-secondary" title="Reset Filters"><i class="fa-solid fa-rotate-left"></i></a>
                            </div>
                        </div>
                    </form>

                    <!-- Authors Listing Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle border">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">Photo</th>
                                    <th>Author Details</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Bio / Expertise</th>
                                    <th>Last Login</th>
                                    <th class="text-end" style="width: 140px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($users)): ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">
                                            <i class="fa-solid fa-user-slash fs-3 d-block mb-2"></i>
                                            No authors match your filter criteria.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($users as $u): ?>
                                        <tr>
                                            <td>
                                                <img src="<?= !empty($u['profile_photo']) ? base_url($u['profile_photo']) : 'https://ui-avatars.com/api/?name=' . urlencode($u['name']) . '&background=15803d&color=fff' ?>" class="rounded-circle border" style="width:42px; height:42px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark"><?= e($u['name']) ?></div>
                                                <a href="<?= e(base_url('/authors?q=' . urlencode($u['name']))) ?>" target="_blank" class="small text-decoration-none text-muted" title="View public profile">
                                                    <i class="fa-solid fa-external-link text-success me-1" style="font-size: 10px;"></i>Public Profile
                                                </a>
                                            </td>
                                            <td><span class="small text-muted"><?= e($u['email']) ?></span></td>
                                            <td>
                                                <?php if ($u['role'] === 'super_admin'): ?>
                                                    <span class="badge text-bg-dark text-uppercase"><i class="fa-solid fa-crown me-1 text-warning"></i> Super Admin</span>
                                                <?php elseif ($u['role'] === 'admin'): ?>
                                                    <span class="badge text-bg-primary text-uppercase"><i class="fa-solid fa-user-shield me-1"></i> Admin</span>
                                                <?php else: ?>
                                                    <span class="badge text-bg-success text-uppercase"><i class="fa-solid fa-pen-nib me-1"></i> Author</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge text-bg-<?= ($u['status'] ?? 'active') === 'active' ? 'success' : 'secondary' ?>">
                                                    <?= ucfirst($u['status'] ?? 'active') ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="small text-muted" style="max-width: 240px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= e($u['biography'] ?? '') ?>">
                                                    <?= e($u['biography'] ?: 'No biography set.') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="small text-muted">
                                                    <?= !empty($u['last_login']) ? date('d M Y, H:i', strtotime($u['last_login'])) : 'Never' ?>
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex justify-content-end gap-1">
                                                    <a href="?module=authors&edit_id=<?= $u['id'] ?>#userForm" class="btn btn-sm btn-outline-dark" title="Edit Author">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <?php if ($u['role'] !== 'super_admin' || is_role('super_admin')): ?>
                                                        <form method="post" class="d-inline" onsubmit="return confirm('Delete author user? This action cannot be undone.')">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="action" value="delete_user">
                                                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Author">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
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

                    <!-- Pagination Bar -->
                    <?php if ($totalPages > 1): ?>
                        <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 border-top gap-2">
                            <div class="small text-muted">
                                Showing <strong><?= min($totalUsers, $offset + 1) ?></strong> to <strong><?= min($totalUsers, $offset + count($users)) ?></strong> of <strong><?= $totalUsers ?></strong> authors
                            </div>
                            <nav aria-label="Authors pagination">
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?module=authors&page=<?= $page - 1 ?>&role=<?= urlencode($roleFilter) ?>&status=<?= urlencode($statusFilter) ?>&q=<?= urlencode($searchQuery) ?>&limit=<?= $limit ?>">Previous</a>
                                    </li>
                                    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                                        <li class="page-item <?= $p === $page ? 'active' : '' ?>">
                                            <a class="page-link" href="?module=authors&page=<?= $p ?>&role=<?= urlencode($roleFilter) ?>&status=<?= urlencode($statusFilter) ?>&q=<?= urlencode($searchQuery) ?>&limit=<?= $limit ?>"><?= $p ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?module=authors&page=<?= $page + 1 ?>&role=<?= urlencode($roleFilter) ?>&status=<?= urlencode($statusFilter) ?>&q=<?= urlencode($searchQuery) ?>&limit=<?= $limit ?>">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>

            <?php elseif ($module === 'role_access'): ?>
                <?php
                if (!is_role('super_admin')) {
                    redirect('/admin/index.php?module=dashboard');
                }
                $allRolePermissions = $userModel->getRolePermissions();
                $allAvailableModules = [
                    'timeline'          => ['name' => 'Timeline, Seva Yatra & Awards', 'icon' => 'fa-route'],
                    'blogs'             => ['name' => 'Blog Posts & Articles', 'icon' => 'fa-newspaper'],
                    'events'            => ['name' => 'Events Management', 'icon' => 'fa-calendar-days'],
                    'campaigns'         => ['name' => 'Campaigns & Initiatives', 'icon' => 'fa-bullhorn'],
                    'donations'         => ['name' => 'Donation Records', 'icon' => 'fa-hand-holding-heart'],
                    'donation_settings' => ['name' => 'Donation Gateway Settings', 'icon' => 'fa-gear'],
                    'gallery'           => ['name' => 'Photo Gallery Bank', 'icon' => 'fa-images'],
                    'newspaper'         => ['name' => 'Newspaper Cuttings', 'icon' => 'fa-newspaper'],
                    'volunteers'        => ['name' => 'Volunteer Management', 'icon' => 'fa-users'],
                    'authors'           => ['name' => 'Authors & User Management', 'icon' => 'fa-user-pen'],
                    'settings'          => ['name' => 'SEO & Site Settings', 'icon' => 'fa-sliders'],
                    'audit_logs'        => ['name' => 'Security & Audit Logs', 'icon' => 'fa-shield-halved'],
                ];
                $success = flash('admin_success');
                ?>
                <div class="admin-card">
                    <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="mb-0"><i class="fa-solid fa-user-shield me-2 text-warning"></i> Role-Based Module Access Manager</h2>
                            <p class="text-muted small mb-0">As Super Admin, configure which CMS modules each administrative role can access</p>
                        </div>
                        <span class="badge text-bg-warning text-dark px-3 py-2 uppercase"><i class="fa-solid fa-crown me-1"></i> Super Admin Only</span>
                    </div>

                    <form method="post" action="">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="update_role_permissions">

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 40%;">CMS Module Name</th>
                                        <th class="text-center" style="width: 20%;">
                                            <i class="fa-solid fa-crown text-warning me-1"></i> Super Admin
                                        </th>
                                        <th class="text-center" style="width: 20%;">
                                            <i class="fa-solid fa-user-shield text-info me-1"></i> Admin
                                        </th>
                                        <th class="text-center" style="width: 20%;">
                                            <i class="fa-solid fa-pen-nib text-success me-1"></i> Author / Writer
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allAvailableModules as $modKey => $modInfo): ?>
                                        <tr>
                                            <td>
                                                <i class="fa-solid <?= $modInfo['icon'] ?> me-2 text-muted"></i>
                                                <strong><?= e($modInfo['name']) ?></strong>
                                                <code class="ms-2 text-muted" style="font-size: 11px;">(?module=<?= $modKey ?>)</code>
                                            </td>
                                            <td class="text-center bg-light">
                                                <span class="badge text-bg-success"><i class="fa-solid fa-check me-1"></i> Full Access</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input" type="checkbox" name="perm_admin[]" value="<?= $modKey ?>" <?= in_array($modKey, $allRolePermissions['admin'] ?? [], true) ? 'checked' : '' ?>>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input" type="checkbox" name="perm_author[]" value="<?= $modKey ?>" <?= in_array($modKey, $allRolePermissions['author'] ?? [], true) ? 'checked' : '' ?>>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-floppy-disk me-1"></i> Save Access Settings</button>
                        </div>
                    </form>
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
                if (!is_role('super_admin', 'admin')) {
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

                            <!-- Social Media & Auto-Publishing Accounts -->
                            <div class="col-12" id="social-settings">
                                <h4 class="mb-1 text-primary"><i class="fa-solid fa-share-nodes me-2"></i> Social Media & Auto-Publishing Accounts</h4>
                                <p class="text-muted small mb-0">Configure official account handles, page links, numbers, and default hashtags used when publishing stories to social media platforms.</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold"><i class="fab fa-facebook text-primary me-1"></i> Facebook Page / Profile URL</label>
                                <input type="text" name="facebook" class="form-control" placeholder="https://facebook.com/pradeepsarang" value="<?= e($settings['facebook'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold"><i class="fab fa-x-twitter me-1"></i> Twitter / X Handle</label>
                                <input type="text" name="twitter" class="form-control" placeholder="@pradeepsarang" value="<?= e($settings['twitter'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold"><i class="fab fa-whatsapp text-success me-1"></i> WhatsApp Number / Link</label>
                                <input type="text" name="whatsapp" class="form-control" placeholder="+919450000000 or Link" value="<?= e($settings['whatsapp'] ?? $settings['phone'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold"><i class="fab fa-linkedin text-info me-1"></i> LinkedIn Profile URL</label>
                                <input type="text" name="linkedin" class="form-control" placeholder="https://linkedin.com/in/pradeepsarang" value="<?= e($settings['linkedin'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold"><i class="fab fa-telegram text-secondary me-1"></i> Telegram Channel / Group</label>
                                <input type="text" name="telegram" class="form-control" placeholder="@pradeepsarang or https://t.me/..." value="<?= e($settings['telegram'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold"><i class="fab fa-instagram text-danger me-1"></i> Instagram Profile</label>
                                <input type="text" name="instagram" class="form-control" placeholder="https://instagram.com/pradeepsarang" value="<?= e($settings['instagram'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fab fa-youtube text-danger me-1"></i> YouTube Channel</label>
                                <input type="text" name="youtube" class="form-control" placeholder="https://youtube.com/@pradeepsarang" value="<?= e($settings['youtube'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fa-solid fa-hashtag text-warning me-1"></i> Default Social Hashtags</label>
                                <input type="text" name="social_hashtags" class="form-control" placeholder="#PradeepSarang #AwadhiLiterature #GreenGang" value="<?= e($settings['social_hashtags'] ?? '#PradeepSarang #AwadhiLiterature #GreenGang') ?>">
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
<!-- Social Media Share Modal -->
<div class="modal fade" id="socialShareModal" tabindex="-1" aria-labelledby="socialShareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="modal-title mb-0" id="socialShareModalLabel"><i class="fa-solid fa-share-nodes me-2 text-warning"></i> Publish & Share Story to Social Media</h5>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-sm btn-outline-warning text-white py-0 px-2" onclick="openSocialConfigModal()"><i class="fa-solid fa-gear me-1"></i> Configure</button>
                    <button type="button" class="btn-close btn-close-white ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <h6 class="fw-bold mb-1 text-primary" id="modalStoryTitle">Story Title</h6>
                <p class="small text-muted mb-3 text-truncate" id="modalStoryUrl"></p>
                
                <div class="mb-3">
                    <label class="form-label font-semibold small text-muted">Formatted Social Post Copy:</label>
                    <textarea class="form-control form-control-sm font-monospace" id="modalSocialText" rows="4" readonly></textarea>
                    <button type="button" class="btn btn-sm btn-outline-secondary mt-2 w-100" onclick="copyModalSocialText()"><i class="fa-solid fa-copy me-1"></i> Copy Post Text</button>
                </div>

                <hr class="my-3">

                <div class="d-grid gap-2">
                    <a id="modalFbBtn" href="#" target="_blank" class="btn btn-primary"><i class="fa-brands fa-facebook me-2"></i> Share on Facebook</a>
                    <a id="modalTwBtn" href="#" target="_blank" class="btn btn-dark"><i class="fa-brands fa-x-twitter me-2"></i> Tweet on Twitter / X</a>
                    <a id="modalWaBtn" href="#" target="_blank" class="btn btn-success"><i class="fa-brands fa-whatsapp me-2"></i> Send to WhatsApp</a>
                    <a id="modalLnBtn" href="#" target="_blank" class="btn btn-info text-white"><i class="fa-brands fa-linkedin me-2"></i> Share on LinkedIn</a>
                    <a id="modalTgBtn" href="#" target="_blank" class="btn btn-secondary"><i class="fa-brands fa-telegram me-2"></i> Share on Telegram</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Social Account Configuration Modal -->
<div class="modal fade" id="socialConfigModal" tabindex="-1" aria-labelledby="socialConfigModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="socialConfigModalLabel"><i class="fa-solid fa-sliders me-2 text-warning"></i> Configure Social Media Accounts</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted small mb-4"><i class="fa-solid fa-circle-info me-1 text-primary"></i> Enter your official social media account links, handles, or channels. Stories published from this CMS panel will target your configured accounts.</p>
                <form id="socialConfigForm" onsubmit="saveSocialConfig(event)">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label font-semibold"><i class="fab fa-facebook text-primary me-1"></i> Facebook Page / Profile URL</label>
                            <input type="text" id="cfg_facebook" class="form-control" placeholder="https://facebook.com/pradeepsarang" value="<?= e($settings['facebook'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-semibold"><i class="fab fa-x-twitter me-1"></i> Twitter / X Handle or Profile</label>
                            <input type="text" id="cfg_twitter" class="form-control" placeholder="@pradeepsarang" value="<?= e($settings['twitter'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-semibold"><i class="fab fa-whatsapp text-success me-1"></i> WhatsApp Number or Channel Link</label>
                            <input type="text" id="cfg_whatsapp" class="form-control" placeholder="+919450000000 or https://chat.whatsapp.com/..." value="<?= e($settings['whatsapp'] ?? $settings['phone'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-semibold"><i class="fab fa-linkedin text-info me-1"></i> LinkedIn Profile / Page URL</label>
                            <input type="text" id="cfg_linkedin" class="form-control" placeholder="https://linkedin.com/in/pradeepsarang" value="<?= e($settings['linkedin'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-semibold"><i class="fab fa-telegram text-secondary me-1"></i> Telegram Channel / Group</label>
                            <input type="text" id="cfg_telegram" class="form-control" placeholder="@pradeepsarang or https://t.me/pradeepsarang" value="<?= e($settings['telegram'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-semibold"><i class="fa-solid fa-hashtag text-warning me-1"></i> Default Social Hashtags</label>
                            <input type="text" id="cfg_social_hashtags" class="form-control" placeholder="#PradeepSarang #AwadhiLiterature #GreenGang" value="<?= e($settings['social_hashtags'] ?? '#PradeepSarang #AwadhiLiterature #GreenGang') ?>">
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-floppy-disk me-1"></i> Save Configuration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
window.configuredSocialSettings = <?= json_encode([
    'facebook' => $settings['facebook'] ?? '',
    'twitter' => $settings['twitter'] ?? '',
    'whatsapp' => $settings['whatsapp'] ?? ($settings['phone'] ?? ''),
    'linkedin' => $settings['linkedin'] ?? '',
    'telegram' => $settings['telegram'] ?? '',
    'social_hashtags' => $settings['social_hashtags'] ?? '#PradeepSarang #AwadhiLiterature #GreenGang'
]) ?>;

function updateSocialBadges(data) {
    if (document.getElementById('badge_fb_status')) {
        document.getElementById('badge_fb_status').innerText = data.facebook ? 'Configured' : 'Setup';
    }
    if (document.getElementById('badge_tw_status')) {
        document.getElementById('badge_tw_status').innerText = data.twitter ? data.twitter : 'Setup';
    }
    if (document.getElementById('badge_wa_status')) {
        document.getElementById('badge_wa_status').innerText = data.whatsapp ? 'Configured' : 'Setup';
    }
    if (document.getElementById('badge_ln_status')) {
        document.getElementById('badge_ln_status').innerText = data.linkedin ? 'Configured' : 'Setup';
    }
}

function toggleInlineSocialConfig() {
    const el = document.getElementById('inlineSocialConfigPanel');
    if (!el) {
        openSocialConfigModal();
        return;
    }
    const bsCollapse = bootstrap.Collapse.getInstance(el) || new bootstrap.Collapse(el, { toggle: false });
    if (el.classList.contains('show')) {
        bsCollapse.hide();
    } else {
        document.getElementById('inline_cfg_facebook').value = window.configuredSocialSettings.facebook || '';
        document.getElementById('inline_cfg_twitter').value = window.configuredSocialSettings.twitter || '';
        document.getElementById('inline_cfg_whatsapp').value = window.configuredSocialSettings.whatsapp || '';
        document.getElementById('inline_cfg_linkedin').value = window.configuredSocialSettings.linkedin || '';
        document.getElementById('inline_cfg_telegram').value = window.configuredSocialSettings.telegram || '';
        document.getElementById('inline_cfg_social_hashtags').value = window.configuredSocialSettings.social_hashtags || '#PradeepSarang #AwadhiLiterature #GreenGang';
        bsCollapse.show();
    }
}

function openSocialConfigModal() {
    window.location.href = 'index.php?module=settings#social-settings';
}

function saveSocialConfig(e) {
    e.preventDefault();
    const data = {
        action: 'update_social_config',
        _csrf: '<?= csrf_token() ?>',
        facebook: document.getElementById('cfg_facebook').value.trim(),
        twitter: document.getElementById('cfg_twitter').value.trim(),
        whatsapp: document.getElementById('cfg_whatsapp').value.trim(),
        linkedin: document.getElementById('cfg_linkedin').value.trim(),
        telegram: document.getElementById('cfg_telegram').value.trim(),
        social_hashtags: document.getElementById('cfg_social_hashtags').value.trim()
    };

    $.post('index.php', data, function(res) {
        if (res.status === 'success') {
            window.configuredSocialSettings = res.data;
            updateSocialBadges(res.data);
            const modalEl = document.getElementById('socialConfigModal');
            const instance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            instance.hide();
            Swal.fire({ icon: 'success', title: 'Configured!', text: 'Social media account settings updated successfully.', timer: 2000, showConfirmButton: false });
        } else {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to update settings.' });
        }
    }).fail(function() {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Server error saving settings.' });
    });
}

function saveInlineSocialConfig(e) {
    e.preventDefault();
    const data = {
        action: 'update_social_config',
        _csrf: '<?= csrf_token() ?>',
        facebook: document.getElementById('inline_cfg_facebook').value.trim(),
        twitter: document.getElementById('inline_cfg_twitter').value.trim(),
        whatsapp: document.getElementById('inline_cfg_whatsapp').value.trim(),
        linkedin: document.getElementById('inline_cfg_linkedin').value.trim(),
        telegram: document.getElementById('inline_cfg_telegram').value.trim(),
        social_hashtags: document.getElementById('inline_cfg_social_hashtags').value.trim()
    };

    $.post('index.php', data, function(res) {
        if (res.status === 'success') {
            window.configuredSocialSettings = res.data;
            updateSocialBadges(res.data);
            const el = document.getElementById('inlineSocialConfigPanel');
            if (el && el.classList.contains('show')) {
                const bsCollapse = bootstrap.Collapse.getInstance(el) || new bootstrap.Collapse(el, { toggle: false });
                bsCollapse.hide();
            }
            Swal.fire({ icon: 'success', title: 'Configured!', text: 'Social media account settings saved successfully.', timer: 2000, showConfirmButton: false });
        } else {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to save settings.' });
        }
    }).fail(function() {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Server error saving settings.' });
    });
}

function openSocialShareModal(data) {
    const title = data.title || '';
    const excerpt = data.excerpt || '';
    const url = data.url || '';
    const hashtags = window.configuredSocialSettings.social_hashtags || '#PradeepSarang #AwadhiLiterature #GreenGang';
    
    document.getElementById('modalStoryTitle').innerText = title;
    document.getElementById('modalStoryUrl').innerText = url;
    
    const postCopy = `${title}\n\n"${excerpt}"\n\nRead full story: ${url}\n\n${hashtags}`;
    document.getElementById('modalSocialText').value = postCopy;
    
    const encodedUrl = encodeURIComponent(url);
    const encodedTitle = encodeURIComponent(title);
    const encodedCopy = encodeURIComponent(postCopy);
    
    document.getElementById('modalFbBtn').href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
    document.getElementById('modalTwBtn').href = `https://twitter.com/intent/tweet?text=${encodeURIComponent(title + '\n\n' + excerpt)}&url=${encodedUrl}`;
    document.getElementById('modalWaBtn').href = `https://api.whatsapp.com/send?text=${encodedCopy}`;
    document.getElementById('modalLnBtn').href = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`;
    document.getElementById('modalTgBtn').href = `https://t.me/share/url?url=${encodedUrl}&text=${encodedTitle}`;
    
    const modal = new bootstrap.Modal(document.getElementById('socialShareModal'));
    modal.show();
}

function copyModalSocialText() {
    const textEl = document.getElementById('modalSocialText');
    textEl.select();
    navigator.clipboard.writeText(textEl.value).then(() => {
        Swal.fire({ icon: 'success', title: 'Copied!', text: 'Social post copy copied to clipboard.', timer: 2000, showConfirmButton: false });
    });
}

function getFormSocialPostData() {
    const titleInput = document.querySelector('input[name="title"]');
    const excerptInput = document.querySelector('textarea[name="excerpt"]');
    const slugInput = document.querySelector('input[name="slug"]');
    const hashtags = window.configuredSocialSettings.social_hashtags || '#PradeepSarang #AwadhiLiterature #GreenGang';
    
    const title = titleInput ? titleInput.value.trim() : 'Story Title';
    const excerpt = excerptInput ? excerptInput.value.trim() : '';
    const slug = slugInput ? slugInput.value.trim() : '';
    const baseUrl = '<?= e(base_url('/blog/')) ?>';
    const url = slug ? (baseUrl + slug) : baseUrl;
    const postCopy = `${title}\n\n${excerpt ? '"' + excerpt + '"\n\n' : ''}Read full story: ${url}\n\n${hashtags}`;
    
    return { title, excerpt, url, postCopy };
}

function triggerFormSocialPublish(platform) {
    const data = getFormSocialPostData();
    executePublishing(platform, data);
}

function executePublishing(platform, data) {
    const encodedUrl = encodeURIComponent(data.url);
    const encodedTitle = encodeURIComponent(data.title);
    const encodedCopy = encodeURIComponent(data.postCopy);
    
    let shareUrl = '#';
    if (platform === 'facebook') {
        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
    } else if (platform === 'twitter') {
        const twHandle = window.configuredSocialSettings.twitter ? window.configuredSocialSettings.twitter.replace('@', '') : '';
        shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(data.title + (data.excerpt ? '\n\n' + data.excerpt : ''))}&url=${encodedUrl}${twHandle ? '&via=' + twHandle : ''}`;
    } else if (platform === 'whatsapp') {
        const waNum = window.configuredSocialSettings.whatsapp ? window.configuredSocialSettings.whatsapp.replace(/[^0-9]/g, '') : '';
        shareUrl = waNum ? `https://api.whatsapp.com/send?phone=${waNum}&text=${encodedCopy}` : `https://api.whatsapp.com/send?text=${encodedCopy}`;
    } else if (platform === 'linkedin') {
        shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`;
    } else if (platform === 'telegram') {
        shareUrl = `https://t.me/share/url?url=${encodedUrl}&text=${encodedTitle}`;
    }
    
    if (shareUrl !== '#') {
        window.open(shareUrl, '_blank', 'width=650,height=550');
    }
}

function copyFormSocialCopy() {
    const data = getFormSocialPostData();
    navigator.clipboard.writeText(data.postCopy).then(() => {
        Swal.fire({ icon: 'success', title: 'Copied!', text: 'Social media post text & link copied to clipboard.', timer: 2000, showConfirmButton: false });
    });
}
</script>
</body>
</html>
