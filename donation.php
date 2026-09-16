<?php
require_once 'db.php';
$query = mysqli_query($conn, "SELECT * FROM donation_settings WHERE id = 1");
$settings = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate Now | <?php echo $settings['org_name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
        .donation-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .bank-details { background: #fff; padding: 25px; border-radius: 15px; border-left: 5px solid #0d6efd; }
        .qr-box img { max-width: 200px; border: 5px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Support Our Cause</h1>
        <p class="text-muted">Your contribution brings a direct impact to the community.</p>
    </div>

    <div class="row g-4">
        <!-- Bank Details & QR -->
        <div class="col-lg-4">
            <div class="bank-details mb-4">
                <h4 class="mb-4 text-primary"><i class="fas fa-university me-2"></i>Bank Transfer</h4>
                <p class="mb-1 text-muted small">Account Holder</p>
                <p class="fw-bold"><?php echo $settings['account_name']; ?></p>
                <p class="mb-1 text-muted small">Bank Name</p>
                <p class="fw-bold"><?php echo $settings['bank_name']; ?></p>
                <p class="mb-1 text-muted small">Account Number</p>
                <p class="fw-bold text-primary fs-5"><?php echo $settings['account_number']; ?></p>
                <p class="mb-1 text-muted small">IFSC Code</p>
                <p class="fw-bold"><?php echo $settings['ifsc']; ?></p>
            </div>
            
            <div class="card donation-card text-center p-4">
                <h4 class="text-primary mb-3"><i class="fas fa-qrcode me-2"></i>Scan & Pay</h4>
                <div class="qr-box mb-3">
                    <img src="<?php echo $settings['qr_code'] ? $settings['qr_code'] : 'assets/images/default-qr.png'; ?>" alt="UPI QR">
                </div>
                <p class="fw-bold mb-0">UPI ID: <?php echo $settings['upi_id']; ?></p>
            </div>
        </div>

        <!-- Donation Form -->
        <div class="col-lg-8">
            <div class="card donation-card p-4">
                <h4 class="mb-4">Submit Donation Details</h4>
                <form id="donationForm" enctype="multipart/form-data">
                    <div id="formMessage"></div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mobile Number *</label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Donation Amount (₹) *</label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment Method *</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="UPI">UPI</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Transaction ID / Ref No *</label>
                            <input type="text" name="transaction_id" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Purpose</label>
                            <input type="text" name="purpose" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Upload Screenshot (Optional)</label>
                            <input type="file" name="screenshot" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" required>
                                <label class="form-check-label small">I hereby declare that the information provided is correct.</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg w-100" id="submitBtn">
                                <span class="spinner-border spinner-border-sm d-none" id="loader"></span> Submit Donation
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#donationForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#submitBtn').attr('disabled', true);
        $('#loader').removeClass('d-none');

        $.ajax({
            url: 'ajax-submit.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                let res = JSON.parse(response);
                if(res.status === 'success') {
                    $('#formMessage').html('<div class="alert alert-success">'+res.message+'<br>Receipt No: <b>'+res.receipt+'</b></div>');
                    $('#donationForm')[0].reset();
                } else {
                    $('#formMessage').html('<div class="alert alert-danger">'+res.message+'</div>');
                }
                $('#submitBtn').attr('disabled', false);
                $('#loader').addClass('d-none');
            },
            error: function() {
                $('#formMessage').html('<div class="alert alert-danger">Server error occurred.</div>');
                $('#submitBtn').attr('disabled', false);
                $('#loader').addClass('d-none');
            }
        });
    });
});
</script>
</body>
</html>