<?php

declare(strict_types=1);

require_once '../includes/helpers.php';
require_once '../models/ContentModel.php';

session_start();

if (!($_SESSION['admin_logged_in'] ?? false) || !is_role('super_admin', 'admin')) {
    exit('Unauthorized');
}

$content = new ContentModel();
$id = (int) ($_POST['id'] ?? 0);
$v = $content->findVolunteer($id);

if (!$v) {
    exit('<div class="alert alert-danger m-3">Volunteer not found.</div>');
}
?>
<div class="modal-header">
    <h5 class="modal-title">Volunteer Details: <?= e($v['full_name']) ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row g-4">
        <div class="col-md-4 text-center">
            <img src="<?= $v['photo'] ? base_url($v['photo']) : 'https://ui-avatars.com/api/?name=' . urlencode($v['full_name']) . '&size=200' ?>" 
                 class="img-fluid rounded shadow-sm mb-3" alt="Profile">
            <div class="badge bg-<?= $v['status'] === 'Active' ? 'success' : 'warning' ?> fs-6 w-100 p-2">
                Status: <?= e($v['status']) ?>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-sm table-borderless">
                <tr><th width="35%">Volunteer ID</th><td>: <strong><?= e($v['volunteer_id'] ?? 'N/A') ?></strong></td></tr>
                <tr><th>Father's Name</th><td>: <?= e($v['father_name'] ?? 'N/A') ?></td></tr>
                <tr><th>Gender / DOB</th><td>: <?= e($v['gender']) ?> / <?= $v['dob'] ? e(format_date($v['dob'])) : 'N/A' ?></td></tr>
                <tr><th>Email</th><td>: <?= e($v['email']) ?></td></tr>
                <tr><th>Phone</th><td>: <?= e($v['phone']) ?></td></tr>
                <tr><th>Location</th><td>: <?= e($v['district']) ?>, <?= e($v['state']) ?> (<?= e($v['pincode'] ?? 'N/A') ?>)</td></tr>
                <tr><th>Occupation</th><td>: <?= e($v['occupation'] ?? 'N/A') ?></td></tr>
                <tr><th>Joined On</th><td>: <?= e(format_date($v['created_at'])) ?></td></tr>
            </table>
        </div>
        <div class="col-12">
            <hr>
            <h6>Skills & Interests</h6>
            <p class="text-muted small mb-3">
                <strong>Skills:</strong> <?= e($v['skills'] ?: 'None specified') ?><br>
                <strong>Interests:</strong> <?= e($v['interests'] ?: 'None specified') ?><br>
                <strong>Availability:</strong> <?= e($v['availability'] ?: 'N/A') ?>
            </p>
            
            <h6>Message/Bio</h6>
            <div class="p-3 bg-light rounded small mb-3">
                <?= nl2br(e($v['message'] ?: 'No message provided.')) ?>
            </div>

            <?php if ($v['resume']): ?>
                <a href="<?= base_url($v['resume']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="fa fa-file-pdf me-1"></i> View Resume
                </a>
            <?php else: ?>
                <button class="btn btn-sm btn-light disabled"><i class="fa fa-file-excel me-1"></i> No Resume Uploaded</button>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <form method="post" action="volunteer-delete.php" onsubmit="return confirm('Delete this record permanently?')" class="me-auto">
        <input type="hidden" name="id" value="<?= $v['id'] ?>">
        <button type="submit" class="btn btn-danger btn-sm">Delete Record</button>
    </form>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" onclick="generateID(<?= $v['id'] ?>)" class="btn btn-primary">Print ID Card</button>
</div>