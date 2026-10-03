<?php
declare(strict_types=1);

$contactPhone = $settings['phone'] ?? '+91 9919007190';
$contactEmail = $settings['email'] ?? 'volunteer@pradeepsarang.in';
$states = $states ?? [];

$dSettings = ps_get_donation_settings();
$accountName = trim($dSettings['account_name'] ?? '') ?: ps_text('प्रदीप सारंग जनसेवा एवं पर्यावरण न्यास', 'Pradeep Sarang Trust');
$bankName = trim($dSettings['bank_name'] ?? '') ?: ps_text('State Bank of India (भारतीय स्टेट बैंक)', 'State Bank of India (SBI)');
$accountNumber = trim($dSettings['account_number'] ?? '') ?: '38947291048';
$ifscCode = trim($dSettings['ifsc'] ?? '') ?: 'SBIN0005471';
$upiId = trim($dSettings['upi_id'] ?? '') ?: 'pradeepsarang@upi';

// Dynamic UPI QR Codes (Rs 500 for Green Volunteer, Rs 50 for Volunteer)
$qrGreenVolunteer = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&data=' . urlencode("upi://pay?pa={$upiId}&pn=" . rawurlencode($accountName) . "&am=500&cu=INR&tn=" . rawurlencode("Green Volunteer Fee Rs 500"));
$qrVolunteer = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&data=' . urlencode("upi://pay?pa={$upiId}&pn=" . rawurlencode($accountName) . "&am=50&cu=INR&tn=" . rawurlencode("Volunteer Fee 1 Year Rs 50"));
?>

<div class="flex flex-col w-full">
<!-- Top Breadcrumb & Page Introduction Banner -->
<section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
      <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
        <span class="material-symbols-outlined text-[16px]">home</span>
        <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
      </a>
      <span class="opacity-40">/</span>
      <span class="text-deep-forest font-semibold"><?= e(ps_text('स्वयंसेवक पंजीकरण (Volunteer)', 'Volunteer Registration')) ?></span>
    </nav>
    <!-- Category Badges -->
    <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
      <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
      <span><?= e(ps_text('माटी का ऋण और सामाजिक उत्तरदायित्व • ग्रीन गैंग स्वयंसेवक दल', 'Social Responsibility & Green Gang Volunteer Network')) ?></span>
    </div>
    <!-- Main Heading & Subtitle -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start mt-2">
      <div class="lg:col-span-8">
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= ps_text('गाँव की पगडंडियों से बदलाव की राह — <span class="text-primary-container">\'ग्रीन गैंग\'</span> एवं जनसेवा से जुड़ें', 'Path of Change from Village Trails — Join <span class="text-primary-container">\'Green Gang\'</span> & Public Service') ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm leading-relaxed max-w-3xl">
          <?= e(ps_text('पर्यावरण संवर्धन, पक्षी सकोरा वितरण, अवधी भाषा संरक्षण और ग्रामीण जन-जागरूकता अभियानों में अपनी रुचि और समय के अनुसार निस्वार्थ सहभागिता दर्ज करें।', 'Participate in environmental protection, bird water bowl distribution, Awadhi heritage, and community empowerment.')) ?>
        </p>
      </div>
      <!-- Signature Quote Card -->
      <div class="lg:col-span-4">
        <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-warm">
          <div>
            <p class="font-quote-editorial text-body-md text-deep-forest italic leading-relaxed mb-2">
              <?= ps_text('"हारना सीखा नहीं है, जीत का मैं गीत हूँ।<br/>जुगनुओं का संग है, इंसानियत का मीत हूँ।"', '"I have not learned to lose; I am a song of victory.<br/>Accompanied by fireflies, I am a friend to humanity."') ?>
            </p>
            <div class="flex items-center justify-between pt-2 border-t border-border-warm">
              <span class="font-label-sm text-label-sm font-bold tracking-wider">— <span style="color: #ef4444 !important;"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span></span>
              <span class="inline-flex items-center gap-1 text-[11px] font-label-sm text-primary font-semibold">
                <span class="material-symbols-outlined text-[13px]">verified</span>
                <?= e(ps_text('लोकसेवक, बाराबंकी', 'Social Worker, Barabanki')) ?>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Interactive Volunteer Registration Form Section -->
<section class="w-full bg-soft-meadow py-space-3xl px-4 sm:px-8 border-t border-border-warm" id="registration-form">
  <div class="max-w-4xl mx-auto">
    <div class="bg-surface-container-lowest rounded-2xl shadow-md p-6 sm:p-10 border border-border-warm">
      <!-- Form Header -->
      <div class="border-b border-border-warm pb-6 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
          <div class="inline-flex items-center gap-2 bg-emerald-100/90 text-emerald-950 px-4 py-2 rounded-xl font-label-md text-xs sm:text-sm font-bold border border-emerald-300 shadow-xs">
            <span class="material-symbols-outlined text-[18px] text-emerald-700" style="font-variation-settings: 'FILL' 1;">eco</span>
            <span><?= e(ps_text('आँखें फाउंडेशन द्वारा वित्त पोषित तथा प्रदीप सारंग द्वारा संस्थापित "ग्रीन गैंग"', 'Funded by Aankhein Foundation & Founded by Pradeep Sarang — "Green Gang"')) ?></span>
          </div>
          <span class="font-label-sm text-label-sm text-text-muted flex items-center gap-1 shrink-0">
            <span class="material-symbols-outlined text-[15px] text-primary">lock</span>
            <?= e(ps_text('आपकी जानकारी पूर्णतः सुरक्षित है', 'Your details are strictly confidential')) ?>
          </span>
        </div>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest">
          <?= e(ps_text('स्वयंसेवक / सदस्यता सहभागिता प्रपत्र', 'Volunteer / Membership Registration Form')) ?>
        </h2>
        <p class="font-body-sm text-body-sm text-text-muted mt-1">
          <?= e(ps_text('कृपया अपनी सही जानकारी भरें ताकि आपके निकटतम क्षेत्र के ग्रीन गैंग समन्वयक आपसे संपर्क कर सकें।', 'Please enter your authentic details so your nearest Green Gang coordinator can reach out.')) ?>
        </p>
      </div>
      <!-- Membership Classification Notice -->
      <div class="mb-8 p-5 sm:p-6 rounded-2xl bg-gradient-to-br from-emerald-50/90 via-pure-white to-[#F2FBF5] border-2 border-emerald-500/30 shadow-sm">
        <div class="flex items-start gap-3.5">
          <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-xs shrink-0 mt-0.5">
            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">eco</span>
          </div>
          <div class="flex-1 space-y-3">
            <h3 class="font-title-lg text-title-md sm:text-title-lg text-deep-forest font-bold tracking-tight">
              <?= e(ps_text('सदस्यता दो प्रकार की है-', 'Two Types of Membership:')) ?>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pt-1">
              <!-- Tier 1: Green Volunteer -->
              <div class="p-4 rounded-xl bg-pure-white border-2 border-emerald-500/30 shadow-xs flex flex-col justify-between gap-2">
                <div>
                  <div class="flex items-center justify-between gap-2 mb-1.5">
                    <span class="font-bold text-emerald-800 text-body-md flex items-center gap-1.5">
                      <span class="w-5 h-5 rounded-full bg-emerald-600 text-white text-xs flex items-center justify-center font-bold">1</span>
                      <?= e(ps_text('ग्रीन स्वयंसेवक', 'Green Volunteer')) ?>
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-900 border border-emerald-300 font-bold text-xs whitespace-nowrap">₹500 • <?= e(ps_text('एक बार', 'One-time')) ?></span>
                  </div>
                  <p class="font-body-sm text-xs text-deep-forest leading-relaxed">
                    <?= e(ps_text('एक बार 500 रुपये जमा करने वाले व्यक्ति को ग्रीन स्वयं सेवक "ग्रीन वॉलंटियर" तथा "हरित स्वयंसेवक" कहा जायेगा।', 'A person contributing a one-time fee of ₹500 will be designated as a Green Volunteer ("Harit Swayamsevak").')) ?>
                  </p>
                </div>
              </div>

              <!-- Tier 2: Volunteer -->
              <div class="p-4 rounded-xl bg-pure-white border border-border-warm shadow-xs flex flex-col justify-between gap-2">
                <div>
                  <div class="flex items-center justify-between gap-2 mb-1.5">
                    <span class="font-bold text-deep-forest text-body-md flex items-center gap-1.5">
                      <span class="w-5 h-5 rounded-full bg-deep-forest text-white text-xs flex items-center justify-center font-bold">2</span>
                      <?= e(ps_text('स्वयंसेवक', 'Volunteer')) ?>
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full bg-primary/10 text-primary border border-primary/20 font-bold text-xs whitespace-nowrap">₹50 • <?= e(ps_text('१ वर्ष', '1 Year')) ?></span>
                  </div>
                  <p class="font-body-sm text-xs text-text-muted leading-relaxed">
                    <?= e(ps_text('50 रुपये जमा करके कोई व्यक्ति एक वर्ष के लिए "वालंटियर" तथा "स्वयंसेवक" कहा जायेगा।', 'A person contributing ₹50 will be designated as a "Volunteer" / "Swayamsevak" for one year.')) ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Form Body -->
      <form id="volunteerForm" method="post" action="<?= e(base_url('/volunteer')) ?>" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>
        <input type="hidden" name="form_type" value="volunteer">

        <!-- Type Selection: Green Volunteer (One-time ₹500) vs Volunteer (1 Year ₹50) -->
        <div>
          <label class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
            <?= e(ps_text('पंजीकरण का प्रकार चुनें (Select Category)', 'Select Registration Type')) ?> <span class="text-error">*</span>
          </label>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <label class="relative flex items-start gap-3 p-4 rounded-xl border-2 border-emerald-500/40 bg-pure-white hover:border-emerald-600 cursor-pointer transition-all has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/30 has-[:checked]:ring-2 has-[:checked]:ring-emerald-500/20 shadow-xs">
              <input type="radio" name="membership_type" value="Green Volunteer" checked onchange="updateVolunteerPaymentMode(this.value)" class="mt-1 w-4 h-4 accent-emerald-600 text-emerald-600 focus:ring-emerald-500">
              <div class="flex flex-col flex-1">
                <div class="flex items-center justify-between gap-2">
                  <span class="font-body-md font-bold text-emerald-900"><?= e(ps_text('१- ग्रीन स्वयंसेवक', '1- Green Volunteer')) ?></span>
                  <span class="bg-emerald-100 text-emerald-900 font-bold text-xs px-2.5 py-0.5 rounded-full border border-emerald-300 whitespace-nowrap"><?= e(ps_text('₹500 • एक बार', '₹500 • One-time')) ?></span>
                </div>
                <span class="font-label-sm text-xs text-deep-forest mt-1"><?= e(ps_text('एक बार 500 रुपये जमा करने वाले व्यक्ति को "ग्रीन वॉलंटियर" तथा "हरित स्वयंसेवक" कहा जायेगा।', 'One-time ₹500 fee for Green Volunteer / Harit Swayamsevak designation.')) ?></span>
              </div>
            </label>
            <label class="relative flex items-start gap-3 p-4 rounded-xl border border-border-warm bg-pure-white hover:border-primary cursor-pointer transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5 has-[:checked]:ring-2 has-[:checked]:ring-primary/20 shadow-xs">
              <input type="radio" name="membership_type" value="Volunteer" onchange="updateVolunteerPaymentMode(this.value)" class="mt-1 w-4 h-4 accent-primary text-primary focus:ring-primary">
              <div class="flex flex-col flex-1">
                <div class="flex items-center justify-between gap-2">
                  <span class="font-body-md font-bold text-deep-forest"><?= e(ps_text('२- स्वयंसेवक', '2- Volunteer')) ?></span>
                  <span class="bg-primary/10 text-primary font-bold text-xs px-2.5 py-0.5 rounded-full border border-primary/20 whitespace-nowrap"><?= e(ps_text('₹50 • १ वर्ष', '₹50 • 1 Year')) ?></span>
                </div>
                <span class="font-label-sm text-xs text-text-muted mt-1"><?= e(ps_text('50 रुपये जमा करके कोई व्यक्ति एक वर्ष के लिए "वालंटियर" तथा "स्वयंसेवक" कहा जायेगा।', '₹50 contribution for 1-year Volunteer active membership.')) ?></span>
              </div>
            </label>
          </div>
        </div>

        <!-- Row 1: Full Name & WhatsApp Number -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label for="fullName" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('पूरा नाम (Full Name)', 'Full Name')) ?> <span class="text-error">*</span>
            </label>
            <input type="text" id="fullName" name="full_name" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
          <div>
            <label for="whatsappNumber" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('मोबाइल / WhatsApp नंबर', 'Mobile / WhatsApp Number')) ?> <span class="text-error">*</span>
            </label>
            <input type="tel" id="whatsappNumber" name="phone" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
        </div>

        <!-- Row 2: Father Name & Email -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label for="fatherName" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('पिता / अभिभावक का नाम', 'Father / Guardian Name')) ?>
            </label>
            <input type="text" id="fatherName" name="father_name" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
          <div>
            <label for="emailAddress" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('ईमेल पता (Email Address)', 'Email Address')) ?> <span class="text-error">*</span>
            </label>
            <input type="email" id="emailAddress" name="email" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
        </div>

        <!-- Row 3: Gender, DOB, Occupation -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
          <div>
            <label for="genderSelect" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('लिंग (Gender)', 'Gender')) ?>
            </label>
            <select id="genderSelect" name="gender" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
              <option value="Male"><?= e(ps_text('पुरुष (Male)', 'Male')) ?></option>
              <option value="Female"><?= e(ps_text('महिला (Female)', 'Female')) ?></option>
              <option value="Other"><?= e(ps_text('अन्य (Other)', 'Other')) ?></option>
            </select>
          </div>
          <div>
            <label for="userDob" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('जन्म तिथि (Date of Birth)', 'Date of Birth')) ?>
            </label>
            <input type="date" id="userDob" name="dob" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
          <div>
            <label for="userOccupation" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('व्यवसाय / पेशा', 'Occupation')) ?>
            </label>
            <input type="text" id="userOccupation" name="occupation" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
        </div>

        <!-- Row 4: State, District, Pincode -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
          <div>
            <label for="stateSelect" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('राज्य (State)', 'State')) ?> <span class="text-error">*</span>
            </label>
            <select id="stateSelect" name="state" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
              <option value=""><?= e(ps_text('राज्य चुनें', 'Choose State')) ?></option>
              <?php foreach ($states as $st): ?>
                <option value="<?= e((string)$st['state_id']) ?>"><?= e($st['state_name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label for="districtSelect" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('जिला (District)', 'District')) ?> <span class="text-error">*</span>
            </label>
            <select id="districtSelect" name="district" disabled required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
              <option value=""><?= e(ps_text('जिला चुनें', 'Choose District')) ?></option>
            </select>
          </div>
          <div>
            <label for="userPincode" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('पिनकोड (PIN Code)', 'PIN Code')) ?>
            </label>
            <input type="text" id="userPincode" name="pincode" inputmode="numeric" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
        </div>

        <!-- Selection: Domains of Contribution (Abhiyan Selection) -->
        <div class="p-5 rounded-xl bg-soft-meadow border border-border-warm">
          <label for="userInterests" class="block font-title-md text-title-md text-deep-forest font-bold mb-3">
            <?= e(ps_text('आप किस अभियान में सहभागिता करना चाहते हैं? (अभियान सूची)', 'Which Campaign / Initiative do you wish to join?')) ?> <span class="text-error">*</span>
          </label>
          <select id="userInterests" name="interests" required onchange="updateVolunteerPledge(this.value)" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all cursor-pointer">
            <option value=""><?= e(ps_text('-- अपना पसंदीदा अभियान चुनें --', '-- Select an Initiative / Campaign --')) ?></option>
            <?php foreach (ps_get_campaigns() as $camp): ?>
              <?php
                $campTitle = ps_text($camp['title'] ?? '', $camp['en_title'] ?? ($camp['title'] ?? ''));
                if (empty(trim($campTitle))) continue;
              ?>
              <option value="<?= e($campTitle) ?>"><?= e($campTitle) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Selection: Time Availability -->
        <div class="p-5 rounded-xl bg-soft-meadow border border-border-warm">
          <label for="userAvailability" class="block font-title-md text-title-md text-deep-forest font-bold mb-3">
            <?= e(ps_text('समय की उपलब्धता (Time Availability)', 'Time Availability')) ?>
          </label>
          <select id="userAvailability" name="availability" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
            <option value="Flexible"><?= e(ps_text('लचीला समय (Flexible Time)', 'Flexible')) ?></option>
            <option value="Weekends"><?= e(ps_text('सप्ताहांत (Saturday-Sunday)', 'Weekends')) ?></option>
            <option value="Weekdays"><?= e(ps_text('कार्यदिवस (Monday-Friday)', 'Weekdays')) ?></option>
            <option value="On-Call"><?= e(ps_text('आवश्यकतानुसार ऑन-कॉल (Emergency On-Call)', 'Emergency On-Call')) ?></option>
          </select>
        </div>

        <!-- Upload Passport Photo & Resume -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label for="userPhoto" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('पासपोर्ट साइज फोटो (Photo Upload)', 'Passport Photo')) ?>
            </label>
            <input type="file" id="userPhoto" name="photo" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-sm text-body-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-label-sm file:font-semibold file:bg-primary-container file:text-on-primary hover:file:bg-deep-forest">
          </div>
          <div>
            <label for="userResume" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('रिज्यूमे / परिचय दस्तावेज़ (Optional Resume)', 'Optional Resume')) ?>
            </label>
            <input type="file" id="userResume" name="resume" accept=".pdf,.doc,.docx" class="w-full px-3 py-2 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-sm text-body-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-label-sm file:font-semibold file:bg-soft-meadow file:text-deep-forest hover:file:bg-surface-container">
          </div>
        </div>

        <!-- Payment & Confirmation Section (QR Code, UPI, Screenshot Upload) -->
        <div id="paymentSectionBox" class="p-6 sm:p-7 rounded-2xl bg-gradient-to-br from-[#F4F9F5] via-pure-white to-[#F7F9F6] border-2 border-emerald-500/30 shadow-sm space-y-6">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-border-warm">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-emerald-700 text-white flex items-center justify-center shadow-xs shrink-0">
                <span class="material-symbols-outlined text-[24px]">payments</span>
              </div>
              <div>
                <h3 id="paymentSectionTitle" class="font-title-lg text-title-lg text-deep-forest font-bold">
                  <?= e(ps_text('ग्रीन स्वयंसेवक शुल्क भुगतान — ₹500', 'Green Volunteer Fee Payment — ₹500')) ?>
                </h3>
                <p id="paymentSectionSubtitle" class="font-label-sm text-xs text-text-muted mt-0.5">
                  <?= e(ps_text('ग्रीन स्वयंसेवक ("ग्रीन वॉलंटियर" / "हरित स्वयंसेवक") हेतु ₹500/- का भुगतान कर स्क्रीनशॉट अपलोड करें।', 'Pay ₹500/- for Green Volunteer ("Harit Swayamsevak") and upload screenshot.')) ?>
                </p>
              </div>
            </div>
            <div id="paymentFeeBadge" class="self-start sm:self-auto px-3.5 py-1.5 rounded-xl bg-emerald-100 border border-emerald-300 text-emerald-900 font-bold text-sm">
              <?= e(ps_text('₹500 • एक बार / स्थायी', '₹500 • One-time')) ?>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
            <!-- QR Code Box -->
            <div class="md:col-span-5 flex flex-col items-center justify-center bg-pure-white p-5 rounded-xl border border-border-warm shadow-xs text-center">
              <div class="relative p-3 bg-pure-white rounded-xl border-2 border-emerald-600/30 shadow-xs mb-3">
                <img id="volunteerQrImg" src="<?= e($qrGreenVolunteer) ?>" data-green-qr="<?= e($qrGreenVolunteer) ?>" data-vol-qr="<?= e($qrVolunteer) ?>" alt="UPI QR Code" class="w-44 h-44 object-contain rounded-lg">
                <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 bg-emerald-800 text-white text-[9px] font-bold px-2.5 py-0.5 rounded-full shadow-xs tracking-wider uppercase whitespace-nowrap">
                  BHIM UPI • GPay • PhonePe • Paytm
                </div>
              </div>
              <p id="qrScanLabel" class="font-label-sm text-xs font-bold text-deep-forest mt-2">
                <?= e(ps_text('ग्रीन स्वयंसेवक ₹500 QR कोड', 'Green Volunteer ₹500 QR Code')) ?>
              </p>
              <p class="font-label-sm text-[11px] text-text-muted"><?= e($accountName) ?></p>
            </div>

            <!-- UPI ID & Bank Details -->
            <div class="md:col-span-7 space-y-3.5">
              <!-- UPI ID Pill -->
              <div>
                <label class="block font-label-sm text-xs text-deep-forest font-bold mb-1.5">
                  <?= e(ps_text('आधिकारिक UPI ID (क्लिक कर कॉपी करें):', 'Official UPI ID:')) ?>
                </label>
                <div class="flex items-center justify-between p-3 rounded-xl bg-soft-meadow border border-border-warm">
                  <div class="flex items-center gap-2 overflow-hidden">
                    <span class="material-symbols-outlined text-primary text-base">alternate_email</span>
                    <span class="font-mono font-bold text-sm text-deep-forest select-all truncate"><?= e($upiId) ?></span>
                  </div>
                  <button type="button" onclick="navigator.clipboard.writeText('<?= e($upiId) ?>'); alert('UPI ID copied: <?= e($upiId) ?>');" class="px-3 py-1 bg-pure-white hover:bg-surface-container text-primary font-label-sm text-xs rounded-lg border border-border-warm font-semibold shadow-xs transition-all cursor-pointer shrink-0">
                    <?= e(ps_text('कॉपी करें', 'Copy')) ?>
                  </button>
                </div>
              </div>

              <!-- Bank Account Snapshot -->
              <div class="p-3.5 rounded-xl bg-pure-white border border-border-warm text-xs space-y-1 text-on-surface">
                <div class="flex justify-between">
                  <span class="text-text-muted"><?= e(ps_text('खाता धारक:', 'Account Name:')) ?></span>
                  <span class="font-semibold text-right"><?= e($accountName) ?></span>
                </div>
                <div class="flex justify-between">
                  <span class="text-text-muted"><?= e(ps_text('बैंक व खाता संख्या:', 'Bank & A/C:')) ?></span>
                  <span class="font-mono font-semibold text-right"><?= e($bankName) ?> (<?= e($accountNumber) ?>)</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-text-muted"><?= e(ps_text('IFSC कोड:', 'IFSC:')) ?></span>
                  <span class="font-mono font-semibold text-right"><?= e($ifscCode) ?></span>
                </div>
              </div>

              <!-- Important Note -->
              <div id="paymentInstructionNote" class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-start gap-2">
                <span class="material-symbols-outlined text-emerald-700 text-base shrink-0 mt-0.5">eco</span>
                <span><?= e(ps_text('एक बार 500 रुपये जमा करने वाले व्यक्ति को ग्रीन स्वयं सेवक "ग्रीन वॉलंटियर" तथा "हरित स्वयंसेवक" कहा जायेगा।', 'A person contributing a one-time fee of ₹500 will be designated as a Green Volunteer ("Harit Swayamsevak").')) ?></span>
              </div>
            </div>
          </div>

          <!-- Transaction ID & Screenshot Upload Row (MANDATORY) -->
          <div class="pt-4 border-t border-border-warm grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label for="paymentScreenshot" class="block font-label-md text-label-md text-deep-forest font-bold mb-1.5">
                <?= e(ps_text('भुगतान का स्क्रीनशॉट (Payment Screenshot)', 'Payment Screenshot')) ?> <span class="text-error">*</span>
              </label>
              <input type="file" id="paymentScreenshot" name="payment_screenshot" required accept="image/*,.pdf" class="w-full px-3 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-sm text-body-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-label-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-deep-forest cursor-pointer">
              <span class="block font-label-sm text-[11px] text-text-muted mt-1">
                <?= e(ps_text('UPI / बैंक भुगतान की रसीद या स्क्रीनशॉट (JPG, PNG, PDF)', 'Upload receipt/screenshot of UPI or bank transfer')) ?>
              </span>
            </div>

            <div>
              <label for="transactionId" class="block font-label-md text-label-md text-deep-forest font-bold mb-1.5">
                <?= e(ps_text('ट्रांजैक्शन / UTR आईडी (Transaction / UTR ID)', 'Transaction / UTR ID')) ?> <span class="text-error">*</span>
              </label>
              <input type="text" id="transactionId" name="transaction_id" required placeholder="उदा. UTR: 4289XXXXXXXX / UPI Ref No." class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all font-mono">
              <span class="block font-label-sm text-[11px] text-text-muted mt-1">
                <?= e(ps_text('12 अंकों का UPI UTR नंबर या बैंक रेफरेंस नंबर दर्ज करें', 'Enter 12-digit UPI UTR number or bank reference')) ?>
              </span>
            </div>
          </div>
        </div>

        <!-- Message / Motivation -->
        <div>
          <label for="userMessage" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
            <?= e(ps_text('आप इस अभियान से क्यों जुड़ना चाहते हैं? (संदेश / विचार)', 'Message / Why do you want to join?')) ?>
          </label>
          <textarea id="userMessage" name="message" rows="3" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all"></textarea>
        </div>

        <!-- Pledge Checkbox -->
        <div class="bg-tertiary-fixed/20 p-4 rounded-xl border border-tertiary-fixed/40 transition-all duration-300" id="pledgeBox">
          <label class="flex items-start gap-3 cursor-pointer">
            <input type="checkbox" required class="mt-1 w-5 h-5 rounded border-border-warm text-primary-container focus:ring-fresh-sprout/30 shrink-0">
            <span class="font-body-sm text-body-sm text-deep-forest leading-relaxed">
              <strong><?= e(ps_text('हमारा संकल्प:', 'Our Pledge:')) ?></strong> <span id="volunteerPledgeText"><?= e(ps_text('मैं \'ग्रीन मॉर्निंग\' की उदात्त भावना, निस्वार्थ समाजसेवा और पर्यावरण रक्षा के प्रति पूर्ण निष्ठावान रहने का वचन देता/देती हूँ।', 'I pledge commitment to Green Morning, selfless public service and environmental protection.')) ?></span>
            </span>
          </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2 flex flex-col sm:flex-row items-center gap-4">
          <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-title-md text-title-md font-bold shadow-md transition-all flex items-center justify-center gap-2 border-0 cursor-pointer" style="background-color: #14532d; color: #ffffff;">
            <span style="color: #ffffff;"><?= e(ps_text('स्वयंसेवक के रूप में पंजीकृत हों (Submit Application)', 'Submit Volunteer Application')) ?></span>
            <span class="material-symbols-outlined text-[20px]" style="color: #ffffff;">arrow_forward</span>
          </button>
          <span class="font-label-sm text-label-sm text-text-muted text-center sm:text-left">
            <?= e(ps_text('प्रदीप सारंग जन-अभियान सेल • बाराबंकी, उत्तर प्रदेश', 'Pradeep Sarang Volunteer Cell • Barabanki, UP')) ?>
          </span>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Volunteer Voices & Testimonials -->
<section class="w-full py-space-3xl px-4 sm:px-8 bg-cream-canvas">
  <div class="max-w-container-max mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-10">
      <span class="inline-block px-3 py-1 rounded-md bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold mb-2">
        <?= e(ps_text('ज़मीनी साथियों के अनुभव', 'Volunteer Stories')) ?>
      </span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest"><?= e(ps_text('जो राह में साथ चले, वही परिवार बने', 'Together on the Path of Change')) ?></h2>
      <p class="font-body-md text-body-md text-text-muted mt-2">
        <?= e(ps_text('ग्रीन गैंग और जनसेवा अभियानों से जुड़े स्वयंसेवकों की ज़ुबानी, उनकी प्रेरणा की सच्ची कहानियाँ।', 'Real stories of volunteers actively serving across Barabanki.')) ?>
      </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Testimonial 1 -->
      <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center gap-1 text-tertiary mb-3">
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
          </div>
          <p class="font-quote-editorial text-body-md text-deep-forest italic leading-relaxed mb-6">
            <?= ps_text('"कॉलेज के बाद रविवार को जब हम सतरिख मार्ग पर रोपे गए पौधों की रखवाली और बाड़ लगाते हैं, तो दिल को गहरा सुकून मिलता है कि हम अपनी धरती के लिए कुछ कर रहे हैं।"', '"Protecting saplings on Satrikh road every Sunday gives immense joy that we are serving our mother earth."') ?>
          </p>
        </div>
        <div class="flex items-center gap-3 pt-4 border-t border-border-warm">
          <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-label-md">
            <?= e(ps_text('रा.व.', 'R.V.')) ?>
          </div>
          <div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold leading-tight"><?= e(ps_text('राहुल वर्मा', 'Rahul Verma')) ?></h4>
            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('युवा समन्वयक, कमरावां (बाराबंकी)', 'Youth Coordinator, Kamrawan')) ?></span>
          </div>
        </div>
      </div>
      <!-- Testimonial 2 -->
      <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center gap-1 text-tertiary mb-3">
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
          </div>
          <p class="font-quote-editorial text-body-md text-deep-forest italic leading-relaxed mb-6">
            <?= ps_text('"सकोरा वितरण अभियान से जुड़ने के बाद मेरी पूरी गली के लोग अब अपनी-अपनी छतों पर पक्षियों के लिए पानी व दाना रखने लगे हैं। नन्हे परिंदों की चहचहाहट ही हमारा पारितोषिक है।"', '"After joining Sakora distribution, our entire lane puts water bowls on roofs for birds. Chirping birds are our reward."') ?>
          </p>
        </div>
        <div class="flex items-center gap-3 pt-4 border-t border-border-warm">
          <div class="w-10 h-10 rounded-full bg-secondary-fixed text-secondary flex items-center justify-center font-bold text-label-md">
            <?= e(ps_text('सु.या.', 'S.Y.')) ?>
          </div>
          <div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold leading-tight"><?= e(ps_text('सुमनलता यादव', 'Sumanlata Yadav')) ?></h4>
            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('परिंदा सहेली, नगर क्षेत्र बाराबंकी', 'Bird Conservation Lead, Barabanki')) ?></span>
          </div>
        </div>
      </div>
      <!-- Testimonial 3 -->
      <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center gap-1 text-tertiary mb-3">
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
          </div>
          <p class="font-quote-editorial text-body-md text-deep-forest italic leading-relaxed mb-6">
            <?= ps_text('"सारंग जी के साथ अवधी चौपालों में जाना और बुजुर्गों के लोक संस्मरणों को सहेजना एक नई चेतना जगाता है। हमारी भाषा ही हमारी अस्मिता है।"', '"Attending Awadhi chaupals with Shri Sarang & documenting elder folk wisdom awakens cultural pride."') ?>
          </p>
        </div>
        <div class="flex items-center gap-3 pt-4 border-t border-border-warm">
          <div class="w-10 h-10 rounded-full bg-tertiary-fixed text-tertiary flex items-center justify-center font-bold text-label-md">
            <?= e(ps_text('अ.अ.', 'A.A.')) ?>
          </div>
          <div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold leading-tight"><?= e(ps_text('डॉ. अमित अवस्थी', 'Dr. Amit Awasthi')) ?></h4>
            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('सांस्कृतिक शोधार्थी व भाषा दूत', 'Cultural Scholar')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section (Accordions) -->
<section class="w-full bg-soft-meadow py-space-3xl px-4 sm:px-8 border-t border-border-warm">
  <div class="max-w-container-editorial mx-auto">
    <div class="text-center mb-10">
      <span class="inline-block px-3 py-1 rounded-md bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold mb-2">
        <?= e(ps_text('शंका-समाधान', 'FAQ')) ?>
      </span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest"><?= e(ps_text('अक्सर पूछे जाने वाले प्रश्न (FAQ)', 'Frequently Asked Questions')) ?></h2>
    </div>
    <div class="space-y-4" id="faq-accordion-volunteer">
      <!-- FAQ 1 -->
      <div class="bg-surface-container-lowest rounded-xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleVolunteerFaq('vfaq-1')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold">
            <?= e(ps_text('क्या स्वयंसेवक बनने के लिए बाराबंकी का निवासी होना अनिवार्य है?', 'Is it mandatory to live in Barabanki to become a volunteer?')) ?>
          </span>
          <span id="icon-vfaq-1" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="vfaq-1" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('नहीं। यद्यपि हमारे प्रत्यक्ष मैदानी अभियान बाराबंकी और अवध क्षेत्र में केंद्रित हैं, किंतु डिजिटल संवाद, अवधी साहित्य संकलन और \'परिंदा संरक्षण\' (अपने घर/छत पर सकोरा लगाना) जैसे कार्य आप किसी भी शहर या गाँव से संचालित कर सकते हैं।', 'No! While ground drives focus on Barabanki, you can join bird protection and digital/literary drives from anywhere.')) ?>
        </div>
      </div>
      <!-- FAQ 2 -->
      <div class="bg-surface-container-lowest rounded-xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleVolunteerFaq('vfaq-2')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold">
            <?= e(ps_text('क्या इस अभियान से जुड़ने का कोई सदस्यता शुल्क है?', 'Is there any membership fee to join?')) ?>
          </span>
          <span id="icon-vfaq-2" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="vfaq-2" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('बिल्कुल नहीं। यह शत-प्रतिशत निःशुल्क, लोक-सरोकारी और जनहितैषी अभियान है। यहाँ किसी भी प्रकार का आर्थिक अंशदान अनिवार्य नहीं है; आपका समय, निष्ठा और सेवाभाव ही सबसे बड़ा योगदान है।', 'None at all. 100% free public initiative. Your time and service spirit is the only contribution.')) ?>
        </div>
      </div>
      <!-- FAQ 3 -->
      <div class="bg-surface-container-lowest rounded-xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleVolunteerFaq('vfaq-3')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold">
            <?= e(ps_text('क्या कॉलेज के विद्यार्थियों को सामाजिक सेवा प्रमाण पत्र प्राप्त होता है?', 'Do students get social service experience certificates?')) ?>
          </span>
          <span id="icon-vfaq-3" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="vfaq-3" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('हाँ। कम से कम ३० घंटे या किसी विशेष अभियान (जैसे तुलसी जयंती पखवाड़ा, हरियाली पखवाड़ा, या रक्त सेवा) में सक्रिय सहभागिता निभाने वाले छात्र-छात्राओं को प्रदीप सारंग जी के हस्ताक्षरयुक्त सामाजिक अनुभव प्रमाण पत्र प्रदान किया जाता है।', 'Yes! Students participating actively receive a signed social service experience certificate.')) ?>
        </div>
      </div>
      <!-- FAQ 4 -->
      <div class="bg-surface-container-lowest rounded-xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleVolunteerFaq('vfaq-4')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold">
            <?= e(ps_text('\'ग्रीन गैंग\' की विशेष पहचान और दिनचर्या क्या है?', 'What is the Green Gang routine & identity?')) ?>
          </span>
          <span id="icon-vfaq-4" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="vfaq-4" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('ग्रीन गैंग के सदस्य प्रभात में परस्पर मिलते समय \'गुड मॉर्निंग\' की जगह \'ग्रीन मॉर्निंग!\' का उद्घोष करते हैं। उनका मुख्य धर्म अपने आसपास कम से कम पाँच नए पौधों को जीवित रखना और एक बेजुबान जीव के दाने-पानी की चिंता करना है।', 'Green Gang members greet with \'Green Morning!\' and commit to keeping 5 trees alive and feeding local birds.')) ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Direct Coordinator Contact & Cross-Links Footer Banner -->
<section class="w-full py-space-2xl px-4 sm:px-8 border-t border-border-warm bg-cream-canvas">
  <div class="max-w-container-max mx-auto">
    <div class="bg-surface-container rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-deep-forest text-pure-white flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-[26px]">support_agent</span>
        </div>
        <div>
          <h4 class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('सीधे स्वयंसेवक समन्वयक से बात करें', 'Speak Directly with Volunteer Coordinator')) ?></h4>
          <p class="font-body-sm text-body-sm text-text-muted">
            <?= e(ps_text('किसी भी प्रश्न, सामूहिक पंजीकरण या स्कूल-कॉलेज ड्राइव हेतु संपर्क करें।', 'Contact for group enrollment, school/college drives or questions.')) ?>
          </p>
        </div>
      </div>
      <div class="flex flex-wrap items-center gap-4">
        <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $contactPhone)) ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-lowest text-deep-forest font-label-md text-label-md font-bold shadow-sm hover:bg-pure-white transition-colors">
          <span class="material-symbols-outlined text-[18px] text-primary">call</span>
          <span><?= e($contactPhone) ?></span>
        </a>
        <a href="mailto:<?= e($contactEmail) ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-lowest text-deep-forest font-label-md text-label-md font-bold shadow-sm hover:bg-pure-white transition-colors">
          <span class="material-symbols-outlined text-[18px] text-secondary">mail</span>
          <span><?= e($contactEmail) ?></span>
        </a>
        <a href="#registration-form" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-bold hover:bg-deep-forest transition-colors shadow-sm">
          <span><?= e(ps_text('पंजीकरण प्रपत्र पर जाएँ', 'Go to Form')) ?></span>
          <span class="material-symbols-outlined text-[16px]">arrow_upward</span>
        </a>
      </div>
    </div>
  </div>
</section>
</div>

<script>
  // State & City Dynamic Dropdown AJAX Handler
  document.addEventListener('DOMContentLoaded', () => {
    const s = document.getElementById('stateSelect');
    const d = document.getElementById('districtSelect');
    s?.addEventListener('change', async () => {
      d.innerHTML = '<option value=""><?= e(ps_text('जिला चुनें', 'Choose district')) ?></option>';
      d.disabled = true;
      if (!s.value) return;
      try {
        const r = await fetch('<?= e(base_url('/api/cities')) ?>?state_id=' + encodeURIComponent(s.value));
        const j = await r.json();
        if (j.status === 'success') {
          j.data.forEach(c => d.add(new Option(c.city_name, c.city_name)));
          d.disabled = !j.data.length;
        }
      } catch {
        d.disabled = true;
      }
    });
  });

  function selectPillar(pillarName) {
    const input = document.getElementById('userInterests');
    if (input) {
      input.value = pillarName;
      updateVolunteerPledge(pillarName);
      const formElem = document.getElementById('registration-form');
      if (formElem) {
        formElem.scrollIntoView({ behavior: 'smooth' });
      }
    }
  }

  function updateVolunteerPledge(val) {
    const textEl = document.getElementById('volunteerPledgeText');
    if (!textEl) return;
    const str = (val || '').toLowerCase();
    if (str.includes('पटेल') || str.includes('patel') || str.includes('सरदार') || str.includes('sardar') || str.includes('एकता')) {
      textEl.innerText = '<?= e(ps_text('आधुनिक भारत के शिल्पी सरदार वल्लभ भाई पटेल के विचारों के अनुरूप भारत की एकता अखंडता को बनाये रखने का संकल्प लेता हूँ।', 'In accordance with the ideals of Sardar Vallabhbhai Patel, the architect of modern India, I pledge to preserve the unity and integrity of India.')) ?>';
    } else {
      textEl.innerText = '<?= e(ps_text('मैं \'ग्रीन मॉर्निंग\' की उदात्त भावना, निस्वार्थ समाजसेवा और पर्यावरण रक्षा के प्रति पूर्ण निष्ठावान रहने का वचन देता/देती हूँ।', 'I pledge commitment to Green Morning, selfless public service and environmental protection.')) ?>';
    }
  }

  function toggleVolunteerFaq(id) {
    const el = document.getElementById(id);
    const icon = document.getElementById('icon-' + id);
    if (!el) return;
    if (el.classList.contains('hidden')) {
      el.classList.remove('hidden');
      if (icon) icon.style.transform = 'rotate(180deg)';
    } else {
      el.classList.add('hidden');
      if (icon) icon.style.transform = 'rotate(0deg)';
    }
  }

  function updateVolunteerPaymentMode(mode) {
    const qrImg = document.getElementById('volunteerQrImg');
    const title = document.getElementById('paymentSectionTitle');
    const subtitle = document.getElementById('paymentSectionSubtitle');
    const badge = document.getElementById('paymentFeeBadge');
    const scanLabel = document.getElementById('qrScanLabel');
    const note = document.getElementById('paymentInstructionNote');

    if (mode === 'Green Volunteer' || mode === 'Membership') {
      if (qrImg) qrImg.src = qrImg.getAttribute('data-green-qr');
      if (title) title.innerText = '<?= e(ps_text('ग्रीन स्वयंसेवक शुल्क भुगतान — ₹500', 'Green Volunteer Fee Payment — ₹500')) ?>';
      if (subtitle) subtitle.innerText = '<?= e(ps_text('ग्रीन स्वयंसेवक ("ग्रीन वॉलंटियर" / "हरित स्वयंसेवक") हेतु ₹500/- का भुगतान कर स्क्रीनशॉट अपलोड करें।', 'Pay ₹500/- for Green Volunteer ("Harit Swayamsevak") and upload screenshot.')) ?>';
      if (badge) {
        badge.className = 'self-start sm:self-auto px-3.5 py-1.5 rounded-xl bg-emerald-100 border border-emerald-300 text-emerald-900 font-bold text-sm';
        badge.innerText = '<?= e(ps_text('₹500 • एक बार / स्थायी', '₹500 • One-time')) ?>';
      }
      if (scanLabel) scanLabel.innerText = '<?= e(ps_text('ग्रीन स्वयंसेवक ₹500 QR कोड', 'Green Volunteer ₹500 QR Code')) ?>';
      if (note) note.innerHTML = '<span class="material-symbols-outlined text-emerald-700 text-base shrink-0 mt-0.5">eco</span><span><?= e(ps_text('एक बार 500 रुपये जमा करने वाले व्यक्ति को ग्रीन स्वयं सेवक "ग्रीन वॉलंटियर" तथा "हरित स्वयंसेवक" कहा जायेगा।', 'A person contributing a one-time fee of ₹500 will be designated as a Green Volunteer ("Harit Swayamsevak").')) ?></span>';
    } else {
      if (qrImg) qrImg.src = qrImg.getAttribute('data-vol-qr');
      if (title) title.innerText = '<?= e(ps_text('स्वयंसेवक शुल्क भुगतान — ₹50 (१ वर्ष)', 'Volunteer Contribution & Fee (1 Year) — ₹50')) ?>';
      if (subtitle) subtitle.innerText = '<?= e(ps_text('१ वर्ष के लिए "वालंटियर" / "स्वयंसेवक" नामांकन हेतु ₹50/- का भुगतान कर स्क्रीनशॉट अपलोड करें।', 'Pay ₹50/- for 1-year volunteer enrollment and upload transaction screenshot.')) ?>';
      if (badge) {
        badge.className = 'self-start sm:self-auto px-3.5 py-1.5 rounded-xl bg-primary/10 border border-primary/30 text-primary font-bold text-sm';
        badge.innerText = '<?= e(ps_text('₹50 • १ वर्ष', '₹50 • 1 Year')) ?>';
      }
      if (scanLabel) scanLabel.innerText = '<?= e(ps_text('स्वयंसेवक शुल्क ₹50 QR कोड', 'Volunteer ₹50 QR Code')) ?>';
      if (note) note.innerHTML = '<span class="material-symbols-outlined text-primary text-base shrink-0 mt-0.5">info</span><span><?= e(ps_text('50 रुपये जमा करके कोई व्यक्ति एक वर्ष के लिए "वालंटियर" तथा "स्वयंसेवक" कहा जायेगा।', 'A person contributing ₹50 will be designated as a "Volunteer" / "Swayamsevak" for one year.')) ?></span>';
    }
  }
</script>
