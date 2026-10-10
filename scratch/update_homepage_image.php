<?php
$source = '/home/hetansh/.gemini/antigravity-ide/brain/de58a53b-0fc9-481c-8a5d-5764ea844b40/.user_uploaded/media_1791639835510.jpg';

if (!file_exists($source)) {
    die("Source file not found: $source\n");
}

$destinations = [
    '/var/www/html/pradeep/assets/images/slider_final_1.webp',
    '/var/www/html/pradeep/assets/images/slider_final_1.jpg',
    '/var/www/html/pradeep/assets/images/slider_final_1.png',
    '/var/www/html/pradeep/assets/images/pradeepsarang.webp',
    '/var/www/html/pradeep/assets/images/pradeepsarang.jpg',
    '/var/www/html/pradeep/uploads/slider_final_1.webp',
    '/var/www/html/pradeep/uploads/slider_final_1.jpg',
    '/var/www/html/pradeep/uploads/69eddd34de768_pradeepsarang.webp',
    '/var/www/html/pradeep/uploads/69eddd5d31818_pradeepsarang.webp',
    '/var/www/html/pradeep/uploads/69edd6098e8c2_slider_final_1.webp',
];

$im = null;
if (function_exists('imagecreatefromjpeg')) {
    $im = @imagecreatefromjpeg($source);
}

foreach ($destinations as $dest) {
    $dir = dirname($dest);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    $ext = strtolower(pathinfo($dest, PATHINFO_EXTENSION));
    $success = false;
    
    if ($im && $ext === 'webp' && function_exists('imagewebp')) {
        $success = imagewebp($im, $dest, 90);
    } elseif ($im && $ext === 'png' && function_exists('imagepng')) {
        $success = imagepng($im, $dest, 6);
    }
    
    if (!$success) {
        copy($source, $dest);
    }
    echo "Updated: $dest\n";
}

if ($im) {
    imagedestroy($im);
}

echo "Done replacing hero/slider image.\n";
