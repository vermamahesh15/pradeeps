<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $amount = (float)$_POST['amount'];
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
    
    // Generate unique Receipt Number
    $receipt_no = "SAH-" . date('Ymd') . "-" . rand(1000, 9999);

    // File Upload
    $screenshot_path = "";
    if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] === 0) {
        $target_dir = "uploads/donations/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        
        $ext = pathinfo($_FILES['screenshot']['name'], PATHINFO_EXTENSION);
        $file_name = uniqid() . "." . $ext;
        if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target_dir . $file_name)) {
            $screenshot_path = $target_dir . $file_name;
        }
    }

    $sql = "INSERT INTO donations (receipt_no, full_name, mobile, email, amount, payment_method, transaction_id, purpose, screenshot) 
            VALUES ('$receipt_no', '$full_name', '$mobile', '$email', $amount, '$payment_method', '$transaction_id', '$purpose', '$screenshot_path')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode([
            'status' => 'success', 
            'message' => 'Donation details submitted successfully. We will verify and notify you.',
            'receipt' => $receipt_no
        ]);
    } else {
        echo json_encode([
            'status' => 'error', 
            'message' => 'Database error: ' . mysqli_error($conn)
        ]);
    }
    exit;
}
?>