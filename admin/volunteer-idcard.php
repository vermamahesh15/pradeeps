<?php
require_once '../includes/helpers.php';
require_once '../models/ContentModel.php';
session_start();
if (!($_SESSION['admin_logged_in'] ?? false) || !is_role('super_admin', 'admin')) {
    http_response_code(403);
    exit('Unauthorized access');
}

$content = new ContentModel();
$v = $content->findVolunteer((int)$_POST['id']);
if (!$v) exit('Volunteer not found');
?>
<div class="id-card-wrap">
    <div class="id-card-header">
        <h5 class="mb-0">Pradeep Sarang</h5>
        <small>VOLUNTEER PASS</small>
    </div>
    <img src="<?= $v['photo'] ? base_url($v['photo']) : 'https://ui-avatars.com/api/?name='.urlencode($v['full_name']) ?>" class="id-photo">
    <div class="id-body">
        <div class="id-name"><?= e($v['full_name']) ?></div>
        <div class="id-info">ID: <strong><?= e($v['volunteer_id']) ?></strong></div>
        <div class="id-info">Mob: <?= e($v['phone']) ?></div>
        <div class="id-info"><?= e($v['district']) ?>, <?= e($v['state']) ?></div>
        <div class="id-barcode mt-3">VALID UNTIL: <?= date('Y') + 1 ?>-12-31</div>
    </div>
</div>