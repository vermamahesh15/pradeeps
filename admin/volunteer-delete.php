<?php

declare(strict_types=1);

require_once '../includes/helpers.php';
require_once '../models/ContentModel.php';

session_start();

/**
 * AJAX endpoint to handle volunteer deletion.
 * Verifies session and uses ContentModel to perform the operation.
 */
if (!($_SESSION['admin_logged_in'] ?? false) || !is_role('super_admin', 'admin')) {
    json_response(['status' => 'error', 'message' => 'Unauthorized access.'], 403);
}

$content = new ContentModel();
$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    json_response(['status' => 'error', 'message' => 'Invalid volunteer ID.'], 400);
}

try {
    if ($content->deleteVolunteer($id)) {
        json_response(['status' => 'success', 'message' => 'Volunteer deleted successfully.']);
    } else {
        json_response(['status' => 'error', 'message' => 'Database operation failed.'], 500);
    }
} catch (Throwable $e) {
    json_response(['status' => 'error', 'message' => 'Server Error: ' . $e->getMessage()], 500);
}