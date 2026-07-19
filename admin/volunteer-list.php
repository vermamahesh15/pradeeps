<?php
require_once '../includes/helpers.php';
require_once '../models/ContentModel.php';
session_start();
if (!($_SESSION['admin_logged_in'] ?? false) || !is_role('super_admin', 'admin')) {
    http_response_code(403);
    exit('Unauthorized access');
}

$content = new ContentModel();
$volunteers = $content->filterVolunteers($_POST);
?>
<table class="table align-middle">
    <thead class="table-light">
        <tr>
            <th>Photo</th>
            <th>Volunteer Details</th>
            <th>Contact</th>
            <th>Location</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($volunteers as $v): ?>
        <tr>
            <td>
                <img src="<?= $v['photo'] ? base_url($v['photo']) : 'https://ui-avatars.com/api/?name='.urlencode($v['full_name']) ?>" class="volunteer-photo-sm">
            </td>
            <td>
                <strong><?= e($v['full_name']) ?></strong><br>
                <small class="text-muted">ID: <?= e($v['volunteer_id'] ?? 'N/A') ?></small>
            </td>
            <td>
                <?= e($v['phone']) ?><br>
                <small><?= e($v['email']) ?></small>
            </td>
            <td><?= e($v['district']) ?>, <?= e($v['state']) ?></td>
            <td>
                <select class="form-select form-select-sm status-selector shadow-none" data-id="<?= $v['id'] ?>">
                    <option value="Pending" <?= $v['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Active" <?= $v['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                    <option value="Inactive" <?= $v['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </td>
            <td>
                <div class="btn-group btn-group-sm">
                    <button onclick="viewVolunteer(<?= $v['id'] ?>)" class="btn btn-outline-dark"><i class="fa fa-eye"></i></button>
                    <button onclick="generateID(<?= $v['id'] ?>)" class="btn btn-outline-primary"><i class="fa fa-id-card"></i></button>
                    <button onclick="deleteVolunteer(<?= $v['id'] ?>)" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($volunteers)): ?>
            <tr><td colspan="6" class="text-center">No volunteers found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>