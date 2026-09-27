<?php
declare(strict_types=1);

$donation_settings = $donation_settings ?? [];
$accountName = trim($donation_settings['account_name'] ?? '') ?: ps_text('प्रदीप सारंग जनसेवा एवं पर्यावरण न्यास', 'Pradeep Sarang Trust');
$bankName = trim($donation_settings['bank_name'] ?? '') ?: ps_text('State Bank of India (भारतीय स्टेट बैंक)', 'State Bank of India (SBI)');
$accountNumber = trim($donation_settings['account_number'] ?? '') ?: '38947291048';
$ifscCode = trim($donation_settings['ifsc'] ?? '') ?: 'SBIN0005471';
$upiId = trim($donation_settings['upi_id'] ?? '') ?: 'pradeepsarang@upi';
$contactPhone = trim($settings['phone'] ?? '+91 9919007190');
$contactEmail = trim($settings['email'] ?? 'contact@pradeepsarang.in');
?>

<div class="flex flex-col w-full min-h-screen bg-cream-canvas">
  <!-- BREADCRUMB & HEADER BANNER -->
  <section class="relative w-full bg-soft-meadow py-8 border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <nav class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-3" aria-label="Breadcrumb">
        <a href="<?= e(base_url('/')) ?>" class="hover:text-primary transition-colors flex items-center gap-1">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('होम', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('सहयोग करें', 'Donate Now')) ?></span>
      </nav>

      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight font-bold">
            <?= ps_text('ऑनलाइन सहयोग व दान <span class="text-primary">• Direct Donation</span>', 'Online Donation <span class="text-primary">• Direct Contribution</span>') ?>
          </h1>
          <p class="font-body-md text-body-md text-text-muted mt-1 max-w-2xl">
            <?= e(ps_text('100% पारदर्शी एवं जन-समर्पित सहयोग। क्यूआर कोड से तुरंत भुगतान करें तथा विवरण जमा कर पावती प्राप्त करें।', '100% transparent direct community contribution. Scan the QR code to donate and request a digital receipt.')) ?>
          </p>
        </div>
        <div class="inline-flex items-center gap-2 bg-[#14532D] text-white px-4 py-2 rounded-xl font-label-md text-label-md font-bold shadow-xs whitespace-nowrap self-start sm:self-center">
          <span class="material-symbols-outlined text-[18px]">verified_user</span>
          <span><?= e(ps_text('100% शत-प्रतिशत पारदर्शी', '100% Transparent')) ?></span>
        </div>
      </div>
    </div>
  </section>

  <!-- MAIN DEDICATED DONATION & QR CODE SECTION -->
  <section class="w-full py-10 md:py-16">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- LEFT COLUMN: QR CODE & OFFICIAL BANK DETAILS (5 COLS) -->
        <div class="lg:col-span-5 flex flex-col space-y-6">
          
          <!-- QR CODE BOX -->
          <div class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-border-warm text-center relative overflow-hidden">
            <div class="inline-flex items-center gap-1.5 bg-primary-fixed/40 text-deep-forest px-3 py-1 rounded-full font-label-sm text-label-sm font-bold mb-4 border border-border-warm">
              <span class="material-symbols-outlined text-[16px]">qr_code_scanner</span>
              <span><?= e(ps_text('क्यूआर कोड स्कैन करें', 'Scan QR Code')) ?></span>
            </div>

            <!-- SVG Vector QR Code -->
            <div class="bg-soft-meadow p-6 rounded-2xl border border-border-warm inline-block mb-4 shadow-inner">
              <svg class="w-52 h-52 text-deep-forest mx-auto" viewBox="0 0 100 100" fill="currentColor">
                <path d="M0 0h36v36H0zM8 8h20v20H8zm56-8h36v36H64zM72 8h20v20H72zm-72 64h36v36H0zm8 8h20v20H8zm56 2h10v10H64zm16 0h16v16H80zm-16 16h16v10H64zm26 0h10v16H90zm-46-24h10v10H44zm16 0h8v8h-8zm-16 16h12v12H44zm-14-36h10v10H30zm14-16h12v12H44zm14 0h10v10H58zm-14 36h8v8h-8zm30-22h12v12H74z"/>
              </svg>
            </div>
            
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-1">
              <?= e(ps_text('आधिकारिक UPI QR कोड', 'Official UPI QR Code')) ?>
            </h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-4">
              GPay, PhonePe, Paytm, BHIM या किसी भी UPI ऐप से स्कैन करें
            </p>

            <!-- UPI ID Copy Box -->
            <div class="bg-soft-meadow rounded-xl p-3 border border-border-warm flex items-center justify-between gap-2 text-left">
              <div class="flex items-center gap-2 overflow-hidden">
                <span class="material-symbols-outlined text-primary text-lg shrink-0">alternate_email</span>
                <span class="font-title-md text-title-md text-on-surface font-mono font-bold truncate"><?= e($upiId) ?></span>
              </div>
              <button type="button" onclick="copyText('<?= e($upiId) ?>', this)" class="text-primary hover:text-deep-forest font-label-sm text-label-sm bg-pure-white px-3 py-1.5 rounded-lg shadow-sm border border-border-warm flex items-center gap-1 transition-all font-semibold shrink-0 cursor-pointer">
                <span class="material-symbols-outlined text-[14px]">content_copy</span>
                <span><?= e(ps_text('कॉपी', 'Copy')) ?></span>
              </button>
            </div>
          </div>

          <!-- BANK ACCOUNT DETAILS BOX -->
          <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm space-y-4">
            <div class="flex items-center gap-2 border-b border-border-warm pb-3">
              <span class="material-symbols-outlined text-deep-forest text-2xl">account_balance</span>
              <h3 class="font-title-lg text-title-lg text-deep-forest font-bold"><?= e(ps_text('बैंक खाता विवरण (NEFT / RTGS / IMPS)', 'Bank Account Details')) ?></h3>
            </div>

            <div class="space-y-3 font-body-md text-body-md text-on-surface">
              <div class="flex justify-between items-center py-1 border-b border-border-warm/50">
                <span class="text-text-muted text-sm"><?= e(ps_text('खाता धारक:', 'Account Name:')) ?></span>
                <span class="font-bold text-right text-deep-forest text-sm"><?= e($accountName) ?></span>
              </div>
              <div class="flex justify-between items-center py-1 border-b border-border-warm/50">
                <span class="text-text-muted text-sm"><?= e(ps_text('बैंक का नाम:', 'Bank Name:')) ?></span>
                <span class="font-semibold text-right text-sm"><?= e($bankName) ?></span>
              </div>
              <div class="flex justify-between items-center py-1 border-b border-border-warm/50">
                <span class="text-text-muted text-sm"><?= e(ps_text('खाता संख्या:', 'Account No:')) ?></span>
                <span class="font-bold text-right font-mono text-sm text-primary"><?= e($accountNumber) ?></span>
              </div>
              <div class="flex justify-between items-center py-1">
                <span class="text-text-muted text-sm"><?= e(ps_text('IFSC कोड:', 'IFSC Code:')) ?></span>
                <span class="font-bold text-right font-mono text-sm text-primary"><?= e($ifscCode) ?></span>
              </div>
            </div>
          </div>

        </div>

        <!-- RIGHT COLUMN: DONATION SUBMISSION FORM (7 COLS) -->
        <div class="lg:col-span-7">
          <div class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-border-warm">
            <div class="mb-6 border-b border-border-warm pb-4">
              <div class="inline-flex items-center gap-1.5 text-secondary font-label-md text-label-md font-bold mb-1">
                <span class="material-symbols-outlined text-[18px]">edit_note</span>
                <span><?= e(ps_text('सहयोग प्रपत्र • Contribution Form', 'Donation Form')) ?></span>
              </div>
              <h2 class="font-headline-sm text-headline-sm text-deep-forest font-bold">
                <?= e(ps_text('सहयोग विवरण दर्ज करें व रसीद प्राप्त करें', 'Submit Donation & Request Receipt')) ?>
              </h2>
              <p class="font-body-sm text-body-sm text-text-muted mt-1">
                <?= e(ps_text('भुगतान के उपरांत अपना विवरण एवं UTR reference यहाँ दर्ज करें। 24 घंटे के भीतर पावती प्रेषित की जाएगी।', 'Enter your details and transaction reference ID to request an official receipt.')) ?>
              </p>
            </div>

            <form id="donation-form" onsubmit="handleDonationSubmit(event)" class="space-y-5">
              
              <!-- Quick Amount Select Chips -->
              <div>
                <label class="block font-label-md text-label-md text-on-surface font-bold mb-2">
                  <?= e(ps_text('सहयोग राशि (Select Amount)', 'Select Amount')) ?>
                </label>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 mb-3">
                  <button type="button" onclick="setFormAmount(501)" class="amount-btn py-2.5 px-3 rounded-xl font-title-md text-title-md bg-soft-meadow text-deep-forest hover:bg-primary hover:text-pure-white transition-all text-center border border-border-warm font-bold cursor-pointer">
                    ₹501
                  </button>
                  <button type="button" onclick="setFormAmount(1100)" class="amount-btn py-2.5 px-3 rounded-xl font-title-md text-title-md bg-soft-meadow text-deep-forest hover:bg-primary hover:text-pure-white transition-all text-center border border-border-warm font-bold cursor-pointer">
                    ₹1,100
                  </button>
                  <button type="button" onclick="setFormAmount(2100)" class="amount-btn py-2.5 px-3 rounded-xl font-title-md text-title-md bg-soft-meadow text-deep-forest hover:bg-primary hover:text-pure-white transition-all text-center border border-border-warm font-bold cursor-pointer">
                    ₹2,100
                  </button>
                  <button type="button" onclick="setFormAmount(5000)" class="amount-btn py-2.5 px-3 rounded-xl font-title-md text-title-md bg-soft-meadow text-deep-forest hover:bg-primary hover:text-pure-white transition-all text-center border border-border-warm font-bold cursor-pointer">
                    ₹5,000
                  </button>
                </div>
                <div class="relative">
                  <span class="absolute left-3.5 top-3.5 text-text-muted font-bold">₹</span>
                  <input type="number" id="custom-amount" name="amount" required class="w-full pl-8 pr-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                </div>
              </div>

              <!-- Cause Selection Dropdown -->
              <div>
                <label for="cause-select" class="block font-label-md text-label-md text-on-surface font-bold mb-1.5">
                  <?= e(ps_text('अभियान व संकल्प (Select Cause) *', 'Select Cause *')) ?>
                </label>
                <select id="cause-select" name="purpose" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                  <option value=""><?= e(ps_text('-- संकल्प चुनें --', '-- Select Cause --')) ?></option>
                  <option value="hariyali"><?= e(ps_text('हरियाली संकल्प (पौधरोपण व सुरक्षा)', 'Hariyali Tree Plantation')) ?></option>
                  <option value="parinda"><?= e(ps_text('परिंदा संरक्षण (सकोरा व पक्षी दाना-पानी)', 'Bird Conservation & Water Bowls')) ?></option>
                  <option value="culture"><?= e(ps_text('अवधी लोक-संस्कृति व शिक्षा', 'Awadhi Culture & Education')) ?></option>
                  <option value="cloth-bank"><?= e(ps_text('शीतकालीन वस्त्र व आपात राहत', 'Winter Cloth Bank')) ?></option>
                  <option value="general" selected><?= e(ps_text('सामान्य लोकसेवा कोष', 'General Public Support')) ?></option>
                </select>
              </div>

              <!-- Personal Info: Name & Mobile -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                    <?= e(ps_text('आपका नाम (Full Name) *', 'Full Name *')) ?>
                  </label>
                  <input type="text" name="full_name" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                </div>
                <div>
                  <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                    <?= e(ps_text('मोबाइल / WhatsApp *', 'Mobile / WhatsApp *')) ?>
                  </label>
                  <input type="tel" name="mobile" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                </div>
              </div>

              <!-- Email & Payment Method -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                    <?= e(ps_text('ईमेल (Email ID)', 'Email Address')) ?>
                  </label>
                  <input type="email" name="email" class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                </div>
                <div>
                  <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                    <?= e(ps_text('भुगतान माध्यम (Payment Method)', 'Payment Method')) ?>
                  </label>
                  <select name="payment_method" class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                    <option value="UPI / QR Code" selected>UPI / QR Code</option>
                    <option value="Bank Transfer (NEFT/IMPS)">Bank Transfer (NEFT/IMPS)</option>
                    <option value="Cash / In-Person">Cash / In-Person</option>
                  </select>
                </div>
              </div>

              <!-- UTR / Ref ID -->
              <div>
                <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                  <?= e(ps_text('UPI संदर्भ / UTR नंबर (Transaction ID)', 'UPI Reference / UTR Number')) ?>
                </label>
                <input type="text" name="transaction_id" class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container font-mono border border-border-warm transition-all">
                <span class="text-[12px] text-text-muted mt-1 block"><?= e(ps_text('भुगतान के बाद प्राप्त 12 अंकों का UTR संदर्भ दर्ज करें।', 'Enter 12-digit UTR/Ref ID received after transfer.')) ?></span>
              </div>

              <!-- Upload Screenshot (Optional) -->
              <div>
                <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                  <?= e(ps_text('भुगतान की रसीद / स्क्रीनशॉट (Payment Screenshot)', 'Payment Receipt Screenshot')) ?>
                </label>
                <input type="file" name="screenshot" accept="image/*" class="w-full px-4 py-2.5 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md border border-border-warm cursor-pointer">
              </div>

              <!-- Submit Button -->
              <button type="submit" class="w-full bg-[#14532D] hover:bg-[#0F3D21] text-white py-4 rounded-xl font-headline-sm text-headline-sm font-bold transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 cursor-pointer mt-2">
                <span class="material-symbols-outlined text-2xl">verified</span>
                <span><?= e(ps_text('सहयोग विवरण जमा करें', 'Submit Donation Details')) ?></span>
              </button>

              <!-- Feedback Banner -->
              <div id="form-feedback" class="hidden p-4 rounded-xl bg-soft-meadow text-deep-forest font-body-md text-body-md text-center border border-border-warm font-semibold">
                <span class="material-symbols-outlined text-2xl text-primary block mb-1">task_alt</span>
                <?= e(ps_text('हार्दिक धन्यवाद! आपका सहयोग विवरण दर्ज कर लिया गया है। जल्द ही पावती प्रेषित की जाएगी।', 'Thank you! Your donation details have been submitted successfully.')) ?>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<script>
  function setFormAmount(val) {
    const customInput = document.getElementById('custom-amount');
    if (customInput) customInput.value = val;
  }

  function copyText(text, btnElement) {
    navigator.clipboard.writeText(text).then(() => {
      const originalHtml = btnElement.innerHTML;
      btnElement.innerHTML = '<span class="material-symbols-outlined text-[14px]">check</span><span><?= e(ps_text('कॉपी हुआ!', 'Copied!')) ?></span>';
      setTimeout(() => {
        btnElement.innerHTML = originalHtml;
      }, 2000);
    });
  }

  function handleDonationSubmit(e) {
    e.preventDefault();
    const form = document.getElementById('donation-form');
    const feedback = document.getElementById('form-feedback');

    const formData = new FormData(form);
    fetch('<?= e(base_url('/ajax-submit.php')) ?>', {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(j => {
      if (feedback) {
        feedback.classList.remove('hidden');
        feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
      form.reset();
    })
    .catch(() => {
      if (feedback) {
        feedback.classList.remove('hidden');
        feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
      form.reset();
    });
  }
</script>
