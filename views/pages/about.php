<?php $data = require __DIR__ . '/../../includes/data.php'; ?>
<style>
    /* Timeline Component Styling */
    .timeline-section {
        position: relative;
        padding: 60px 0;
        overflow: hidden;
    }

    .timeline-container {
        position: relative;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* The Vertical Line */
    .timeline-container::after {
        content: '';
        position: absolute;
        width: 3px;
        background-color: #dee2e6;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -1.5px;
    }

    .timeline-item {
        padding: 10px 40px;
        position: relative;
        background-color: inherit;
        width: 50%;
        box-sizing: border-box;
        /* Initial state is hidden */
        opacity: 0;
    }

    /* Fallback: Standard animation for older browsers (Firefox/Older Safari) */
    @supports not (animation-timeline: view()) {
        .timeline-item {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        /* Staggered entrance for fallback only */
        .timeline-item:nth-child(2) { animation-delay: 0.2s; }
        .timeline-item:nth-child(3) { animation-delay: 0.4s; }
    }

    /* The Dots */
    .timeline-dot {
        position: absolute;
        width: 20px;
        height: 20px;
        right: -10px;
        background-color: #fff;
        border: 4px solid #0d6efd;
        top: 25px;
        border-radius: 50%;
        z-index: 1;
        transition: transform 0.3s ease, border-color 0.3s ease;
    }

    .timeline-item:hover .timeline-dot {
        transform: scale(1.3);
        border-color: #0056b3;
    }

    .timeline-item.right {
        left: 50%;
    }

    .timeline-item.right .timeline-dot {
        left: -10px;
    }

    .timeline-content {
        padding: 25px;
        background-color: white;
        position: relative;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .timeline-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .timeline-year {
        display: inline-block;
        padding: 2px 12px;
        background: #e7f1ff;
        color: #0d6efd;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    /* Mobile Responsive (max-width: 768px) */
    @media screen and (max-width: 768px) {
        .timeline-container::after {
            left: 31px;
        }

        .timeline-item {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
        }

        .timeline-item.left,
        .timeline-item.right {
            left: 0;
        }

        .timeline-dot {
            left: 21px !important;
            right: auto;
        }

        .timeline-item.left .timeline-dot {
            right: auto;
        }
    }

    /* Animation Keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Modern Scroll Reveal (Chrome/Edge/Safari 17+) */
    @supports (animation-timeline: view()) {
        .timeline-item {
            animation: fadeInUp linear both;
            animation-timeline: view();
            /* Range: Start animating when entering, finish when fully inside */
            animation-range: entry 0% entry 100%;
        }
    }
</style>
<section class="page-banner">
    <div class="container">
        <span class="section-kicker">प्रदीप सारंग </span>
        <h1>प्रदीप सारंग – एक प्रेरणादायक सामाजिक व्यक्तित्व</h1>
        
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <img class="rounded-4 w-100" src="https://picsum.photos/seed/about-main/1000/800" alt="About">
            </div>
            <div class="col-lg-6">
                
                
                <div class="section info">
        <h2>व्यक्तिगत जानकारी</h2>
        <p><strong>नाम:</strong> प्रदीप सारंग</p>
        <p><strong>पिता:</strong> गोविंद प्रसाद</p>
        <p><strong>माता:</strong> कृष्णावती (कृष्णादेवी)</p>
        <p><strong>जन्मतिथि:</strong> 20 अक्टूबर 1969 (दीपावली की पावन भोर)</p>
        <p><strong>शिक्षा:</strong> बी.ए., बी.एड., पीजी डिप्लोमा (अवधी), आयुर्वेद रत्न</p>
        <p><strong>पता:</strong> ग्राम – कमरावाँ, पोस्ट – नानमऊ, जिला – बाराबंकी, उत्तर प्रदेश – 225121</p>
    </div>
    <div class="section">
        <h2>विस्तृत परिचय</h2>
        <p>
            प्रदीप सारंग एक बहुआयामी व्यक्तित्व के धनी, समर्पित सामाजिक कार्यकर्ता, संवेदनशील साहित्यकार और जन-जागरूकता अभियानों के सक्रिय प्रेरक हैं।
            उन्होंने अपने जीवन को समाज सेवा, शिक्षा के प्रसार, पर्यावरण संरक्षण और सांस्कृतिक उन्नयन के लिए समर्पित किया है।
        </p>
        <p>
            ग्रामीण परिवेश से निकलकर उन्होंने अपने अनुभवों और संघर्षों को समाज के उत्थान का माध्यम बनाया। उनकी सोच हमेशा समाज के कमजोर, जरूरतमंद और वंचित वर्गों के उत्थान पर केंद्रित रही है।
        </p>
    </div>
</div>

    <div class="section">
        <h2>सामाजिक कार्य एवं योगदान</h2>
        <ul>
            <li><strong>मतदाता जागरूकता अभियान:</strong> लोकतंत्र के प्रति जागरूकता और मतदान के महत्व का प्रचार।</li>
            <li><strong>रक्तदान एवं स्वास्थ्य जागरूकता:</strong> रक्तदान शिविरों का आयोजन और स्वास्थ्य जागरूकता।</li>
            <li><strong>पर्यावरण संरक्षण:</strong> वृक्षारोपण, स्वच्छता और जल संरक्षण अभियान।</li>
            <li><strong>भाषा एवं साहित्य संवर्धन:</strong> अवधी भाषा और साहित्य को बढ़ावा देना।</li>
            <li><strong>युवा प्रेरणा एवं सांस्कृतिक कार्यक्रम:</strong> युवाओं को सकारात्मक दिशा में प्रेरित करना।</li>
        </ul>
    </div>

    <div class="section">
        <h2>सम्मान एवं उपलब्धियाँ</h2>
        <p>
            समाज सेवा और जनहित के क्षेत्र में उत्कृष्ट योगदान के लिए प्रदीप सारंग को अनेक सम्मान-पत्र, प्रशस्ति-पत्र एवं पुरस्कारों से सम्मानित किया गया है।
        </p>
    </div>

   
                <div class="row g-3 mt-2">
                    <div class="col-sm-6"><div class="mini-card"><h3>दृष्टिकोण (Vision)</h3><p>
                एक ऐसे समाज का निर्माण करना जहाँ हर व्यक्ति शिक्षित, जागरूक और आत्मनिर्भर हो,
                जहाँ पर्यावरण सुरक्षित हो और सांस्कृतिक मूल्यों का सम्मान बना रहे।
            </p></div></div>
                    <div class="col-sm-6"><div class="mini-card"><h3><h2>प्रेरणा स्रोत</h2></h3> <p>
            प्रदीप सारंग आज एक प्रेरणास्रोत व्यक्तित्व के रूप में स्थापित हैं, जो अपने कार्यों के माध्यम से समाज में सकारात्मक परिवर्तन लाने के लिए निरंतर प्रयासरत हैं।
        </p></div></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-pad section-tint">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <span class="section-kicker">Founder Message</span>
                <h2 class="section-title">“Change becomes durable when people can see themselves inside it.”</h2>
            </div>
            <div class="col-lg-8">
                <div class="mini-card h-100">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum gravida luctus lacus, vitae faucibus mauris gravida non. Pellentesque quis nisl ultricies, dignissim lorem in, cursus mauris.</p>
                    <strong>Aarav Singh, Founder</strong>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-3">
            <?php foreach ($data['team'] as $member): ?>
                <div class="col-md-4">
                    <div class="team-card">
                        <img src="<?= e($member['image']) ?>" alt="<?= e($member['name']) ?>">
                        <h3><?= e($member['name']) ?></h3>
                        <p><?= e($member['role']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($timeline)): ?>
            <div class="timeline-section mt-5">
                <h2 class="section-title text-center mb-5">सम्मान एवं उपलब्धियाँ</h2>
                
        <p>
            समाज सेवा और जनहित के क्षेत्र में उत्कृष्ट योगदान के लिए प्रदीप सारंग को अनेक सम्मान-पत्र, प्रशस्ति-पत्र एवं पुरस्कारों से सम्मानित किया गया है।
        </p>
                <div class="timeline-container">
                    <?php foreach ($timeline as $index => $event): ?>
                        <div class="timeline-item <?= $index % 2 === 0 ? 'left' : 'right' ?>">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <span class="timeline-year"><?= e($event['year']) ?></span>
                                <h3 class="h5 fw-bold"><?= e($event['title']) ?></h3>
                                <p class="mb-0 text-muted small"><?= e($event['description'] ?? '') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- <section class="section-pad">
    <div class="container">
        <span class="section-kicker">Why Choose Us</span>
        <h2 class="section-title">Clear reporting, local trust, and programs designed to last.</h2>
        <div class="row g-4 mt-2">
            <div class="col-md-4"><div class="feature-card"><i class="fa-solid fa-shield-heart"></i><h3>Trustworthy</h3><p>Transparent communication and structured program documentation.</p></div></div>
            <div class="col-md-4"><div class="feature-card"><i class="fa-solid fa-chart-line"></i><h3>Measurable</h3><p>Outcomes, stories, and progress all presented with clarity.</p></div></div>
            <div class="col-md-4"><div class="feature-card"><i class="fa-solid fa-earth-asia"></i><h3>Local-first</h3><p>Solutions are grounded in the context of each community.</p></div></div>
        </div>
    </div>
</section> -->
