<?php
declare(strict_types=1);
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/')) ?>">होम</a></li>
                    <li class="breadcrumb-item active" aria-current="page">संपर्क</li>
                </ol>
            </nav>
            <div class="d-block mb-2">
                <span class="banner-kicker"><i class="fa-solid fa-comments me-1"></i> हमसे जुड़ें</span>
            </div>
            <h1>संपर्क सूत्र एवं संवाद</h1>
            <p>किसी भी सामाजिक सहयोग, विचार विमर्श या जानकारी हेतु हमसे संपर्क करें।</p>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <!-- Left Info Cards -->
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white d-flex flex-row align-items-center gap-4">
                        <div class="stat-icon flex-shrink-0 mb-0"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1 text-primary">कार्यालय / निवास पता</h6>
                            <p class="small text-muted mb-0"><?= e($settings['address'] ?? 'ग्राम – कमरावाँ, पोस्ट – नानमऊ, जिला – बाराबंकी, उत्तर प्रदेश – 225121') ?></p>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white d-flex flex-row align-items-center gap-4">
                        <div class="stat-icon flex-shrink-0 mb-0"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1 text-primary">फोन संपर्क</h6>
                            <p class="small text-muted mb-0"><?= e($settings['phone'] ?? '+91 98765 43210') ?></p>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white d-flex flex-row align-items-center gap-4">
                        <div class="stat-icon flex-shrink-0 mb-0"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1 text-primary">ईमेल</h6>
                            <p class="small text-muted mb-0"><?= e($settings['email'] ?? 'hello@pradeepsarang.in') ?></p>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-light text-center">
                        <h6 class="fw-bold mb-2">सोशल मीडिया पर जुड़ें</h6>
                        <div class="d-flex justify-content-center gap-2 mt-2">
                            <a href="<?= e($settings['facebook'] ?? '#') ?>" class="btn btn-primary rounded-circle" style="width:40px;height:40px;display:inline-flex;align-items:center;justify-content:center;"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="<?= e($settings['instagram'] ?? '#') ?>" class="btn btn-danger rounded-circle" style="width:40px;height:40px;display:inline-flex;align-items:center;justify-content:center;"><i class="fa-brands fa-instagram"></i></a>
                            <a href="<?= e($settings['linkedin'] ?? '#') ?>" class="btn btn-info rounded-circle text-white" style="width:40px;height:40px;display:inline-flex;align-items:center;justify-content:center;"><i class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Message Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h3 class="fw-bold mb-2"><?= e(lang('get_in_touch')) ?></h3>
                    <p class="text-muted small mb-4">कृपया अपना संदेश नीचे दर्ज करें। हम शीघ्र ही आपसे संपर्क करेंगे।</p>

                    <form method="post" action="<?= e(base_url('/contact')) ?>" class="row g-3">
                        <?= csrf_field() ?>
                        <input type="hidden" name="form_type" value="contact">

                        <div class="col-md-6">
                            <label class="form-label">आपका पूरा नाम *</label>
                            <input class="form-control" name="name" placeholder="पूरा नाम दर्ज करें" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ईमेल पता *</label>
                            <input class="form-control" type="email" name="email" placeholder="email@example.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">मोबाइल नंबर</label>
                            <input class="form-control" type="tel" name="phone" placeholder="मोबाइल नंबर">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">विषय (Subject)</label>
                            <input class="form-control" name="subject" placeholder="संदेश का विषय">
                        </div>
                        <div class="col-12">
                            <label class="form-label">आपका संदेश / विचार *</label>
                            <textarea class="form-control" name="message" rows="5" placeholder="यहाँ अपना विस्तृत संदेश लिखें..." required></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button class="btn btn-brand btn-lg w-100 py-3 shadow" type="submit">
                                <i class="fa-solid fa-paper-plane me-1"></i> संदेश भेजें
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
