<?php
// Scratch script to generate high-res default Green Gang stickers
$dir = __DIR__ . '/../../assets/images/stickers';
if (!is_dir($dir)) {
    mkdir($dir, 0775, true);
}

$stickers = [
    [
        'file' => 'sticker_green_morning.png',
        'title' => "GREEN MORNING",
        'sub' => "ग्रीन मॉर्निंग • हरित प्रभात",
        'motto' => "पेड़ लगाएं, धरती सजाएं",
        'bg1' => [20, 83, 45],
        'bg2' => [34, 197, 94],
        'badge' => "आधिकारिक स्टिकर"
    ],
    [
        'file' => 'sticker_tree_pledge.png',
        'title' => "पेड़ लगाएंगे, पेड़ बचाएंगे",
        'sub' => "GREEN GANG MOVEMENT",
        'motto' => "50,000+ देशी छायादार वृक्ष संकल्प",
        'bg1' => [15, 118, 110],
        'bg2' => [20, 83, 45],
        'badge' => "मुख्य संकल्प"
    ],
    [
        'file' => 'sticker_eco_army.png',
        'title' => "पर्यावरण सेना",
        'sub' => "GREEN GANG • BARABANKI",
        'motto' => "5 जून 2019 से निरंतर गतिशील",
        'bg1' => [161, 98, 7],
        'bg2' => [20, 83, 45],
        'badge' => "विश्व पर्यावरण दिवस"
    ],
    [
        'file' => 'sticker_green_greetings.png',
        'title' => "हरित प्रभात • हरित प्रात",
        'sub' => "GREEN GREETING REVOLUTION",
        'motto' => "दैनिक प्रकृति-प्रेम एवं पर्यावरण संस्कार",
        'bg1' => [22, 101, 52],
        'bg2' => [74, 222, 128],
        'badge' => "डिजिटल अभिवादन"
    ]
];

foreach ($stickers as $st) {
    $w = 600;
    $h = 600;
    $img = imagecreatetruecolor($w, $h);
    imagesavealpha($img, true);
    $transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
    imagefill($img, 0, 0, $transparent);

    // Circle base
    $c1 = imagecolorallocate($img, $st['bg1'][0], $st['bg1'][1], $st['bg1'][2]);
    $c2 = imagecolorallocate($img, $st['bg2'][0], $st['bg2'][1], $st['bg2'][2]);
    $white = imagecolorallocate($img, 255, 255, 255);
    $gold = imagecolorallocate($img, 254, 240, 138);

    // Draw rounded badge sticker shape
    imagefilledellipse($img, 300, 300, 560, 560, $c1);
    imagefilledellipse($img, 300, 300, 520, 520, $c2);

    // Inner dashed/dotted ring
    for ($a = 0; $a < 360; $a += 12) {
        $rad = deg2rad($a);
        $cx = 300 + cos($rad) * 240;
        $cy = 300 + sin($rad) * 240;
        imagefilledellipse($img, (int)$cx, (int)$cy, 8, 8, $gold);
    }

    // Centered texts using imagestring or built-in font
    $font = 5;
    $t1 = $st['title'];
    $t2 = $st['sub'];
    $t3 = $st['motto'];
    $t4 = "★ " . $st['badge'] . " ★";

    $x1 = 300 - (mb_strlen($t1) * 5);
    $x2 = 300 - (mb_strlen($t2) * 4);
    $x3 = 300 - (mb_strlen($t3) * 4);
    $x4 = 300 - (mb_strlen($t4) * 4);

    imagestring($img, 5, (int)$x4, 140, $t4, $gold);
    imagestring($img, 5, (int)$x1, 250, $t1, $white);
    imagestring($img, 4, (int)$x2, 310, $t2, $gold);
    imagestring($img, 4, (int)$x3, 370, $t3, $white);

    imagepng($img, $dir . '/' . $st['file']);
    imagedestroy($img);
}

echo "Sticker generation complete!\n";
