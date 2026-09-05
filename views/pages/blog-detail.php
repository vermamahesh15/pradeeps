<?php
declare(strict_types=1);

$content = $post['content'] ?? '';
$title = $post['title'] ?? '';
$author = $post['author'] ?? 'प्रदीप सारंग';
$category = $post['category_name'] ?? $post['category'] ?? 'साहित्य';
$pubDate = format_date($post['published_at'] ?? $post['date'] ?? $post['created_at'] ?? '');

// Calculate approximate reading time
$wordCount = mb_strlen(strip_tags($content)) / 5;
$readMinutes = max(1, (int)ceil($wordCount / 180));
?>

<!-- Reading Progress Bar -->
<div id="readingProgress" class="reading-progress-bar"></div>

<div class="book-reading-environment">
    <!-- Reader Controls Bar -->
    <div class="container py-3">
        <div class="reader-toolbar d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <a href="<?= e(base_url('/blog')) ?>" class="book-back-btn">
                    <i class="fa-solid fa-arrow-left me-2"></i> सभी रचनाएं
                </a>
                <span class="toolbar-divider d-none d-sm-inline">|</span>
                <span class="reading-time-badge d-none d-sm-inline">
                    <i class="fa-regular fa-clock me-1"></i> लगभग <?= $readMinutes ?> मिनट का पाठ
                </span>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- Theme Switcher -->
                <div class="theme-selector d-flex align-items-center gap-1" title="पठन थीम">
                    <button class="theme-btn active" data-theme="parchment" title="चर्मपत्र (Parchment)">
                        <span class="theme-dot parchment"></span>
                    </button>
                    <button class="theme-btn" data-theme="sepia" title="क्लासिक सेपिया (Sepia)">
                        <span class="theme-dot sepia"></span>
                    </button>
                    <button class="theme-btn" data-theme="ivory" title="सफेद पन्ना (Ivory)">
                        <span class="theme-dot ivory"></span>
                    </button>
                    <button class="theme-btn" data-theme="dark" title="रात्रि पठन (Dark Book)">
                        <span class="theme-dot dark"></span>
                    </button>
                </div>

                <!-- Font Size Adjuster -->
                <div class="font-size-controls d-flex align-items-center">
                    <button type="button" id="fontDec" class="font-ctrl-btn" title="अक्षर छोटे करें">A-</button>
                    <button type="button" id="fontReset" class="font-ctrl-btn" title="सामान्य आकार">A</button>
                    <button type="button" id="fontInc" class="font-ctrl-btn" title="अक्षर बड़े करें">A+</button>
                </div>

                <!-- Print Button -->
                <button type="button" onclick="window.print()" class="book-tool-btn" title="प्रिंट / सुरक्षित करें">
                    <i class="fa-solid fa-print"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Book Page Area -->
    <div class="container pb-5">
        <div class="row g-4 justify-content-center">
            <!-- The Book Folio / Page -->
            <div class="col-lg-9">
                <article class="book-page" id="bookPage">
                    <!-- Ribbon Bookmark -->
                    <div class="book-ribbon">
                        <span class="ribbon-tail"></span>
                    </div>

                    <!-- Inner Decorative Border -->
                    <div class="book-border-frame">
                        <!-- Corner Ornaments -->
                        <span class="corner-ornament top-left">❦</span>
                        <span class="corner-ornament top-right">❦</span>
                        <span class="corner-ornament bottom-left">❦</span>
                        <span class="corner-ornament bottom-right">❦</span>

                        <!-- Book Header / Running Head -->
                        <header class="book-header text-center">
                            <div class="book-header-line d-flex align-items-center justify-content-between">
                                <span class="book-imprint">✦ साहित्य संकलन ✦</span>
                                <span class="book-category-seal"><?= e($category) ?></span>
                                <span class="book-imprint">✦ <?= e($author) ?> ✦</span>
                            </div>
                            <div class="vintage-flourish">
                                <svg viewBox="0 0 400 24" class="flourish-svg">
                                    <path d="M0,12 Q100,0 200,12 T400,12" stroke="currentColor" fill="none" stroke-width="1.2" opacity="0.4"/>
                                    <circle cx="200" cy="12" r="4" fill="currentColor"/>
                                    <path d="M190,12 L200,6 L210,12 L200,18 Z" fill="currentColor"/>
                                </svg>
                            </div>
                        </header>

                        <!-- Title & Meta Header -->
                        <div class="book-title-block text-center my-4">
                            <h1 class="book-main-title"><?= e($title) ?></h1>
                            <div class="book-meta-strip">
                                <span class="meta-item"><i class="fa-solid fa-pen-nib me-1"></i> <strong><?= e($author) ?></strong></span>
                                <span class="meta-dot">·</span>
                                <span class="meta-item"><i class="fa-regular fa-calendar me-1"></i> <?= e($pubDate) ?></span>
                            </div>
                            <div class="chapter-ornament">❖ ❖ ❖</div>
                        </div>

                        <!-- Story Content with Book Layout -->
                        <div class="book-body-content" id="bookContent">
                            <?= $content ?>
                        </div>

                        <!-- Story Finis / End Ornament -->
                        <div class="book-end-flourish text-center my-5">
                            <div class="finis-text">— ❦ समाप्त ❦ —</div>
                            <svg viewBox="0 0 300 20" class="flourish-svg-sm mt-2">
                                <path d="M50,10 Q150,0 250,10" stroke="currentColor" fill="none" stroke-width="1" opacity="0.5"/>
                                <circle cx="150" cy="10" r="3" fill="currentColor"/>
                            </svg>
                        </div>

                        <!-- Book Footer / Page Number -->
                        <footer class="book-footer d-flex align-items-center justify-content-between pt-4 border-top">
                            <div class="book-copyright-note small">
                                © <?= e(app_config('name')) ?>
                            </div>
                            <div class="book-page-number">
                                ~ १ ~
                            </div>
                            <div class="book-share-options d-flex align-items-center gap-2">
                                <span class="small text-muted me-1">साझा करें:</span>
                                <a href="https://api.whatsapp.com/send?text=<?= urlencode($title . ' ' . base_url('/blog/' . ($post['slug'] ?? ''))) ?>" target="_blank" class="book-share-icon whatsapp" title="WhatsApp पर भेजें">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(base_url('/blog/' . ($post['slug'] ?? ''))) ?>" target="_blank" class="book-share-icon facebook" title="Facebook पर साझा करें">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text=<?= urlencode($title) ?>&url=<?= urlencode(base_url('/blog/' . ($post['slug'] ?? ''))) ?>" target="_blank" class="book-share-icon twitter" title="X (Twitter) पर साझा करें">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </div>
                        </footer>
                    </div>
                </article>

                <!-- Comments in Vintage Guestbook Style -->
                <div class="book-guestbook mt-5">
                    <div class="guestbook-header">
                        <h3><i class="fa-solid fa-feather-pointed me-2"></i> पाठक प्रतिक्रियाएं (Comments)</h3>
                        <p class="text-muted small">रचना पर अपने विचार एवं समीक्षा दर्ज करें</p>
                    </div>
                    <form class="guestbook-form row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label small">आपका नाम *</label>
                            <input class="form-control book-input" placeholder="नाम लिखें" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">ईमेल पता *</label>
                            <input class="form-control book-input" type="email" placeholder="email@example.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small">आपकी टिप्पणी / प्रतिक्रिया *</label>
                            <textarea class="form-control book-input" rows="4" placeholder="यहाँ अपनी प्रतिक्रिया लिखें..." required></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn book-submit-btn" type="button">
                                <i class="fa-solid fa-paper-plane me-1"></i> प्रतिक्रिया भेजें
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Author & Other Chapters Sidebar -->
            <div class="col-lg-3">
                <aside class="book-sidebar sticky-top" style="top: 100px; z-index: 10;">
                    <!-- Author Card -->
                    <div class="book-sidebar-card author-colophon-card text-center mb-4">
                        <div class="colophon-seal mb-2">
                            <i class="fa-solid fa-feather"></i>
                        </div>
                        <h4 class="author-name"><?= e($author) ?></h4>
                        <p class="author-sub small text-muted">लेखक एवं साहित्यकार</p>
                        <p class="author-bio small">
                            अवधी एवं हिंदी साहित्य के संवाहक, समाज एवं संस्कृति के विविध रंगों को अपनी लेखनी से प्रस्तुत करते हैं।
                        </p>
                        <hr class="colophon-divider">
                        <a href="<?= e(base_url('/about')) ?>" class="btn btn-sm book-outline-btn w-100">
                            लेखक परिचय पढ़ें
                        </a>
                    </div>

                    <!-- Related Stories / Other Chapters -->
                    <div class="book-sidebar-card chapters-card">
                        <h4 class="sidebar-title d-flex align-items-center gap-2">
                            <i class="fa-solid fa-book-open"></i> अन्य रचनाएं
                        </h4>
                        <div class="chapter-list mt-3">
                            <?php if (!empty($related)): ?>
                                <?php foreach ($related as $idx => $item): ?>
                                    <a href="<?= e(base_url('/blog/' . $item['slug'])) ?>" class="chapter-item">
                                        <div class="chapter-num"><?= sprintf('%02d', $idx + 1) ?></div>
                                        <div class="chapter-info">
                                            <div class="chapter-title"><?= e($item['title']) ?></div>
                                            <div class="chapter-date small text-muted"><?= e(format_date($item['published_at'] ?? $item['date'] ?? $item['created_at'] ?? '')) ?></div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="small text-muted">कोई अन्य रचना उपलब्ध नहीं है।</p>
                            <?php endif; ?>
                        </div>
                        <div class="mt-3 pt-3 border-top text-center">
                            <a href="<?= e(base_url('/blog')) ?>" class="small text-decoration-none fw-bold book-link">
                                सभी संकलन देखें <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

<style>
/* ==========================================================
   LITERARY BOOK PAGE STYLES
   ========================================================== */

/* Reading progress bar */
.reading-progress-bar {
    position: fixed;
    top: 0;
    left: 0;
    height: 4px;
    background: linear-gradient(90deg, #b8561f, #d96f32, #f5a623);
    width: 0%;
    z-index: 9999;
    transition: width 0.1s ease-out;
}

/* Environment background */
.book-reading-environment {
    background: #eee8dc;
    background-image: 
        radial-gradient(#d6cbba 1px, transparent 1px),
        radial-gradient(#d6cbba 1px, #eee8dc 1px);
    background-size: 40px 40px;
    background-position: 0 0, 20px 20px;
    min-height: 100vh;
    padding-top: 1.5rem;
    transition: background 0.3s ease;
}

/* Reader Toolbar */
.reader-toolbar {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(8px);
    border: 1px solid #d4c8b6;
    border-radius: 50px;
    padding: 0.5rem 1.25rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.book-back-btn {
    color: #4a3b32;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: color 0.2s ease;
}
.book-back-btn:hover {
    color: #b8561f;
}

.toolbar-divider {
    color: #c4b8a5;
}

.reading-time-badge {
    font-size: 0.82rem;
    color: #6b5c52;
    background: #f0e6d6;
    padding: 3px 10px;
    border-radius: 20px;
}

/* Theme selector */
.theme-btn {
    background: none;
    border: 2px solid transparent;
    border-radius: 50%;
    padding: 3px;
    cursor: pointer;
    display: inline-flex;
    transition: all 0.2s ease;
}
.theme-btn.active, .theme-btn:hover {
    border-color: #b8561f;
    transform: scale(1.1);
}
.theme-dot {
    display: block;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    border: 1px solid rgba(0,0,0,0.15);
}
.theme-dot.parchment { background: #faf6ee; }
.theme-dot.sepia { background: #f4ecd8; }
.theme-dot.ivory { background: #ffffff; }
.theme-dot.dark { background: #1f2421; }

/* Font size controls */
.font-size-controls {
    border: 1px solid #d4c8b6;
    border-radius: 20px;
    overflow: hidden;
    background: #faf6ee;
}
.font-ctrl-btn {
    background: none;
    border: none;
    padding: 3px 10px;
    font-size: 0.82rem;
    font-weight: 700;
    color: #4a3b32;
    cursor: pointer;
    transition: background 0.2s;
}
.font-ctrl-btn:hover {
    background: #e2d7c5;
}

.book-tool-btn {
    background: #faf6ee;
    border: 1px solid #d4c8b6;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #4a3b32;
    cursor: pointer;
    transition: all 0.2s;
}
.book-tool-btn:hover {
    background: #b8561f;
    color: #fff;
    border-color: #b8561f;
}

/* THE BOOK PAGE (FOLIO) */
.book-page {
    position: relative;
    background: #faf6ee;
    border-radius: 4px;
    padding: 3.5rem 3.5rem 3rem 3.5rem;
    box-shadow: 
        0 1px 3px rgba(0, 0, 0, 0.08),
        0 15px 35px rgba(60, 40, 20, 0.12),
        -15px 0 30px rgba(0, 0, 0, 0.03) inset;
    border: 1px solid #e3d7c3;
    transition: all 0.3s ease;
    overflow: visible;
}

/* Spine shadow effect on the left margin to mimic a bound book */
.book-page::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 25px;
    background: linear-gradient(to right, rgba(80, 50, 20, 0.12) 0%, rgba(80, 50, 20, 0.03) 60%, transparent 100%);
    pointer-events: none;
    border-radius: 4px 0 0 4px;
}

/* Ribbon Bookmark */
.book-ribbon {
    position: absolute;
    top: -12px;
    right: 45px;
    width: 28px;
    height: 65px;
    background: linear-gradient(135deg, #a82a1d 0%, #c93b2c 100%);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
    z-index: 5;
    border-radius: 2px 2px 0 0;
}
.book-ribbon::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 0;
    border-left: 14px solid transparent;
    border-right: 14px solid transparent;
    border-bottom: 12px solid #faf6ee;
    transition: border-bottom-color 0.3s;
}

/* Inner Ornamental Frame */
.book-border-frame {
    border: 1px solid #c9b89d;
    outline: 2px solid #e8decb;
    outline-offset: 4px;
    padding: 2.5rem 2.5rem 2rem 2.5rem;
    position: relative;
    border-radius: 2px;
}

/* Corner Ornaments */
.corner-ornament {
    position: absolute;
    font-size: 1.4rem;
    color: #9c6841;
    line-height: 1;
    user-select: none;
    opacity: 0.85;
}
.corner-ornament.top-left { top: 6px; left: 8px; }
.corner-ornament.top-right { top: 6px; right: 8px; transform: scaleX(-1); }
.corner-ornament.bottom-left { bottom: 6px; left: 8px; transform: scaleY(-1); }
.corner-ornament.bottom-right { bottom: 6px; right: 8px; transform: scale(-1, -1); }

/* Book Header */
.book-header {
    padding-bottom: 0.75rem;
    margin-bottom: 1.5rem;
}
.book-header-line {
    font-family: 'Cinzel', 'Noto Serif Devanagari', serif;
    font-size: 0.85rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #7a6352;
}
.book-imprint {
    font-weight: 600;
}
.book-category-seal {
    background: #e8dbca;
    color: #633e21;
    font-weight: 700;
    padding: 2px 12px;
    border-radius: 12px;
    font-size: 0.75rem;
    letter-spacing: 1px;
}
.vintage-flourish {
    height: 20px;
    margin-top: 6px;
    color: #9c6841;
}
.flourish-svg {
    width: 100%;
    max-width: 320px;
    height: 18px;
}
.flourish-svg-sm {
    width: 180px;
    height: 14px;
    color: #9c6841;
}

/* Book Title Block */
.book-main-title {
    font-family: 'Noto Serif Devanagari', 'Martel', 'Playfair Display', serif;
    font-size: 2.6rem;
    font-weight: 700;
    color: #2b1f1d;
    line-height: 1.3;
    margin-bottom: 0.75rem;
    letter-spacing: -0.5px;
}

.book-meta-strip {
    font-family: 'Noto Serif Devanagari', 'Martel', serif;
    font-size: 0.95rem;
    color: #735d4f;
    margin-bottom: 0.75rem;
}
.meta-dot {
    margin: 0 8px;
    color: #b8561f;
}
.chapter-ornament {
    font-size: 0.9rem;
    letter-spacing: 8px;
    color: #b8561f;
    opacity: 0.8;
}

/* Book Body Content Typography */
.book-body-content {
    font-family: 'Noto Serif Devanagari', 'Martel', 'Playfair Display', Georgia, serif;
    font-size: 1.22rem;
    line-height: 2.2;
    color: #2d2420;
    text-align: justify;
    text-justify: inter-word;
    word-spacing: 1px;
}

.book-body-content p {
    margin-bottom: 1.6rem;
    text-indent: 1.75rem;
}

/* Drop cap for first paragraph */
.book-body-content > p:first-of-type::first-letter,
.book-body-content > p:nth-child(1)::first-letter {
    font-family: 'Noto Serif Devanagari', 'Fraunces', 'Cinzel', serif;
    float: left;
    font-size: 3.8rem;
    line-height: 0.85;
    margin-right: 0.75rem;
    margin-top: 0.2rem;
    margin-bottom: -0.2rem;
    font-weight: 700;
    color: #99281a;
    text-shadow: 1px 1px 0px rgba(0,0,0,0.1);
}

.book-body-content blockquote {
    margin: 2rem 2.5rem;
    padding: 1rem 1.5rem;
    border-left: 3px double #99281a;
    background: rgba(184, 86, 31, 0.05);
    font-style: italic;
    color: #4a342b;
    border-radius: 0 8px 8px 0;
}

.book-body-content img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border: 4px solid #fff;
    margin: 1.5rem auto;
    display: block;
}

/* Finis / End Text */
.finis-text {
    font-family: 'Cinzel', 'Noto Serif Devanagari', serif;
    font-size: 1.1rem;
    letter-spacing: 4px;
    color: #8c3b20;
    font-weight: 600;
}

/* Book Footer */
.book-footer {
    border-top-color: #d9ccb6 !important;
    font-family: 'Noto Serif Devanagari', 'Cinzel', serif;
}
.book-page-number {
    font-size: 1.1rem;
    font-weight: 700;
    color: #735d4f;
    letter-spacing: 3px;
}
.book-share-icon {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-decoration: none;
    font-size: 0.75rem;
    transition: transform 0.2s ease;
}
.book-share-icon:hover {
    transform: scale(1.15);
    color: #fff;
}
.book-share-icon.whatsapp { background: #25d366; }
.book-share-icon.facebook { background: #1877f2; }
.book-share-icon.twitter { background: #000000; }

/* Guestbook Comments */
.book-guestbook {
    background: #faf6ee;
    border: 1px solid #dcd0bc;
    border-radius: 4px;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.guestbook-header h3 {
    font-family: 'Noto Serif Devanagari', 'Martel', serif;
    color: #2b1f1d;
    font-size: 1.35rem;
}
.book-input {
    background: #ffffff;
    border: 1px solid #c9bda9;
    border-radius: 4px;
    padding: 0.65rem 0.9rem;
    font-family: 'Noto Serif Devanagari', sans-serif;
}
.book-input:focus {
    background: #fff;
    border-color: #b8561f;
    box-shadow: 0 0 0 3px rgba(184, 86, 31, 0.15);
}
.book-submit-btn {
    background: #b8561f;
    color: #fff;
    font-weight: 600;
    padding: 0.6rem 1.4rem;
    border-radius: 4px;
    border: none;
    transition: background 0.2s;
}
.book-submit-btn:hover {
    background: #994415;
    color: #fff;
}

/* Sidebar Styling */
.book-sidebar-card {
    background: #faf6ee;
    border: 1px solid #dcd0bc;
    border-radius: 4px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.colophon-seal {
    width: 46px;
    height: 46px;
    background: #e8d9c5;
    color: #99281a;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    border: 2px dashed #b8561f;
}
.author-name {
    font-family: 'Noto Serif Devanagari', 'Martel', serif;
    font-weight: 700;
    color: #2b1f1d;
    margin-bottom: 0.15rem;
}
.author-bio {
    line-height: 1.6;
    color: #59463c;
}
.colophon-divider {
    border-color: #dcd0bc;
    margin: 1rem 0;
}
.book-outline-btn {
    border: 1px solid #b8561f;
    color: #b8561f;
    font-weight: 600;
    border-radius: 4px;
    transition: all 0.2s;
}
.book-outline-btn:hover {
    background: #b8561f;
    color: #fff;
}

.sidebar-title {
    font-family: 'Noto Serif Devanagari', 'Martel', serif;
    font-size: 1.15rem;
    color: #2b1f1d;
    font-weight: 700;
    border-bottom: 1px solid #e3d7c3;
    padding-bottom: 0.6rem;
}
.chapter-list {
    display: flex;
    flex-direction: column;
    gap: 0.85rem;
}
.chapter-item {
    display: flex;
    gap: 0.75rem;
    align-items: flex-start;
    text-decoration: none;
    color: #3d2f28;
    padding: 0.5rem;
    border-radius: 4px;
    transition: all 0.2s ease;
    border-left: 2px solid transparent;
}
.chapter-item:hover {
    background: #efe4d2;
    color: #99281a;
    border-left-color: #99281a;
    transform: translateX(3px);
}
.chapter-num {
    font-family: 'Cinzel', serif;
    font-weight: 700;
    font-size: 0.85rem;
    background: #e6d7c1;
    color: #6e4e37;
    padding: 2px 7px;
    border-radius: 4px;
}
.chapter-title {
    font-family: 'Noto Serif Devanagari', 'Martel', serif;
    font-size: 0.95rem;
    font-weight: 600;
    line-height: 1.35;
}
.book-link {
    color: #b8561f;
}

/* ==========================================================
   THEME VARIATIONS (Sepia, Ivory, Dark)
   ========================================================== */

/* Sepia Theme */
[data-book-theme="sepia"] .book-reading-environment {
    background: #ded1b8;
}
[data-book-theme="sepia"] .book-page,
[data-book-theme="sepia"] .book-guestbook,
[data-book-theme="sepia"] .book-sidebar-card {
    background: #f4ecd8;
    border-color: #c9baa1;
}
[data-book-theme="sepia"] .book-ribbon::after {
    border-bottom-color: #f4ecd8;
}

/* Ivory / Crisp Theme */
[data-book-theme="ivory"] .book-reading-environment {
    background: #f0f2f5;
}
[data-book-theme="ivory"] .book-page,
[data-book-theme="ivory"] .book-guestbook,
[data-book-theme="ivory"] .book-sidebar-card {
    background: #ffffff;
    border-color: #e2e8f0;
}
[data-book-theme="ivory"] .book-border-frame {
    border-color: #cbd5e1;
    outline-color: #f1f5f9;
}
[data-book-theme="ivory"] .book-ribbon::after {
    border-bottom-color: #ffffff;
}

/* Dark / Night Mode Theme */
[data-book-theme="dark"] .book-reading-environment {
    background: #121514;
}
[data-book-theme="dark"] .reader-toolbar {
    background: rgba(28, 34, 32, 0.9);
    border-color: #2e3b36;
}
[data-book-theme="dark"] .book-back-btn,
[data-book-theme="dark"] .font-ctrl-btn {
    color: #d1dad6;
}
[data-book-theme="dark"] .book-page,
[data-book-theme="dark"] .book-guestbook,
[data-book-theme="dark"] .book-sidebar-card {
    background: #1c2220;
    border-color: #2e3b36;
    color: #d7e0dc;
    box-shadow: 0 15px 35px rgba(0,0,0,0.6);
}
[data-book-theme="dark"] .book-border-frame {
    border-color: #3b4d46;
    outline-color: #242c29;
}
[data-book-theme="dark"] .book-ribbon::after {
    border-bottom-color: #1c2220;
}
[data-book-theme="dark"] .book-main-title {
    color: #f0f4f2;
}
[data-book-theme="dark"] .book-body-content {
    color: #d2ded9;
}
[data-book-theme="dark"] .book-header-line,
[data-book-theme="dark"] .book-meta-strip,
[data-book-theme="dark"] .book-page-number {
    color: #9cb2aa;
}
[data-book-theme="dark"] .book-input {
    background: #151a18;
    border-color: #32423c;
    color: #e5ece9;
}
[data-book-theme="dark"] .sidebar-title,
[data-book-theme="dark"] .author-name {
    color: #e5ece9;
}
[data-book-theme="dark"] .chapter-item {
    color: #c0cfca;
}
[data-book-theme="dark"] .chapter-item:hover {
    background: #242e2b;
}

/* ==========================================================
   RESPONSIVE & PRINT MEDIA
   ========================================================== */
@media (max-width: 767.98px) {
    .book-page {
        padding: 2rem 1.25rem;
    }
    .book-border-frame {
        padding: 1.5rem 1rem;
    }
    .book-main-title {
        font-size: 1.9rem;
    }
    .book-body-content {
        font-size: 1.1rem;
        line-height: 2;
    }
    .book-body-content p {
        text-indent: 1rem;
    }
    .book-header-line {
        font-size: 0.72rem;
        flex-direction: column;
        gap: 6px;
    }
    .book-ribbon {
        right: 15px;
        width: 22px;
        height: 50px;
    }
}

@media print {
    .topbar, .site-header, .site-footer, .reader-toolbar, .book-sidebar, .book-guestbook, .book-ribbon {
        display: none !important;
    }
    .book-reading-environment {
        background: #fff !important;
        padding: 0 !important;
    }
    .book-page {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
    }
    .book-border-frame {
        outline: none !important;
    }
    .book-body-content {
        color: #000 !important;
        font-size: 12pt !important;
        line-height: 1.8 !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Reading Progress Bar
    const progressEl = document.getElementById('readingProgress');
    const bookContent = document.getElementById('bookContent');
    
    window.addEventListener('scroll', function() {
        if (!bookContent) return;
        const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
        if (totalHeight > 0) {
            const scrollPercent = (window.scrollY / totalHeight) * 100;
            progressEl.style.width = Math.min(100, Math.max(0, scrollPercent)) + '%';
        }
    });

    // 2. Font Size Controls
    const bookPage = document.getElementById('bookPage');
    let currentFontSize = 1.22; // rem
    
    document.getElementById('fontInc').addEventListener('click', function() {
        if (currentFontSize < 1.7) {
            currentFontSize += 0.1;
            bookContent.style.fontSize = currentFontSize + 'rem';
        }
    });
    
    document.getElementById('fontDec').addEventListener('click', function() {
        if (currentFontSize > 0.95) {
            currentFontSize -= 0.1;
            bookContent.style.fontSize = currentFontSize + 'rem';
        }
    });
    
    document.getElementById('fontReset').addEventListener('click', function() {
        currentFontSize = 1.22;
        bookContent.style.fontSize = '1.22rem';
    });

    // 3. Theme Switcher
    const themeButtons = document.querySelectorAll('.theme-btn');
    themeButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            themeButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const theme = this.getAttribute('data-theme');
            document.body.setAttribute('data-book-theme', theme);
            try { localStorage.setItem('pradeep_book_theme', theme); } catch(e) {}
        });
    });

    // Restore saved theme
    try {
        const savedTheme = localStorage.getItem('pradeep_book_theme');
        if (savedTheme) {
            const matchBtn = document.querySelector(`.theme-btn[data-theme="${savedTheme}"]`);
            if (matchBtn) matchBtn.click();
        }
    } catch(e) {}
});
</script>
