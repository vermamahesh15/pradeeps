<?php

declare(strict_types=1);

require_once '../includes/helpers.php';
require_once '../models/ContentModel.php';

session_start();

if (!($_SESSION['admin_logged_in'] ?? false) || !is_role('super_admin', 'admin')) {
    json_response(['status' => 'error', 'message' => 'Unauthorized'], 403);
}

$content = new ContentModel();
$id = (int) ($_POST['id'] ?? 0);
$status = $_POST['status'] ?? '';

if ($id <= 0 || !in_array($status, ['Active', 'Inactive', 'Pending'])) {
    json_response(['status' => 'error', 'message' => 'Invalid data provided.'], 400);
}

try {
    if ($content->updateVolunteerStatus($id, $status)) {
        json_response(['status' => 'success', 'message' => 'Status updated successfully.']);
    } else {
        json_response(['status' => 'error', 'message' => 'Database update failed.'], 500);
    }
} catch (Throwable $e) {
    json_response(['status' => 'error', 'message' => $e->getMessage()], 500);
}