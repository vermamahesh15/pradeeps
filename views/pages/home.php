<?php $home = $page; ?>
<style>
    .gallery-card {
        display: block;
        position: relative;
        aspect-ratio: 1/1;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .gallery-card:hover {
        transform: scale(1.02);
    }
    .gallery-hover-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(13, 110, 253, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 0.5rem;
    }
    .gallery-card:hover .gallery-hover-overlay {
        opacity: 1;
    }
</style>
<main>
    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($home['sliders'] as $index => $slide): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="hero-slide" style="background-image:url('<?= e($slide['image']) ?>')">
                            <div class="container">
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section-pad">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <img class="rounded-4 w-100 shadow" src="assets/images/pradeepsarang.png" alt="प्रदीप सारंग">
                </div>
                <div class="col-lg-7">
                   
                    <h2 class="section-title">प्रदीप सारंग</h2>
                    <p class="lead mb-0">प्रदीप सारंग एक समर्पित सामाजिक कार्यकर्ता, साहित्यकार एवं जनसेवक हैं, जिन्होंने समाज के विभिन्न क्षेत्रों में निरंतर सक्रिय योगदान दिया है। उनका जीवन समाज सेवा, शिक्षा, पर्यावरण संरक्षण और जन-जागरूकता के कार्यों के लिए समर्पित रहा है।

उन्होंने युवाओं को संगठित कर सामाजिक गतिविधियों, सांस्कृतिक कार्यक्रमों तथा जनहित अभियानों में महत्वपूर्ण भूमिका निभाई है। ग्रामीण विकास, मतदाता जागरूकता, रक्तदान, पर्यावरण संरक्षण तथा भाषा-संस्कृति के संवर्धन जैसे कार्यों में उनकी विशेष रुचि रही है।

प्रदीप सारंग को उनके उत्कृष्ट सामाजिक योगदान के लिए समय-समय पर अनेक सम्मान-पत्र, प्रशस्ति-पत्र और पुरस्कारों से सम्मानित किया गया है। उनकी कार्यशैली में समाज के प्रति समर्पण, नेतृत्व क्षमता और जनसेवा की सच्ची भावना स्पष्ट रूप से दिखाई देती है।

वे न केवल एक सामाजिक कार्यकर्ता हैं, बल्कि एक प्रेरणास्रोत व्यक्तित्व भी हैं, जो अपने कार्यों के माध्यम से समाज में सकारात्मक परिवर्तन लाने का प्रयास कर रहे हैं।</p>
                </div>
            </div>
            <div class="row g-4 mt-4">
               
            </div>
        </div>
    </section>

    <section class="section-pad section-tint">
        <div class="container">
            <div class="section-head d-flex flex-wrap justify-content-between align-items-end gap-3">
                <div>
                    <span class="section-kicker">प्रमुख अभियान</span>
                    <p  class="lead mb-0">प्रदीप सारंग द्वारा समाज के समग्र विकास के लिए विभिन्न जन-जागरूकता एवं सेवा-आधारित अभियानों का संचालन किया जा रहा है। ये अभियान समाज में सकारात्मक बदलाव लाने और लोगों को जागरूक करने के उद्देश्य से निरंतर सक्रिय हैं।</p>
                </div>
                <a href="<?= e(base_url('/campaigns')) ?>" class="text-link">View all campaigns</a>
            </div>
            <div class="row g-4 mt-1 flex-nowrap overflow-auto pb-4">
                <?php foreach ($home['campaigns'] as $cause): ?>
                    <?php 
                    $goal = (float)$cause['goal_amount'];
                    $progress = $goal > 0 ? (int) round(((float)$cause['raised_amount'] / $goal) * 100) : 0; 
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-11 flex-shrink-0">
                        <article class="cause-card">
                            <img loading="lazy" src="<?= e($cause['image']) ?>" alt="<?= e($cause['title']) ?>">
                            <div class="cause-body">
                                <h3><?= e($cause['title']) ?></h3>
                                <p><?= e($cause['excerpt']) ?></p>
                                <div class="progress mb-3"><div class="progress-bar" style="width: <?= $progress ?>%"></div></div>
                                
                                <a href="<?= e(base_url('/campaigns/' . $cause['slug'])) ?>" class="btn btn-dark mt-3">Details</a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section-pad">
        <div class="container">
            <div class="row g-4">
                <div class="col-12">
                    <span class="section-kicker">Events</span>
                    <h2 class="section-title mb-4">Latest events, outreach drives, and community gatherings.</h2>
                    <div class="row g-4 mt-2 flex-nowrap overflow-auto pb-4">
                        <?php foreach ($home['events'] as $event): ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-11 flex-shrink-0">
                                <article class="event-card">
                                    <img loading="lazy" src="<?= e(strpos($event['image'] ?? '', 'http') === 0 ? $event['image'] : base_url($event['image'] ?? '')) ?>" alt="<?= e($event['title'] ?? '') ?>">
                                    <div class="event-content">
                                        <span class="badge-soft"><?= e(ucfirst($event['status'] ?? '')) ?></span>
                                        <h3><?= e($event['title'] ?? '') ?></h3>
                                        <p><?= e($event['excerpt']) ?></p>
                                        <div class="small text-muted"><?= e(format_date($event['event_date'] ?? $event['date'] ?? '')) ?> · <?= e($event['location'] ?? '') ?></div>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad section-tint">
        <div class="container">
            <div class="section-head text-center mb-5">
                <span class="section-kicker">Gallery</span>
                <h2 class="section-title">Impact in Pictures</h2>
            </div>
            <div class="row g-3">
                <?php foreach (array_slice($home['gallery'], 0, 20) as $item): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="<?= e(base_url($item['image'])) ?>" class="gallery-card lightbox-link">
                            <img loading="lazy" src="<?= e(base_url($item['image'])) ?>" class="w-100 h-100 object-fit-cover rounded-3 shadow-sm" alt="<?= e($item['title'] ?? '') ?>">
                            <div class="gallery-hover-overlay">
                                <i class="fa-solid fa-expand text-white fs-3"></i>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section-pad">
        <div class="container">
            <div class="section-head text-center mb-5">
                <span class="section-kicker">Media Coverage</span>
                <h2 class="section-title">Newspaper Cuttings</h2>
            </div>
            <div class="row g-3">
                <?php foreach ($home['newspaper_cuttings'] as $item): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="<?= e(base_url($item['image'])) ?>" class="gallery-card lightbox-link">
                            <img loading="lazy" src="<?= e(base_url($item['image'])) ?>" class="w-100 h-100 object-fit-cover rounded-3 shadow-sm" alt="<?= e($item['title'] ?? '') ?>">
                            <div class="gallery-hover-overlay">
                                <i class="fa-solid fa-expand text-white fs-3"></i>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

   

    <section class="section-pad section-tint">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-12">
                    <span class="section-kicker">Latest Blogs</span>
                    <h2 class="section-title">News, reflections, and field updates.</h2>
                    <div class="row g-4 mt-2">
                        <?php foreach ($home['blogs'] as $post): ?>
                            <div class="col-md-4">
                                <article class="blog-card">
                                    <!-- <?php 
                                        $blogImg = $post['banner_image'] ?? $post['image'] ?? '';
                                        $blogImgSrc = (strpos($blogImg, 'http') === 0) ? $blogImg : base_url($blogImg);
                                    ?>
                                    <img loading="lazy" src="<?= e($blogImgSrc) ?>" alt="<?= e($post['title']) ?>"> -->
                                    <div class="blog-body">
                                        <span class="badge-soft"><?= e($post['category_name'] ?? $post['category'] ?? 'Uncategorized') ?></span>
                                        <h3><?= e($post['title']) ?></h3>
                                        <p><?= e($post['excerpt']) ?></p>
                                        <a href="<?= e(base_url('/blog/' . $post['slug'])) ?>" class="text-link">Read article</a>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- <div class="col-lg-5">
                    <div class="cta-panel">
                        <span class="section-kicker">Newsletter</span>
                        <h2 class="section-title">Stay updated with upcoming campaigns and stories.</h2>
                        <p>Receive concise updates, upcoming events, and volunteer opportunities straight to your inbox.</p>
                        <form method="post" action="<?= e(base_url('/')) ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="form_type" value="newsletter">
                            <div class="input-group">
                                <input type="email" class="form-control" name="email" placeholder="Email address" required>
                                <button class="btn btn-brand" type="submit">Join</button>
                            </div>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
</main>
