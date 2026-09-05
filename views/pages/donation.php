<?php
declare(strict_types=1);
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/')) ?>">होम</a></li>
                    <li class="breadcrumb-item active" aria-current="page">सहयोग / दान</li>
                </ol>
            </nav>
            <div class="d-block mb-2">
                <span class="banner-kicker"><i class="fa-solid fa-hand-holding-heart me-1"></i> सहयोग एवं सेवा</span>
            </div>
            <h1>समाज निर्माण में अपना योगदान दें</h1>
            <p>आपका सहयोग समाज के कमजोर वर्गों की सहायता, शिक्षा, पर्यावरण एवं साहित्य संवर्धन में सीधे उपयोग किया जाता है।</p>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <!-- Bank & QR Payment Info -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white border-start border-4 border-warning">
                    <h4 class="fw-bold mb-3 text-primary"><i class="fa-solid fa-building-columns text-accent me-2"></i> बैंक विवरण (Bank Transfer)</h4>
                    <ul class="list-unstyled d-flex flex-column gap-2 small mb-0">
                        <li class="d-flex justify-content-between border-bottom pb-2">
                            <span class="text-muted">खाता धारक का नाम:</span>
                            <strong><?= e($donation_settings['account_name'] ?? 'Pradeep Sarang Foundation') ?></strong>
                        </li>
                        <li class="d-flex justify-content-between border-bottom pb-2">
                            <span class="text-muted">बैंक का नाम:</span>
                            <strong><?= e($donation_settings['bank_name'] ?? 'State Bank of India') ?></strong>
                        </li>
                        <li class="d-flex justify-content-between border-bottom pb-2">
                            <span class="text-muted">खाता संख्या:</span>
                            <strong class="text-accent fs-6"><?= e($donation_settings['account_number'] ?? '38472910384') ?></strong>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-muted">IFSC कोड:</span>
                            <strong><?= e($donation_settings['ifsc'] ?? 'SBIN0001234') ?></strong>
                        </li>
                    </ul>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white mb-4">
                    <h5 class="fw-bold text-primary mb-3"><i class="fa-solid fa-qrcode text-accent me-2"></i> UPI QR कोड द्वारा भुगतान</h5>
                    <div class="p-3 bg-light rounded-3 d-inline-block mx-auto mb-3 shadow-sm">
                        <img style="max-width: 190px;" src="<?= !empty($donation_settings['qr_code']) ? base_url($donation_settings['qr_code']) : asset('images/default-qr.png') ?>" alt="UPI QR">
                    </div>
                    <p class="fw-bold text-dark mb-1">UPI ID: <span class="badge bg-light text-primary border fs-6 px-3 py-1"><?= e($donation_settings['upi_id'] ?? 'pradeepsarang@upi') ?></span></p>
                    <small class="text-muted">PhonePe, Google Pay, Paytm, BHIM द्वारा स्कैन करें</small>
                </div>

                <div class="p-3 rounded-4 bg-light border text-center small text-muted">
                    <i class="fa-solid fa-shield-halved text-success me-1"></i> १००% सुरक्षित एवं पारदर्शी सहयोग प्रणाली
                </div>
            </div>

            <!-- Donation Submission Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h3 class="fw-bold mb-2">सहयोग विवरण दर्ज करें</h3>
                    <p class="text-muted small mb-4">भुगतान के पश्चात कृपया रसीद प्राप्त करने हेतु विवरण दर्ज करें।</p>

                    <div id="formMessage"></div>

                    <!-- Quick Amount Chips -->
                    <div class="mb-4">
                        <label class="form-label d-block">सहयोग राशि चुनें (₹)</label>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-brand btn-sm amount-chip" data-amt="500">₹500</button>
                            <button type="button" class="btn btn-outline-brand btn-sm amount-chip" data-amt="1100">₹1,100</button>
                            <button type="button" class="btn btn-outline-brand btn-sm amount-chip" data-amt="2100">₹2,100</button>
                            <button type="button" class="btn btn-outline-brand btn-sm amount-chip" data-amt="5100">₹5,100</button>
                            <button type="button" class="btn btn-outline-brand btn-sm amount-chip" data-amt="11000">₹11,000</button>
                        </div>
                    </div>

                    <form id="donationForm" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">आपका पूरा नाम *</label>
                                <input type="text" name="full_name" class="form-control" placeholder="नाम लिखें" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">मोबाइल नंबर *</label>
                                <input type="tel" name="mobile" class="form-control" placeholder="10 अंकों का मोबाइल नंबर" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">ईमेल पता</label>
                                <input type="email" name="email" class="form-control" placeholder="email@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">दान राशि (₹) *</label>
                                <input type="number" id="donationAmount" name="amount" class="form-control" placeholder="राशि लिखें" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">भुगतान माध्यम *</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="UPI">UPI / QR Code</option>
                                    <option value="Bank Transfer">बैंक ट्रांसफर (NEFT/RTGS/IMPS)</option>
                                    <option value="Cash">नकद (Cash)</option>
                                    <option value="Card">डेबिट/क्रेडिट कार्ड</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">ट्रांजैक्शन आईडी / UTR No *</label>
                                <input type="text" name="transaction_id" class="form-control" placeholder="12 अंकों का UTR या Ref No" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">सहयोग का उद्देश्य</label>
                                <input type="text" name="purpose" class="form-control" placeholder="उदा. शिक्षा, वृक्षारोपण, रक्तदान शिविर, सामान्य सहयोग">
                            </div>
                            <div class="col-12">
                                <label class="form-label">भुगतान का स्क्रीनशॉट (वैकल्पिक)</label>
                                <input type="file" name="screenshot" class="form-control" accept="image/*">
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="declareCheck" required>
                                    <label class="form-check-label small text-muted" for="declareCheck">
                                        मैं प्रमाणित करता/करती हूँ कि दी गई जानकारी सत्य एवं प्रामाणिक है।
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-brand btn-lg w-100 py-3 shadow" id="submitBtn">
                                    <span class="spinner-border spinner-border-sm d-none me-1" id="loader"></span> 
                                    <i class="fa-solid fa-heart me-1"></i> सहयोग विवरण जमा करें
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quick amount fill
    const chips = document.querySelectorAll('.amount-chip');
    const amtInput = document.getElementById('donationAmount');
    chips.forEach(chip => {
        chip.addEventListener('click', function() {
            chips.forEach(c => c.classList.remove('active', 'btn-brand'));
            this.classList.add('active', 'btn-brand');
            amtInput.value = this.getAttribute('data-amt');
        });
    });

    // Donation Form AJAX
    $('#donationForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#submitBtn').attr('disabled', true);
        $('#loader').removeClass('d-none');

        $.ajax({
            url: '<?= base_url("ajax-submit.php") ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                try {
                    let res = typeof response === 'object' ? response : JSON.parse(response);
                    if(res.status === 'success') {
                        $('#formMessage').html('<div class="alert alert-success rounded-3 shadow-sm"><i class="fa-solid fa-circle-check me-2"></i>' + res.message + '<br><strong class="mt-2 d-inline-block">रसीद संख्या (Receipt No): ' + (res.receipt || 'PSF-' + Date.now()) + '</strong></div>');
                        $('#donationForm')[0].reset();
                    } else {
                        $('#formMessage').html('<div class="alert alert-danger rounded-3"><i class="fa-solid fa-triangle-exclamation me-2"></i>' + res.message + '</div>');
                    }
                } catch (err) {
                    $('#formMessage').html('<div class="alert alert-success rounded-3"><i class="fa-solid fa-circle-check me-2"></i>विवरण सफलतापूर्वक प्राप्त हुआ! धन्यवाद।</div>');
                    $('#donationForm')[0].reset();
                }
                $('#submitBtn').attr('disabled', false);
                $('#loader').addClass('d-none');
            },
            error: function() {
                $('#formMessage').html('<div class="alert alert-danger rounded-3">सर्वर से संपर्क करने में त्रुटि हुई। कृपया पुनः प्रयास करें।</div>');
                $('#submitBtn').attr('disabled', false);
                $('#loader').addClass('d-none');
            }
        });
    });
});
</script>