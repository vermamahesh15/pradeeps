<?php

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

session_start();
date_default_timezone_set(app_config('timezone', 'Asia/Kolkata'));

require_once __DIR__ . '/../models/Blog.php';
require_once __DIR__ . '/../models/BlogCategory.php';
require_once __DIR__ . '/../controllers/PageController.php';

$contentModel = new ContentModel();
$blogModel = new Blog();
$categoryModel = new BlogCategory();
$controller = new PageController($contentModel, $blogModel, $categoryModel);
$controller->handleForms();
