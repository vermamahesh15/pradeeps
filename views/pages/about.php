<?php
declare(strict_types=1);
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/')) ?>">होम</a></li>
                    <li class="breadcrumb-item active" aria-current="page">परिचय</li>
                </ol>
            </nav>
            <div class="d-block mb-2">
                <span class="banner-kicker"><i class="fa-solid fa-award me-1"></i> जीवन वृत्त एवं समाज सेवा</span>
            </div>
            <h1>प्रदीप सारंग – एक प्रेरणादायक व्यक्तित्व</h1>
            <p>समर्पित सामाजिक कार्यकर्ता, साहित्यकार, पर्यावरण संरक्षक एवं जनसेवक</p>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="leader-portrait-card">
                    <img class="w-100 rounded-4 shadow-lg border-4 border-white" src="<?= asset('images/pradeepsarang.png') ?>" alt="प्रदीप सारंग">
                    <div class="leader-badge-floating">
                        <i class="fa-solid fa-award text-warning fa-2x"></i>
                        <div>
                            <h6 class="mb-0 fw-bold">प्रतिष्ठित जनसेवक</h6>
                            <small class="text-muted">अनेक राज्य व राष्ट्रीय सम्मान</small>
                        </div>
                    </div>
                </div>

                <!-- Quick Profile Info Table -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mt-5 bg-light">
                    <h5 class="fw-bold mb-3 text-primary"><i class="fa-solid fa-id-card me-2 text-accent"></i> व्यक्तिगत विवरण</h5>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2 small">
                        <li><strong>पूरा नाम:</strong> प्रदीप सारंग</li>
                        <li><strong>पिता:</strong> श्री गोविंद प्रसाद</li>
                        <li><strong>माता:</strong> श्रीमती कृष्णावती (कृष्णादेवी)</li>
                        <li><strong>जन्मतिथि:</strong> 20 अक्टूबर 1969 (दीपावली की पावन भोर)</li>
                        <li><strong>शिक्षा:</strong> बी.ए., बी.एड., पीजी डिप्लोमा (अवधी), आयुर्वेद रत्न</li>
                        <li><strong>मूल निवास:</strong> ग्राम – कमरावाँ, पोस्ट – नानमऊ, जिला – बाराबंकी, उत्तर प्रदेश – 225121</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-7">
                <span class="section-kicker">विस्तृत परिचय</span>
                <h2 class="section-title">समाज के समग्र उत्थान के लिए समर्पित जीवन</h2>
                
                <p class="lead text-primary fw-semibold">
                    प्रदीप सारंग एक बहुआयामी व्यक्तित्व के धनी, समर्पित सामाजिक कार्यकर्ता, संवेदनशील साहित्यकार और जन-जागरूकता अभियानों के सक्रिय प्रेरक हैं।
                </p>
                <p>
                    ग्रामीण परिवेश से निकलकर उन्होंने अपने अनुभवों और संघर्षों को समाज के उत्थान का माध्यम बनाया। उनकी सोच हमेशा समाज के कमजोर, जरूरतमंद और वंचित वर्गों के उत्थान, शिक्षा के प्रसार और सांस्कृतिक संरक्षण पर केंद्रित रही है।
                </p>
                <p>
                    उन्होंने युवाओं को संगठित कर रचनात्मक सामाजिक गतिविधियों, सांस्कृतिक आयोजनों तथा जनहित अभियानों में अग्रणी भूमिका निभाई है। ग्रामीण विकास, मतदाता जागरूकता, रक्तदान, पर्यावरण संरक्षण तथा भाषा-संस्कृति के संवर्धन जैसे कार्यों में उनकी विशेष रुचि रही है।
                </p>

                <div class="row g-3 my-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 border shadow-sm h-100">
                            <h5 class="fw-bold text-accent"><i class="fa-solid fa-eye me-2"></i> दृष्टिकोण (Vision)</h5>
                            <p class="small text-muted mb-0">
                                एक ऐसे समाज का निर्माण जहाँ हर व्यक्ति शिक्षित, जागरूक और आत्मनिर्भर हो, जहाँ पर्यावरण सुरक्षित हो और सांस्कृतिक मूल्यों का सम्मान बना रहे।
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 border shadow-sm h-100">
                            <h5 class="fw-bold text-accent"><i class="fa-solid fa-bullseye me-2"></i> ध्येय (Mission)</h5>
                            <p class="small text-muted mb-0">
                                जनसेवा, स्वास्थ्य सहायता, पर्यावरण संरक्षण और अवधी एवं हिंदी साहित्य के प्रचार-प्रसार के माध्यम से समाज में सकारात्मक बदलाव लाना।
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <a href="<?= e(base_url('/campaigns')) ?>" class="btn btn-brand">
                        <i class="fa-solid fa-hand-holding-heart me-1"></i> सामाजिक अभियान देखें
                    </a>
                    <a href="<?= e(base_url('/blog')) ?>" class="btn btn-outline-brand">
                        <i class="fa-solid fa-book-open me-1"></i> साहित्य संकलन पढ़ें
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Areas of Service -->
<section class="section-pad section-tint border-top">
    <div class="container">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="section-kicker">सेवा क्षेत्र</span>
            <h2 class="section-title">प्रमुख सामाजिक कार्य एवं योगदान</h2>
            <p class="text-muted">समाज के विभिन्न पक्षों में निरंतर सकारात्मक बदलाव के लिए संचालित प्रमुख आयाम</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center">
                    <div class="stat-icon mx-auto"><i class="fa-solid fa-check-to-slot"></i></div>
                    <h4 class="h5 fw-bold mb-2">मतदाता जागरूकता अभियान</h4>
                    <p class="small text-muted mb-0">लोकतंत्र के सशक्तिकरण के लिए जन-जन तक मतदान के महत्व और संवैधानिक अधिकारों की जागरूकता का प्रसार।</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center">
                    <div class="stat-icon mx-auto"><i class="fa-solid fa-droplet"></i></div>
                    <h4 class="h5 fw-bold mb-2">रक्तदान एवं स्वास्थ्य सेवा</h4>
                    <p class="small text-muted mb-0">नियमित रक्तदान शिविरों का आयोजन, आपातकालीन रक्त सहायता और ग्रामीण स्वास्थ्य परामर्श शिविर।</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center">
                    <div class="stat-icon mx-auto"><i class="fa-solid fa-tree"></i></div>
                    <h4 class="h5 fw-bold mb-2">पर्यावरण एवं जल संरक्षण</h4>
                    <p class="small text-muted mb-0">हजारों वृक्षों का रोपण, पौध वितरण, जल संरक्षण अभियान और स्वच्छता जागरूकता गतिविधियां।</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center">
                    <div class="stat-icon mx-auto"><i class="fa-solid fa-feather-pointed"></i></div>
                    <h4 class="h5 fw-bold mb-2">अवधी भाषा एवं साहित्य</h4>
                    <p class="small text-muted mb-0">अवधी गद्य, कहानियों, निबंधों और कविताओं का सृजन तथा लोक भाषा व संस्कृति का संरक्षण।</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center">
                    <div class="stat-icon mx-auto"><i class="fa-solid fa-graduation-cap"></i></div>
                    <h4 class="h5 fw-bold mb-2">शिक्षा एवं युवा मार्गदर्शन</h4>
                    <p class="small text-muted mb-0">ग्रामीण बच्चों के लिए निःशुल्क शिक्षण सामग्री, पुस्तकालय प्रोत्साहन और युवाओं का कैरियर मार्गदर्शन।</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center">
                    <div class="stat-icon mx-auto"><i class="fa-solid fa-handshake"></i></div>
                    <h4 class="h5 fw-bold mb-2">सांस्कृतिक व सामाजिक चेतना</h4>
                    <p class="small text-muted mb-0">राष्ट्रीय पर्वों, सांस्कृतिक उत्सवों और सामाजिक सम्मेलनों के माध्यम से सामाजिक सद्भाव को बढ़ावा।</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline of Honors & Achievements -->
<?php if (!empty($timeline)): ?>
    <section class="section-pad">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="section-kicker">उपलब्धियां</span>
                <h2 class="section-title">सम्मान एवं उपलब्धियों की यात्रा</h2>
                <p class="text-muted">समाज सेवा और जनहित में उत्कृष्ट योगदान के लिए प्राप्त प्रमुख सम्मान एवं प्रशस्ति पत्र</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="timeline-v2">
                        <?php foreach ($timeline as $index => $item): ?>
                            <div class="timeline-block mb-4 p-4 bg-white rounded-4 border shadow-sm position-relative">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge-brand">
                                        <i class="fa-solid fa-calendar-check me-1"></i> <?= e($item['year'] ?? '') ?>
                                    </span>
                                    <h5 class="mb-0 fw-bold text-dark"><?= e($item['title'] ?? '') ?></h5>
                                </div>
                                <p class="small text-muted mb-0"><?= e($item['description'] ?? '') ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
