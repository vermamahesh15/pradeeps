<?php
declare(strict_types=1);

$authors = $authors ?? [];
$currentRole = $currentRole ?? 'all';
$searchQuery = $searchQuery ?? '';
$currentPage = $currentPage ?? 1;
$totalPages = $totalPages ?? 1;
$totalAuthors = $totalAuthors ?? count($authors);
$limit = $limit ?? 6;

$startCount = $totalAuthors > 0 ? (($currentPage - 1) * $limit) + 1 : 0;
$endCount = min($currentPage * $limit, $totalAuthors);

$roleNames = [
    'all' => ps_text('सभी लेखक व विचारक', 'All Authors'),
    'writer' => ps_text('साहित्यकार व स्तम्भकार', 'Writers & Columnists'),
    'advisor' => ps_text('मार्गदर्शक व सलाहकार', 'Advisors & Mentors'),
    'social' => ps_text('पर्यावरण व समाजसेवी', 'Social & Eco Leaders'),
    'guest' => ps_text('अतिथि लेखक', 'Guest Contributors'),
];
?>

<div class="flex flex-col w-full min-h-screen bg-cream-canvas">
  <!-- Top Hero Banner -->
  <section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
        <a class="hover:text-primary transition-colors flex items-center gap-1" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('लेखक व विचारक', 'Authors & Writers')) ?></span>
      </nav>

      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2 bg-primary-container/20 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-primary-container/30 font-semibold">
          <span class="material-symbols-outlined text-[16px] text-primary" style="font-variation-settings: 'FILL' 1;">menu_book</span>
          <span><?= e(ps_text('साहित्यकार, मार्गदर्शक व विचारक', 'AUTHORS, SCHOLARS & WRITERS')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= e(ps_text('हमारे लेखक एवं विचार-नायक', 'Our Authors & Thought Leaders')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm leading-relaxed">
          <?= e(ps_text('पर्यावरण संवर्धन, अवधी लोक-साहित्य, जनसेवा व सामाजिक चेतना पर अपने विचारों एवं रचनाओं से समाज को दिशा देने वाले मूर्धन्य विचारकों एवं स्तम्भकारों की निर्देशिका।', 'Directory of authors, environmentalists, Awadhi scholars, and social thinkers contributing to community progress and literature.')) ?>
        </p>
      </div>
    </div>
  </section>

  <!-- Filter & Search Toolbar -->
  <section class="w-full bg-pure-white border-b border-border-warm py-6 sticky top-[116px] z-30 shadow-xs">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <form method="get" action="<?= e(base_url('/authors')) ?>" class="flex flex-col lg:flex-row items-center justify-between gap-4">
        <!-- Search Input -->
        <div class="relative w-full lg:w-96">
          <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted text-[20px]">search</span>
          <input type="text" 
                 name="q" 
                 value="<?= e($searchQuery) ?>" 
                 placeholder="<?= e(ps_text('लेखक का नाम या विषय खोजें...', 'Search by author name or topic...')) ?>" 
                 class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-border-warm bg-cream-canvas text-deep-forest font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
          <?php if ($searchQuery !== ''): ?>
            <a href="<?= e(base_url('/authors?role=' . urlencode($currentRole))) ?>" class="absolute right-3 top-1/2 -translate-y-1/2 text-text-muted hover:text-deep-forest text-sm font-bold">&times;</a>
          <?php endif; ?>
          <?php if ($currentRole !== 'all'): ?>
            <input type="hidden" name="role" value="<?= e($currentRole) ?>">
          <?php endif; ?>
        </div>

        <!-- Role Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto w-full lg:w-auto pb-1 lg:pb-0 scrollbar-none">
          <?php foreach ($roleNames as $roleKey => $roleLabel): 
            $isActiveRole = ($currentRole === $roleKey);
            $filterUrl = base_url('/authors?role=' . urlencode($roleKey) . ($searchQuery ? '&q=' . urlencode($searchQuery) : ''));
          ?>
            <a href="<?= e($filterUrl) ?>" 
               class="px-4 py-2 rounded-full font-label-sm text-label-sm whitespace-nowrap transition-all cursor-pointer font-semibold border <?= $isActiveRole ? 'bg-primary-container text-on-primary border-primary-container shadow-xs' : 'bg-pure-white text-on-surface-variant hover:bg-soft-meadow hover:text-deep-forest border-border-warm' ?>">
              <?= e($roleLabel) ?>
            </a>
          <?php endforeach; ?>
        </div>
      </form>
    </div>
  </section>

  <!-- Authors Directory Grid -->
  <section class="max-w-container-max mx-auto px-4 sm:px-8 py-12 sm:py-16 w-full flex-grow">
    <?php if ($searchQuery || $currentRole !== 'all'): ?>
      <div class="flex items-center justify-between mb-8 pb-4 border-b border-border-warm">
        <div class="text-label-md font-label-md text-text-muted">
          <span><?= e(ps_text('परिणाम:', 'Results:')) ?></span>
          <span class="font-bold text-deep-forest"><?= $totalAuthors ?> <?= e(ps_text('लेखक पाए गए', 'Authors found')) ?></span>
          <?php if ($currentRole !== 'all'): ?>
            <span class="inline-flex items-center gap-1 bg-primary-container/10 text-primary px-2.5 py-0.5 rounded-md ml-2 text-xs font-semibold">
              <?= e($roleNames[$currentRole] ?? $currentRole) ?>
            </span>
          <?php endif; ?>
          <?php if ($searchQuery): ?>
            <span class="text-xs text-text-muted ml-2">"<?= e($searchQuery) ?>"</span>
          <?php endif; ?>
        </div>
        <a href="<?= e(base_url('/authors')) ?>" class="text-primary hover:underline text-xs font-semibold flex items-center gap-1">
          <span class="material-symbols-outlined text-[15px]">refresh</span>
          <span><?= e(ps_text('सभी दिखाएं', 'Clear filters')) ?></span>
        </a>
      </div>
    <?php endif; ?>

    <?php if (empty($authors)): ?>
      <div class="bg-pure-white rounded-3xl p-12 text-center border border-border-warm shadow-xs max-w-xl mx-auto my-12">
        <div class="w-16 h-16 rounded-full bg-soft-meadow text-primary flex items-center justify-center mx-auto mb-4">
          <span class="material-symbols-outlined text-3xl">person_search</span>
        </div>
        <h3 class="font-display-hero text-headline-sm text-deep-forest font-bold mb-2">
          <?= e(ps_text('कोई लेखक नहीं मिला', 'No authors found')) ?>
        </h3>
        <p class="text-text-muted font-body-md mb-6">
          <?= e(ps_text('आपके द्वारा चुने गए फ़िल्टर या खोज शब्द के लिए कोई लेखक उपलब्ध नहीं है।', 'No author matches your selected filter or search query.')) ?>
        </p>
        <a href="<?= e(base_url('/authors')) ?>" class="inline-flex items-center gap-2 bg-primary-container text-on-primary px-6 py-2.5 rounded-xl font-label-md text-label-md font-semibold hover:bg-deep-forest transition-colors">
          <span><?= e(ps_text('सभी लेखक देखें', 'View All Authors')) ?></span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
      </div>
    <?php else: ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($authors as $author): 
          $photo = !empty($author['profile_photo']) ? $author['profile_photo'] : 'assets/images/slider_final_1.png';
          $isExternalImg = preg_match('#^https?://#i', $photo);
          $imgUrl = $isExternalImg ? $photo : base_url($photo);
          $tags = $author['tags'] ?? ['अवधी लोक-साहित्य', 'पर्यावरण'];
          $roleTitle = $author['role_title'] ?? ($author['role'] === 'writer' ? 'साहित्यकार व स्तम्भकार' : ($author['role'] === 'advisor' ? 'मार्गदर्शक व सलाहकार' : 'समाजसेवी व लेखक'));
        ?>
          <div class="group bg-pure-white rounded-3xl p-6 sm:p-7 border border-border-warm shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
            <!-- Decorative Accent Circle -->
            <div class="absolute -right-8 -top-8 w-24 h-24 bg-soft-meadow rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>

            <div>
              <!-- Header Profile Row -->
              <div class="flex items-start gap-4 mb-5 relative z-10">
                <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden border-2 border-primary-fixed/30 shrink-0 shadow-sm group-hover:border-primary transition-colors">
                  <img src="<?= e($imgUrl) ?>" alt="<?= e($author['name']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy">
                </div>
                <div class="flex flex-col">
                  <span class="inline-flex items-center gap-1 bg-primary-container/10 text-primary px-2.5 py-0.5 rounded-full font-label-sm text-[11px] font-semibold w-fit mb-1 border border-primary-container/20">
                    <span class="material-symbols-outlined text-[13px]">edit_note</span>
                    <span><?= e($roleTitle) ?></span>
                  </span>
                  <h2 class="font-display-hero text-title-lg sm:text-headline-xs text-deep-forest font-bold leading-snug group-hover:text-primary transition-colors">
                    <?= e($author['name']) ?>
                  </h2>
                </div>
              </div>

              <!-- Biography -->
              <p class="font-body-md text-body-md text-text-muted line-clamp-3 mb-5 leading-relaxed">
                <?= e($author['biography'] ?? ps_text('अवधी भाषा, प्रकृति संरक्षण एवं सामाजिक जन-सरोकारों पर समर्पित लेखक।', 'Writer dedicated to Awadhi literature, environmental conservation, and social welfare.')) ?>
              </p>

              <!-- Tags -->
              <?php if (!empty($tags)): ?>
                <div class="flex flex-wrap gap-1.5 mb-6">
                  <?php foreach ((array)$tags as $tag): ?>
                    <span class="bg-cream-canvas text-deep-forest px-2.5 py-1 rounded-lg text-[11.5px] font-semibold border border-border-warm">
                      #<?= e($tag) ?>
                    </span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>

            <!-- Footer Actions & Metrics -->
            <div class="pt-4 border-t border-border-warm/80 flex items-center justify-between gap-3 relative z-10 mt-auto">
              <div class="flex items-center gap-1.5 text-text-muted font-label-sm text-xs">
                <span class="material-symbols-outlined text-[16px] text-secondary">article</span>
                <span><?= e((string)($author['articles_count'] ?? rand(10, 35))) ?> <?= e(ps_text('आलेख', 'Articles')) ?></span>
              </div>

              <a href="<?= e(base_url('/blog?author=' . urlencode($author['name']))) ?>" 
                 class="inline-flex items-center gap-1.5 bg-soft-meadow text-deep-forest hover:bg-primary-container hover:text-on-primary px-4 py-2 rounded-xl font-label-sm text-label-sm font-semibold transition-all shadow-2xs">
                <span><?= e(ps_text('लेख देखें', 'Read Posts')) ?></span>
                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Pagination Section -->
      <?php if ($totalPages > 1): ?>
        <div class="mt-16 pt-8 border-t border-border-warm flex flex-col sm:flex-row items-center justify-between gap-4">
          <!-- Page Info -->
          <div class="font-label-md text-label-md text-text-muted">
            <?= e(ps_text('दर्शाए जा रहे हैं', 'Showing')) ?> 
            <span class="font-bold text-deep-forest"><?= $startCount ?>–<?= $endCount ?></span> 
            <?= e(ps_text('कुल', 'of')) ?> 
            <span class="font-bold text-deep-forest"><?= $totalAuthors ?></span> 
            <?= e(ps_text('लेखक', 'Authors')) ?>
          </div>

          <!-- Page Buttons -->
          <nav aria-label="Authors Pagination" class="flex items-center gap-2">
            <!-- Previous Button -->
            <?php if ($currentPage > 1): 
              $prevUrl = base_url('/authors?page=' . ($currentPage - 1) . ($currentRole !== 'all' ? '&role=' . urlencode($currentRole) : '') . ($searchQuery ? '&q=' . urlencode($searchQuery) : ''));
            ?>
              <a href="<?= e($prevUrl) ?>" class="px-3.5 py-2 rounded-xl border border-border-warm bg-pure-white text-deep-forest hover:bg-soft-meadow transition-colors flex items-center gap-1 font-label-md text-label-md font-semibold">
                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                <span><?= e(ps_text('पिछला', 'Previous')) ?></span>
              </a>
            <?php else: ?>
              <span class="px-3.5 py-2 rounded-xl border border-border-warm/50 bg-cream-canvas text-text-muted/40 opacity-60 flex items-center gap-1 font-label-md text-label-md font-semibold cursor-not-allowed">
                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                <span><?= e(ps_text('पिछला', 'Previous')) ?></span>
              </span>
            <?php endif; ?>

            <!-- Page Number Pills -->
            <?php for ($p = 1; $p <= $totalPages; $p++): 
              $pUrl = base_url('/authors?page=' . $p . ($currentRole !== 'all' ? '&role=' . urlencode($currentRole) : '') . ($searchQuery ? '&q=' . urlencode($searchQuery) : ''));
              $isCurrent = ($p === $currentPage);
            ?>
              <a href="<?= e($pUrl) ?>" class="w-10 h-10 rounded-xl flex items-center justify-center font-label-md text-label-md font-bold transition-all <?= $isCurrent ? 'bg-primary-container text-on-primary shadow-xs' : 'bg-pure-white border border-border-warm text-deep-forest hover:bg-soft-meadow' ?>">
                <?= $p ?>
              </a>
            <?php endfor; ?>

            <!-- Next Button -->
            <?php if ($currentPage < $totalPages): 
              $nextUrl = base_url('/authors?page=' . ($currentPage + 1) . ($currentRole !== 'all' ? '&role=' . urlencode($currentRole) : '') . ($searchQuery ? '&q=' . urlencode($searchQuery) : ''));
            ?>
              <a href="<?= e($nextUrl) ?>" class="px-3.5 py-2 rounded-xl border border-border-warm bg-pure-white text-deep-forest hover:bg-soft-meadow transition-colors flex items-center gap-1 font-label-md text-label-md font-semibold">
                <span><?= e(ps_text('अगला', 'Next')) ?></span>
                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
              </a>
            <?php else: ?>
              <span class="px-3.5 py-2 rounded-xl border border-border-warm/50 bg-cream-canvas text-text-muted/40 opacity-60 flex items-center gap-1 font-label-md text-label-md font-semibold cursor-not-allowed">
                <span><?= e(ps_text('अगला', 'Next')) ?></span>
                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
              </span>
            <?php endif; ?>
          </nav>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </section>
</div>
