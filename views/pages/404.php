<?php declare(strict_types=1); ?>
<section class="min-h-[60vh] flex flex-col items-center justify-center text-center px-4 py-16 bg-cream-canvas">
  <div class="max-w-md mx-auto flex flex-col items-center">
    <div class="w-20 h-20 rounded-full bg-emerald-100 text-[#14532D] flex items-center justify-center font-bold text-3xl mb-4 border border-emerald-300">
      404
    </div>
    <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#14532D] mb-3">
      <?= e(ps_text('यह पृष्ठ नहीं मिला', 'Page Not Found')) ?>
    </h1>
    <p class="font-body-md text-body-md text-text-muted mb-8 leading-relaxed">
      <?= e(ps_text('आप जिस पृष्ठ की तलाश कर रहे हैं उसका पता बदल गया हो सकता है या सामग्री उपलब्ध नहीं है।', 'The page you are looking for may have moved or is temporarily unavailable.')) ?>
    </p>
    <a href="<?= e(base_url('/')) ?>" class="inline-flex items-center gap-2 bg-[#14532D] hover:bg-[#0F3D21] text-white font-bold px-6 py-3 rounded-xl transition-all shadow-md">
      <span class="material-symbols-outlined text-[20px]">home</span>
      <span><?= e(ps_text('मुख्य पृष्ठ पर जाएं', 'Return to Home')) ?></span>
    </a>
  </div>
</section>

