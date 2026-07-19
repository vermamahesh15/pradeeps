<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/ContentModel.php';
require_once __DIR__ . '/../models/Blog.php';
require_once __DIR__ . '/../models/BlogCategory.php';

class PageController
{
    private ContentModel $content;
    private Blog $blogModel;
    private BlogCategory $categoryModel;

    public function __construct(ContentModel $content, Blog $blogModel, BlogCategory $categoryModel)
    {
        $this->content = $content;
        $this->blogModel = $blogModel;
        $this->categoryModel = $categoryModel;
    }

    public function render(string $view, array $data = []): void
    {
        $title = $data['title'] ?? app_config('name');
        $viewFile = __DIR__ . '/../views/pages/' . $view . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(404);
            $viewFile = __DIR__ . '/../views/pages/404.php';
            $title = 'Page Not Found';
        }

        extract($data);
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function home(): void
    {
        $this->render('home', [
            'title' => 'Home',
            'page' => $this->content->home(),
        ]);
    }

    public function page(string $slug): void
    {
        // Ensure the slug is cleaned up for matching
        $slug = rtrim($slug, '/') ?: '/';

        $map = [
            '/about' => ['view' => 'about', 'title' => 'About Us'],
            '/campaigns' => ['view' => 'causes', 'title' => 'Campaigns', 'items' => $this->content->all('campaigns')],
            '/events' => ['view' => 'events', 'title' => 'Events', 'items' => $this->content->all('events')],
            '/portfolio' => ['view' => 'portfolio', 'title' => 'Portfolio', 'items' => $this->content->all('portfolio')],
            '/contact' => ['view' => 'contact', 'title' => 'Contact'],
            '/volunteer' => ['view' => 'volunteer', 'title' => 'Volunteer Registration', 'states' => $this->content->getStates()],
            '/donation' => ['view' => 'donation', 'title' => 'Donate Now'],
        ];

        if ($slug === '/about') {
            $this->render('about', [
                'title' => 'About Us',
                'timeline' => $this->content->getTimeline()
            ]);
            return;
        }

        if ($slug === '/blog') {
            $this->render('blog', [
                'title' => 'Blog',
                'items' => $this->blogModel->allPublished(12, 0),
                'categories' => $this->categoryModel->all(),
            ]);
            return;
        }

        if ($slug === '/donation') {
            $this->render('donation', [
                'title' => 'Donate Now',
                'donation_settings' => $this->content->getDonationSettings()
            ]);
            return;
        }

        $config = $map[$slug] ?? null;
        if ($config === null) {
            // Check database for dynamic pages
            $dbSlug = ltrim($slug, '/');
            $page = $this->content->findPageBySlug($dbSlug);
            
            if ($page) {
                $this->render('page-template', [
                    'title' => $page['title'],
                    'page' => $page
                ]);
                return;
            }
            $this->render('404');
            return;
        }

        $this->render($config['view'], $config);
    }

    public function blogDetail(string $slug): void
    {
        $post = $this->blogModel->findBySlug($slug);
        if ($post === null) {
            $this->render('404');
            return;
        }

        $related = $this->blogModel->allPublished(3, 0, '', null);
        $related = array_filter($related, fn ($blog) => $blog['slug'] !== $slug);

        $this->render('blog-detail', [
            'title' => $post['title'],
            'post' => $post,
            'related' => array_slice($related, 0, 3),
        ]);
    }

    public function campaignDetail(string $slug): void
    {
        $item = $this->content->findBySlug('campaigns', $slug);
        if ($item === null) {
            $this->render('404');
            return;
        }

        $this->render('cause-detail', ['title' => $item['title'], 'item' => $item]);
    }

    public function eventDetail(string $slug): void
    {
        $item = $this->content->findBySlug('events', $slug);
        if ($item === null) {
            $this->render('404');
            return;
        }

        $this->render('event-detail', ['title' => $item['title'], 'item' => $item]);
    }

    public function handleForms(): void
    {
        if (!is_post()) {
            return;
        }

        verify_csrf();
        $type = $_POST['form_type'] ?? '';

        switch ($type) {
            case 'contact':
                $this->saveContact();
                break;
            case 'volunteer':
                $this->saveVolunteer();
                break;
            case 'newsletter':
                $this->saveNewsletter();
                break;
        }
    }

    private function saveContact(): void
    {
        $this->content->saveContact([
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'subject' => trim($_POST['subject'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'submitted_at' => date('Y-m-d H:i:s'),
        ]);
        flash('success', 'Contact request submitted successfully.');
        redirect('/contact');
    }

    private function saveVolunteer(): void
    {
        $error = '';
        $resume = null;
        if (!empty($_FILES['resume']['name'])) {
            $resume = upload_file($_FILES['resume'], $error, 'resumes');
        }

        $photo = null;
        if (!empty($_FILES['photo']['name'])) {
            $photo = upload_file($_FILES['photo'], $error, 'volunteers');
        }

        $this->content->saveVolunteer([
            'full_name' => trim($_POST['full_name'] ?? ''),
            'father_name' => trim($_POST['father_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'gender' => $_POST['gender'] ?? 'Male',
            'dob' => $_POST['dob'] ?? null,
            'phone' => trim($_POST['phone'] ?? ''),
            'state' => trim($_POST['state'] ?? ''),
            'district' => trim($_POST['district'] ?? ''),
            'pincode' => trim($_POST['pincode'] ?? ''),
            'occupation' => trim($_POST['occupation'] ?? ''),
            'skills' => trim($_POST['skills'] ?? ''),
            'interests' => trim($_POST['interests'] ?? ''),
            'availability' => trim($_POST['availability'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'resume' => $resume,
            'photo' => $photo,
            'status' => 'Pending'
        ]);
        flash('success', 'Volunteer application received. Thank you for joining us.');
        redirect('/volunteer');
    }

    private function saveNewsletter(): void
    {
        $this->content->saveSubscriber([
            'email' => trim($_POST['email'] ?? ''),
            'submitted_at' => date('Y-m-d H:i:s'),
        ]);
        flash('success', 'You have been subscribed to the newsletter.');
        redirect('/');
    }
}
