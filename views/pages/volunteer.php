<?php
declare(strict_types=1);
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/')) ?>">होम</a></li>
                    <li class="breadcrumb-item active" aria-current="page">स्वयंसेवक पंजीकरण</li>
                </ol>
            </nav>
            <div class="d-block mb-2">
                <span class="banner-kicker"><i class="fa-solid fa-handshake-angle me-1"></i> जुड़ें और सेवा करें</span>
            </div>
            <h1>स्वयंसेवक (Volunteer) बनें</h1>
            <p>समाज निर्माण, शिक्षा, स्वास्थ्य एवं पर्यावरण संरक्षण के पुनीत कार्य में हमारे साथ सहभागी बनें।</p>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <!-- Left Info Panel -->
            <div class="col-lg-5">
                <div class="sticky-top" style="top: 100px;">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4 bg-primary text-white">
                        <h3 class="text-white fw-bold mb-3">समाज निर्माण में आपकी भूमिका</h3>
                        <p class="text-white-50">
                            प्रदीप सारंग फाउंडेशन के साथ जुड़कर आप अपने कौशल और समय का सदुपयोग समाज के जरूरतमंदों के उत्थान के लिए कर सकते हैं।
                        </p>
                        
                        <div class="d-flex flex-column gap-3 mt-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle bg-warning text-dark p-2 d-flex align-items-center justify-content-center" style="width:36px;height:36px;"><i class="fa-solid fa-graduation-cap"></i></div>
                                <div>
                                    <h6 class="text-white mb-0 fw-bold">शिक्षा एवं मार्गदर्शन</h6>
                                    <small class="text-white-50">बच्चों को शिक्षण व कैरियर परामर्श</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle bg-warning text-dark p-2 d-flex align-items-center justify-content-center" style="width:36px;height:36px;"><i class="fa-solid fa-droplet"></i></div>
                                <div>
                                    <h6 class="text-white mb-0 fw-bold">रक्तदान व स्वास्थ्य शिविर</h6>
                                    <small class="text-white-50">आपातकालीन रक्त सहायता व समन्वय</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle bg-warning text-dark p-2 d-flex align-items-center justify-content-center" style="width:36px;height:36px;"><i class="fa-solid fa-tree"></i></div>
                                <div>
                                    <h6 class="text-white mb-0 fw-bold">पर्यावरण व वृक्षारोपण</h6>
                                    <small class="text-white-50">पौधारोपण व स्वच्छता जागरूकता</small>
                                </div>
                            </div>
                        </div>

                        <hr class="border-white-50 my-4">

                        <div class="small text-white-50">
                            <i class="fa-solid fa-id-card me-1 text-warning"></i> सभी पंजीकृत स्वयंसेवकों को आधिकारिक प्रमाण-पत्र एवं परिचय पत्र (ID Card) प्रदान किया जाएगा।
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Registration Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h3 class="fw-bold mb-1">स्वयंसेवक पंजीकरण फॉर्म</h3>
                    <p class="text-muted small mb-4">कृपया सभी आवश्यक विवरण सही-सही भरें।</p>

                    <form method="post" action="<?= e(base_url('/volunteer')) ?>" enctype="multipart/form-data" class="row g-3">
                        <?= csrf_field() ?>
                        <input type="hidden" name="form_type" value="volunteer">

                        <div class="col-md-6">
                            <label class="form-label">पूरा नाम *</label>
                            <input class="form-control" name="full_name" placeholder="आपका पूरा नाम" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">पिता का नाम</label>
                            <input class="form-control" name="father_name" placeholder="पिता का नाम">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ईमेल पता *</label>
                            <input class="form-control" type="email" name="email" placeholder="email@example.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">मोबाइल नंबर *</label>
                            <input class="form-control" type="tel" name="phone" placeholder="10 अंकों का मोबाइल नंबर" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">लिंग (Gender)</label>
                            <select class="form-select" name="gender">
                                <option value="Male">पुरुष (Male)</option>
                                <option value="Female">महिला (Female)</option>
                                <option value="Other">अन्य (Other)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">जन्मतिथि (Date of Birth)</label>
                            <input class="form-control" type="date" name="dob">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">राज्य (State) *</label>
                            <select class="form-select" name="state" id="stateSelect" required>
                                <option value="">राज्य चुनें</option>
                                <?php if (!empty($states)): ?>
                                    <?php foreach ($states as $s): ?>
                                        <option value="<?= $s['state_id'] ?>"><?= e($s['state_name']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">जिला (District) *</label>
                            <select class="form-select" name="district" id="districtSelect" required disabled>
                                <option value="">पहले राज्य चुनें</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">पिनकोड</label>
                            <input class="form-control" name="pincode" placeholder="6 अंकों का पिनकोड">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">व्यवसाय (Occupation)</label>
                            <input class="form-control" name="occupation" placeholder="छात्र / शिक्षक / व्यवसायी / अन्य">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">उपलब्धता (Availability)</label>
                            <select class="form-select" name="availability">
                                <option value="Flexible">लचीला समय (Flexible)</option>
                                <option value="Weekends">केवल सप्ताहांत (Weekends)</option>
                                <option value="Weekdays">कार्यदिवस (Weekdays)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">पासपोर्ट फोटो (ID Card हेतु)</label>
                            <input class="form-control" type="file" name="photo" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label">आपकी रुचि / कौशल (Skills & Interests)</label>
                            <input class="form-control" name="interests" placeholder="उदा. शिक्षण, फोटोग्राफी, सोशल मीडिया, फील्ड वर्क">
                        </div>
                        <div class="col-12">
                            <label class="form-label">संदेश / अतिरिक्त जानकारी</label>
                            <textarea class="form-control" name="message" rows="4" placeholder="आप हमारे साथ किस प्रकार योगदान देना चाहते हैं?"></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button class="btn btn-brand btn-lg w-100 py-3 shadow" type="submit">
                                <i class="fa-solid fa-paper-plane me-1"></i> स्वयंसेवक आवेदन जमा करें
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    const init = () => {
        const stateSelect = document.getElementById('stateSelect');
        const districtSelect = document.getElementById('districtSelect');
        if (!stateSelect || !districtSelect) return;

        stateSelect.addEventListener('change', function() {
            const stateId = this.value;
            districtSelect.innerHTML = '<option value="">जिला चुनें...</option>';
            
            if (stateId) {
                fetch(`<?= base_url('/api/cities') ?>?state_id=${stateId}`)
                    .then(response => response.json())
                    .then(res => {
                        if (res.status === 'success' && res.data.length > 0) {
                            districtSelect.disabled = false;
                            res.data.forEach(city => {
                                const opt = document.createElement('option');
                                opt.value = city.city_name;
                                opt.text = city.city_name;
                                districtSelect.add(opt);
                            });
                        } else {
                            districtSelect.disabled = true;
                        }
                    })
                    .catch(() => {
                        districtSelect.disabled = true;
                    });
            } else {
                districtSelect.disabled = true;
            }
        });
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>
