<?php
session_start();
require_once '../includes/helpers.php';
require_once '../db.php';
if (!($_SESSION['admin_logged_in'] ?? false) || !is_role('super_admin', 'admin')) {
    header('Location: index.php');
    exit;
}

// Handle Status Updates
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $status = mysqli_real_escape_string($conn, $_GET['action']);
    mysqli_query($conn, "UPDATE donations SET status = '$status' WHERE id = $id");
    header('Location: donations.php');
}

$query = mysqli_query($conn, "SELECT * FROM donations ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Donations | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-3">
        <h2 class="fw-bold">Donation Management</h2>
        <div>
            <a href="settings.php" class="btn btn-outline-primary me-2"><i class="fas fa-cog"></i> Settings</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Receipt No</th>
                            <th>Donor Name</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Transaction ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><small class="text-muted"><?php echo $row['receipt_no']; ?></small></td>
                            <td>
                                <strong><?php echo $row['full_name']; ?></strong><br>
                                <small class="text-muted"><?php echo $row['mobile']; ?></small>
                            </td>
                            <td>₹<?php echo number_format($row['amount']); ?></td>
                            <td><?php echo $row['payment_method']; ?></td>
                            <td><code><?php echo $row['transaction_id']; ?></code></td>
                            <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                            <td>
                                <?php if($row['status'] == 'verified'): ?>
                                    <span class="badge bg-success">Verified</span>
                                <?php elseif($row['status'] == 'rejected'): ?>
                                    <span class="badge bg-danger">Rejected</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <?php if($row['status'] != 'verified'): ?>
                                        <a href="?action=verified&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" title="Verify"><i class="fas fa-check"></i></a>
                                    <?php endif; ?>
                                    <?php if($row['status'] != 'rejected'): ?>
                                        <a href="?action=rejected&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" title="Reject"><i class="fas fa-times"></i></a>
                                    <?php endif; ?>
                                    <?php if($row['screenshot']): ?>
                                        <a href="../<?php echo $row['screenshot']; ?>" target="_blank" class="btn btn-sm btn-info" title="View Screenshot"><i class="fas fa-image"></i></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>