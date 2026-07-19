<?php $data = require __DIR__ . '/../../includes/data.php'; ?>
<section class="page-banner">
    <div class="container">
        <span class="section-kicker">Contact</span>
        <h1>Open channels for partnerships, support, and inquiries.</h1>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="sidebar-panel">
                    <h2 class="section-title mb-4"><?= e(lang('get_in_touch')) ?></h2>
                    <form method="post" action="<?= e(base_url('/contact')) ?>" class="row g-3">
                        <?= csrf_field() ?>
                        <input type="hidden" name="form_type" value="contact">
                        <div class="col-md-6"><input class="form-control" name="name" placeholder="Full Name" required></div>
                        <div class="col-md-6"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
                        <div class="col-md-6"><input class="form-control" name="phone" placeholder="Phone"></div>
                        <div class="col-md-6"><input class="form-control" name="subject" placeholder="Subject"></div>
                        <div class="col-12"><textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea></div>
                        <div class="col-12"><button class="btn btn-brand" type="submit">Send Inquiry</button></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="sidebar-panel mb-4">
                    <h3>Contact Details</h3>
                    <p><?= e($data['settings']['address']) ?></p>
                    <p><?= e($data['settings']['phone']) ?></p>
                    <p><?= e($data['settings']['email']) ?></p>
                </div>
                <div class="map-placeholder">Google Map Placeholder</div>
            </div>
        </div>
    </div>
</section>
