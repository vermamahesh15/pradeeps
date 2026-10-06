<?php
declare(strict_types=1);

$stickersList = $stickers ?? [];
$searchQuery = $searchQuery ?? '';
$phone = trim($settings['phone'] ?? '+91 9919007190');
$email = trim($settings['email'] ?? 'contact@pradeepsarang.in');
?>

<div class="flex flex-col w-full">
  <!-- Top Breadcrumb & Hero Banner Header -->
  <section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
        <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <a class="hover:text-primary transition-colors" href="<?= e(base_url('/green-gang')) ?>">
          <span><?= e(ps_text('ग्रीन गैंग अभियान', 'Green Gang Movement')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('स्टिकर्स व डिजिटल पोस्टर दीर्घा', 'Stickers & Posters Archive')) ?></span>
      </nav>
      
      <!-- Badge & Main Editorial Title -->
      <div class="max-w-4xl">
        <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">note_stack</span>
          <span><?= count($stickersList) ?> <?= e(ps_text('आधिकारिक स्टिकर्स व स्लोगन पोस्टर', 'Official Shareable Stickers & Posters')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= e(ps_text('ग्रीन गैंग: आधिकारिक डिजिटल स्टिकर्स व स्लोगन पोस्टर दीर्घा', 'Green Gang: Official Digital Stickers & Slogan Posters Gallery')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-3 max-w-3xl leading-relaxed">
          <?= e(ps_text('नियम 31 के अंतर्गत संस्थापक प्रदीप सारंग जी द्वारा जारी - सभी समन्वयक एवं पर्यावरण सैनिक इन डिजिटल स्टिकर्स व पोस्टरों को यहाँ से डाउनलोड करके अपने व्हाट्सएप ग्रुप व सोशल मीडिया पर व्यापक प्रचार हेतु साझा कर सकते हैं।', 'Official downloadable media released under Rule 31 for coordinators and environmental volunteers to share across WhatsApp groups and social networks.')) ?>
        </p>

        <!-- Quick Jump Buttons & Live Search -->
        <div class="flex flex-wrap items-center gap-4 mt-6">
          <a href="<?= e(base_url('/green-gang')) ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-deep-forest hover:bg-forest-night !text-white font-label-md text-label-md font-bold shadow-md transition-all" style="color: #ffffff !important;">
            <span class="material-symbols-outlined text-[18px]" style="color: #ffffff !important;">arrow_back</span>
            <span style="color: #ffffff !important;"><?= e(ps_text('ग्रीन गैंग संकल्प-पत्र पर लौटें', 'Back to Charter')) ?></span>
          </a>

          <!-- Quick Search Filter Form -->
          <form method="get" action="<?= e(base_url('/green-gang-stickers')) ?>" class="relative flex-1 max-w-xs sm:max-w-sm">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-muted text-[18px]">search</span>
            <input type="text" name="q" value="<?= e($searchQuery) ?>" placeholder="<?= e(ps_text('स्टिकर खोजें (उदा. ग्रीन मॉर्निंग, 5 जून)...', 'Search stickers...')) ?>" class="w-full bg-pure-white border border-border-warm text-on-surface pl-9 pr-8 py-2 rounded-full text-xs sm:text-sm font-body-md focus:outline-none focus:ring-2 focus:ring-primary shadow-sm">
            <?php if ($searchQuery): ?>
              <a href="<?= e(base_url('/green-gang-stickers')) ?>" class="absolute right-3 top-1/2 -translate-y-1/2 text-text-muted hover:text-deep-forest text-xs font-bold">✕</a>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Stickers Grid Showcase Section -->
  <section class="w-full bg-cream-canvas py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      
      <?php if (empty($stickersList)): ?>
        <div class="text-center py-16 bg-pure-white rounded-3xl border border-border-warm p-8 max-w-xl mx-auto shadow-sm">
          <span class="material-symbols-outlined text-5xl text-text-muted mb-3">note_alt</span>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-2">
            <?= e(ps_text('कोई स्टिकर नहीं मिला', 'No Stickers Found')) ?>
          </h3>
          <p class="font-body-md text-text-muted mb-6">
            <?= e(ps_text('आपके द्वारा खोजे गए शब्द से मेल खाता कोई स्टिकर उपलब्ध नहीं है।', 'No stickers matching your search query were found.')) ?>
          </p>
          <a href="<?= e(base_url('/green-gang-stickers')) ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-primary text-pure-white font-label-md text-sm font-bold shadow-sm">
            <span><?= e(ps_text('सभी स्टिकर्स देखें', 'Reset Search')) ?></span>
          </a>
        </div>
      <?php else: ?>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
          <?php foreach ($stickersList as $st): 
            $imgUrl = base_url($st['image']);
            $stTitle = $st['title'] ?? 'ग्रीन गैंग स्टिकर';
            $stTagline = $st['tagline'] ?? '';
            $waShareText = rawurlencode("🌿 " . $stTitle . ($stTagline ? " - " . $stTagline : "") . "\n\n" . "ग्रीन गैंग बाराबंकी official sticker: " . $imgUrl);
          ?>
            <div class="group bg-pure-white rounded-3xl p-5 shadow-sm border border-border-warm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
              <div>
                <!-- Sticker Container Box -->
                <div class="relative w-full aspect-square rounded-2xl bg-gradient-to-br from-soft-meadow via-surface-container-low to-soft-meadow border border-border-warm flex items-center justify-center p-5 overflow-hidden mb-4 group-hover:border-primary transition-colors">
                  <img src="<?= e($imgUrl) ?>" alt="<?= e($stTitle) ?>" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
                  <span class="absolute top-3 left-3 bg-deep-forest/90 text-pure-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-sm">
                    Sticker #<?= (int)($st['id'] ?? 1) ?>
                  </span>
                  
                  <a href="<?= e($imgUrl) ?>" data-ps-lightbox data-caption="<?= e($stTitle . ($stTagline ? ' — ' . $stTagline : '')) ?>" class="absolute inset-0 bg-deep-forest/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-pure-white text-xs font-bold gap-1 rounded-2xl">
                    <span class="material-symbols-outlined text-[22px]">zoom_in</span>
                    <span><?= e(ps_text('ज़ूम करें', 'Zoom High-Res')) ?></span>
                  </a>
                </div>

                <h3 class="font-title-md text-title-md text-deep-forest font-bold leading-snug mb-1">
                  <?= e($stTitle) ?>
                </h3>
                <?php if ($stTagline): ?>
                  <p class="font-body-xs text-xs text-text-muted leading-relaxed mb-4">
                    <?= e($stTagline) ?>
                  </p>
                <?php endif; ?>
              </div>

              <!-- Interactive Buttons: Download, WhatsApp & Copy Link -->
              <div class="pt-3 border-t border-border-warm flex items-center justify-between gap-2">
                <a href="<?= e($imgUrl) ?>" download="<?= e(basename($st['image'])) ?>" class="flex-1 inline-flex items-center justify-center gap-1.5 px-3.5 py-2.5 rounded-xl bg-deep-forest hover:bg-forest-night !text-white font-label-sm text-xs font-bold shadow-sm transition-all" style="color: #ffffff !important;" title="स्टिकर डाउनलोड करें">
                  <span class="material-symbols-outlined text-[16px]" style="color: #ffffff !important;">download</span>
                  <span style="color: #ffffff !important;"><?= e(ps_text('डाउनलोड', 'Download')) ?></span>
                </a>

                <a href="https://api.whatsapp.com/send?text=<?= $waShareText ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center p-2.5 rounded-xl bg-[#25D366] hover:bg-[#1ebd59] !text-white transition-colors" style="color: #ffffff !important;" title="व्हाट्सएप पर शेयर करें">
                  <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.124.555 4.197 1.608 6.021L.069 23.931l5.989-1.57A11.954 11.954 0 0012.031 24c6.646 0 12.031-5.385 12.031-12.031S18.677 0 12.031 0zm.016 21.84c-1.815 0-3.593-.487-5.148-1.41l-.369-.22-3.824 1.003 1.02-3.727-.241-.384a9.88 9.88 0 01-1.517-5.071c0-5.452 4.436-9.888 9.888-9.888 5.452 0 9.888 4.436 9.888 9.888 0 5.452-4.436 9.888-9.888 9.888z"/></svg>
                </a>

                <button type="button" onclick="copyStickerLink('<?= e($imgUrl) ?>', this)" class="inline-flex items-center justify-center p-2.5 rounded-xl bg-surface-container-high hover:bg-border-warm text-deep-forest transition-colors" title="लिंक कॉपी करें">
                  <span class="material-symbols-outlined text-[16px]">content_copy</span>
                </button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <!-- Bottom Banner & Back Navigation -->
      <div class="mt-16 bg-pure-white rounded-3xl p-6 sm:p-10 border border-border-warm text-center shadow-sm flex flex-col items-center">
        <div class="w-14 h-14 rounded-2xl bg-primary-fixed/40 text-primary-container flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-3xl">eco</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-2">
          <?= e(ps_text('ग्रीन गैंग आंदोलन में सहभागी बनें', 'Join the Green Gang Movement')) ?>
        </h3>
        <p class="font-body-md text-text-muted max-w-xl mb-6 leading-relaxed">
          <?= e(ps_text('पेड़ लगाएंगे, पेड़ लगवाएंगे, पेड़ बचाएंगे के संकल्प के साथ अपने हर मांगलिक अवसर पर पौधे रोपें तथा दैनिक संवाद में \'ग्रीन मॉर्निंग\' अपनाएं।', 'Pledge to plant and protect trees on birthdays and milestones, and embrace Green Morning in daily greetings.')) ?>
        </p>
        <div class="flex flex-wrap justify-center items-center gap-4">
          <a href="<?= e(base_url('/green-gang')) ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-deep-forest hover:bg-forest-night !text-white font-label-md text-sm font-bold shadow-md transition-all" style="color: #ffffff !important;">
            <span class="material-symbols-outlined text-[18px]" style="color: #ffffff !important;">history_edu</span>
            <span style="color: #ffffff !important;"><?= e(ps_text('43 स्वर्णिम नियम व संकल्प-पत्र पढ़ें', 'Read 43 Charter Rules')) ?></span>
          </a>
          <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-primary hover:bg-primary-hover !text-white font-label-md text-sm font-bold shadow-md transition-all" style="color: #ffffff !important;">
            <span class="material-symbols-outlined text-[18px]" style="color: #ffffff !important;">group_add</span>
            <span style="color: #ffffff !important;"><?= e(ps_text('ग्रीन गैंग स्वयंसेवक बनें', 'Join as Volunteer')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
function copyStickerLink(url, btn) {
  const onSuccess = () => {
    if (!btn) return;
    const orig = btn.innerHTML;
    btn.innerHTML = '<span class="material-symbols-outlined text-[16px] text-primary">check</span>';
    setTimeout(() => { btn.innerHTML = orig; }, 2000);
  };
  if (navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(url).then(onSuccess).catch(() => {
      fallbackCopyText(url, onSuccess);
    });
  } else {
    fallbackCopyText(url, onSuccess);
  }
}

function fallbackCopyText(text, callback) {
  const el = document.createElement('textarea');
  el.value = text;
  el.setAttribute('readonly', '');
  el.style.position = 'absolute';
  el.style.left = '-9999px';
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
  if (callback) callback();
}
</script>
