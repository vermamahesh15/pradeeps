<section class="page-banner volunteer-banner">
    <div class="container">
        <span class="section-kicker">Volunteer Registration</span>
        <h1>A modern registration page designed to feel inviting and trustworthy.</h1>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-5">
                <div class="volunteer-intro">
                    <h2 class="section-title">Bring your skills to real community work.</h2>
                    <p>Choose your areas of contribution, share your availability, and upload your resume for coordination.</p>
                    <ul class="list-unstyled volunteer-points">
                        <li>Education and mentoring opportunities</li>
                        <li>Health, events, and outreach support</li>
                        <li>City-based and remote contribution tracks</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="sidebar-panel volunteer-form-shell">
                    <form method="post" action="<?= e(base_url('/volunteer')) ?>" enctype="multipart/form-data" class="row g-3">
                        <?= csrf_field() ?>
                        <input type="hidden" name="form_type" value="volunteer">
                        <div class="col-md-6"><input class="form-control" name="full_name" placeholder="Full Name" required></div>
                        <div class="col-md-6"><input class="form-control" name="father_name" placeholder="Father's Name"></div>
                        <div class="col-md-6"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
                        <div class="col-md-6"><input class="form-control" name="phone" placeholder="Phone" required></div>
                        <div class="col-md-6">
                            <select class="form-select" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" type="date" name="dob" placeholder="Date of Birth">
                        </div>
                        <div class="col-md-6">
                            <select class="form-select" name="state" id="stateSelect" required>
                                <option value="">Select State</option>
                                <?php foreach ($states as $s): ?>
                                    <option value="<?= $s['state_id'] ?>"><?= e($s['state_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-select" name="district" id="districtSelect" required disabled>
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="col-md-6"><input class="form-control" name="pincode" placeholder="Pincode"></div>
                        <div class="col-md-6"><input class="form-control" name="occupation" placeholder="Occupation"></div>
                        <div class="col-md-6"><input class="form-control" name="skills" placeholder="Skills"></div>
                        <div class="col-md-6"><input class="form-control" name="interests" placeholder="Interests"></div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted mb-1">Profile Photo</label>
                            <input class="form-control" type="file" name="photo" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted mb-1">Resume (PDF/Doc)</label>
                            <input class="form-control" type="file" name="resume">
                        </div>
                        <div class="col-md-6">
                            <select class="form-select" name="availability">
                                <option value="Weekdays">Weekdays</option>
                                <option value="Weekends">Weekends</option>
                                <option value="Flexible">Flexible</option>
                            </select>
                        </div>
                        <div class="col-12"><textarea class="form-control" name="message" rows="5" placeholder="Tell us about yourself"></textarea></div>
                        <div class="col-12"><button class="btn btn-brand" type="submit"><?= e(lang('apply_now')) ?></button></div>
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
            districtSelect.innerHTML = '<option value="">Select District</option>';
            
            if (stateId) {
                fetch(`<?= base_url('/api/cities') ?>?state_id=${stateId}`)
                    .then(response => response.json())
                    .then(res => {
                        if (res.status === 'success' && res.data.length > 0) {
                            districtSelect.disabled = false;
                            res.data.forEach(city => {
                                const opt = document.createElement('option');
                                opt.value = city.city_name; // Or city.city_id depending on what you want to save
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
