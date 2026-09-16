<?php
declare(strict_types=1);

$videos = $videos ?? [];
$selectedCategory = $selectedCategory ?? 'all';
$searchQuery = $searchQuery ?? '';
$currentPage = $currentPage ?? 1;
$totalPages = $totalPages ?? 1;
$totalVideos = $totalVideos ?? count($videos);
$limit = $limit ?? 12;

$categories = [
    'all' => ['label' => ps_text('सभी वीडियो', 'All Videos'), 'icon' => 'grid_view'],
    'जन-चौपाल' => ['label' => ps_text('जन-चौपाल', 'Chaupal'), 'icon' => 'forum'],
    'अवधी साहित्य' => ['label' => ps_text('अवधी साहित्य', 'Awadhi Literature'), 'icon' => 'auto_stories'],
    'पर्यावरण चेतना' => ['label' => ps_text('पर्यावरण चेतना', 'Eco Awareness'), 'icon' => 'eco'],
    'वन्यजीव संरक्षण' => ['label' => ps_text('वन्यजीव संरक्षण', 'Wildlife'), 'icon' => 'pets'],
    'मीडिया साक्षात्कार' => ['label' => ps_text('मीडिया साक्षात्कार', 'Interviews'), 'icon' => 'podcasts'],
];

// Separate first video as Featured Spotlight if on page 1 with no search filter
$featuredVideo = null;
$gridVideos = $videos;

if ($currentPage === 1 && $selectedCategory === 'all' && empty($searchQuery) && !empty($videos)) {
    $featuredVideo = array_shift($gridVideos);
}

// Dynamic YouTube Channel configuration from Settings
$ytSetting = trim((string)setting('youtube', ''));
$youtubeChannelUrl = (!empty($ytSetting) && $ytSetting !== '#') ? $ytSetting : 'https://www.youtube.com/@pradeepsarang223';
?>

<div class="flex flex-col w-full bg-[#f8faf7] min-h-screen">
  
  <!-- ================= TOP HERO BANNER (CINEMATIC DARK GLASS) ================= -->
  <section class="relative w-full bg-gradient-to-br from-[#0a1a12] via-[#122b1e] to-[#07130c] text-white overflow-hidden py-12 md:py-20 border-b border-emerald-900/40">
    <!-- Ambient Lighting & Mesh Gradients -->
    <div class="absolute -top-32 -left-20 w-96 h-96 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 right-0 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/3 w-72 h-72 bg-red-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      
      <!-- Breadcrumb Navigation -->
      <nav class="flex items-center gap-2 text-xs sm:text-sm text-emerald-200/70 mb-6" aria-label="Breadcrumb">
        <a class="hover:text-amber-300 transition-colors flex items-center gap-1" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-emerald-200/60"><?= e(ps_text('गैलरी व मीडिया', 'Gallery & Media')) ?></span>
        <span class="opacity-40">/</span>
        <span class="text-amber-300 font-semibold"><?= e(ps_text('वीडियो दीर्घा', 'Video Gallery')) ?></span>
      </nav>

      <!-- Main Banner Content -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        
        <div class="lg:col-span-8 space-y-5">
          <div class="inline-flex items-center gap-2 bg-emerald-900/60 text-emerald-300 px-4 py-1.5 rounded-full text-xs font-semibold border border-emerald-700/50 backdrop-blur-md shadow-inner">
            <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></span>
            <span class="!text-emerald-300" style="color: #6ee7b7 !important;"><?= e(ps_text('आधिकारिक यूट्यूब वीडियो आर्काइव • प्रदीप सारंग', 'Official YouTube Video Archives • Pradeep Sarang')) ?></span>
          </div>

          <h1 class="font-display-hero text-3xl sm:text-4xl md:text-5xl !text-white font-bold leading-tight tracking-tight" style="color: #ffffff !important;">
            <?= ps_text('जन-संवाद, अवधी काव्य एवं <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-emerald-300 to-teal-200">पर्यावरण क्रांति</span>', 'Dialogue, Awadhi Poetry & <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-emerald-300 to-teal-200">Eco Revolution</span>') ?>
          </h1>

          <p class="text-emerald-100/90 text-base md:text-lg max-w-3xl leading-relaxed font-body-lg" style="color: #d1fae5 !important;">
            <?= e(ps_text('श्री प्रदीप सारंग जी के ओजस्वी भाषणों, ग्रामीण चौपालों के जीवंत संवाद, ग्रीन गैंग अभियानों, अवधी कवि सम्मेलनों और मीडिया साक्षात्कारों के आधिकारिक वीडियो देखें।', 'Explore official videos of Shri Pradeep Sarang\'s speeches, rural chaupals, Green Gang plantation drives, Awadhi poetry sessions, and media interviews.')) ?>
          </p>

          <!-- Channel Stats & Subscribe Strip -->
          <div class="pt-2 flex flex-wrap items-center gap-4">
            <a href="<?= e($youtubeChannelUrl) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 !text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg hover:shadow-red-600/30 transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer" style="color: #ffffff !important;">
              <span class="material-symbols-outlined text-[22px] !text-white" style="color: #ffffff !important;">subscriptions</span>
              <span class="!text-white font-bold" style="color: #ffffff !important;"><?= e(ps_text('यूट्यूब चैनल सब्सक्राइब करें', 'Subscribe on YouTube')) ?></span>
              <span class="text-xs bg-white/20 !text-white px-2 py-0.5 rounded-full ml-1" style="color: #ffffff !important;">↗</span>
            </a>

            <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/15 px-5 py-3 rounded-2xl text-emerald-100 text-sm font-semibold">
              <span class="material-symbols-outlined text-amber-400 text-[22px]">video_library</span>
              <span style="color: #ecfdf5 !important;"><?= e(ps_text('कुल वीडियो: ' . $totalVideos, 'Total Videos: ' . $totalVideos)) ?></span>
            </div>
          </div>
        </div>

        <!-- Channel Highlight Card -->
        <a href="<?= e($youtubeChannelUrl) ?>" target="_blank" rel="noopener noreferrer" class="lg:col-span-4 bg-gradient-to-b from-white/10 to-white/5 p-6 sm:p-7 rounded-3xl border border-white/15 backdrop-blur-md shadow-2xl hover:border-amber-400/50 transition-all duration-300 group relative overflow-hidden">
          <div class="absolute -right-8 -top-8 w-32 h-32 bg-amber-400/10 rounded-full blur-2xl group-hover:bg-amber-400/20 transition-all"></div>
          
          <div class="flex items-center gap-4 mb-4">
            <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-tr from-amber-400 to-emerald-400 p-0.5 shadow-lg group-hover:scale-105 transition-transform">
              <div class="w-full h-full bg-emerald-950 rounded-[14px] flex items-center justify-center text-amber-300 font-bold text-2xl" style="color: #fcd34d !important;">
                प्र
              </div>
            </div>
            <div>
              <h3 class="text-lg font-bold !text-white group-hover:text-amber-300 transition-colors flex items-center gap-1.5" style="color: #ffffff !important;">
                <span><?= e(ps_text('प्रदीप सारंग YouTube', 'Pradeep Sarang YouTube')) ?></span>
                <span class="material-symbols-outlined text-[16px] text-amber-400">verified</span>
              </h3>
              <span class="text-xs text-emerald-200/70" style="color: #a7f3d0 !important;">@pradeepsarang223 • official channel</span>
            </div>
          </div>

          <p class="text-sm text-emerald-100/80 italic leading-relaxed border-t border-white/10 pt-3" style="color: #d1fae5 !important;">
            "माटी, पर्यावरण और अवधी संस्कृति का स्वर"
          </p>

          <div class="mt-4 flex items-center justify-between text-xs font-semibold text-amber-300 group-hover:translate-x-1 transition-transform" style="color: #fcd34d !important;">
            <span><?= e(ps_text('चैनल पर जाएं', 'Visit Channel')) ?></span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </div>
        </a>

      </div>
    </div>
  </section>

  <!-- ================= FEATURED SPOTLIGHT VIDEO (IF PAGE 1) ================= -->
  <?php if ($featuredVideo): 
    $fYtId = !empty($featuredVideo['youtube_id']) ? $featuredVideo['youtube_id'] : VideoModel::extractYoutubeId($featuredVideo['youtube_url'] ?? '');
    $fThumb = !empty($featuredVideo['thumbnail']) ? $featuredVideo['thumbnail'] : "https://img.youtube.com/vi/{$fYtId}/hqdefault.jpg";
    $fTitle = ps_decode_entities($featuredVideo['title'] ?? '');
    $fDesc = ps_decode_entities($featuredVideo['description'] ?? '');
    $fCat = $featuredVideo['category'] ?? 'जन-चौपाल';
    $fViews = number_format((int)($featuredVideo['views_count'] ?? 1500));
  ?>
    <section class="max-w-container-max mx-auto px-4 sm:px-8 -mt-8 relative z-20 w-full mb-8">
      <div class="bg-white rounded-3xl border border-emerald-900/10 shadow-xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 gap-0 group">
        
        <!-- Video Preview Side -->
        <div class="lg:col-span-7 relative aspect-video bg-black cursor-pointer overflow-hidden video-play-trigger" data-ytid="<?= e($fYtId) ?>" data-title="<?= e($fTitle) ?>">
          <img src="<?= e($fThumb) ?>" alt="<?= e($fTitle) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90 group-hover:opacity-100" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
          
          <span class="absolute top-4 left-4 bg-red-600 !text-white text-xs font-bold px-3 py-1 rounded-full shadow-md flex items-center gap-1.5" style="color: #ffffff !important;">
            <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
            <span><?= e(ps_text('प्रमुख वीडियो (Featured)', 'Featured Video')) ?></span>
          </span>

          <span class="absolute bottom-4 right-4 bg-black/80 !text-white font-mono text-xs font-bold px-2.5 py-1 rounded-lg border border-white/20" style="color: #ffffff !important;">
            <?= e($featuredVideo['duration'] ?? '05:30') ?>
          </span>

          <!-- Play Button Overlay -->
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-20 h-20 rounded-full bg-red-600/90 !text-white flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:bg-red-600 shadow-2xl border-4 border-white/40" style="color: #ffffff !important;">
              <span class="material-symbols-outlined text-[48px] ml-1 !text-white" style="color: #ffffff !important;">play_arrow</span>
            </div>
          </div>
        </div>

        <!-- Details Side -->
        <div class="lg:col-span-5 p-6 sm:p-8 flex flex-col justify-between space-y-4 bg-gradient-to-b from-white to-emerald-50/40">
          <div class="space-y-3">
            <div class="flex items-center gap-2">
              <span class="bg-emerald-100 text-emerald-900 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200">
                <?= e($fCat) ?>
              </span>
              <span class="text-xs text-gray-600 flex items-center gap-1">
                <span class="material-symbols-outlined text-[14px]">visibility</span>
                <span><?= e($fViews) ?> views</span>
              </span>
            </div>

            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 leading-snug group-hover:text-emerald-800 transition-colors line-clamp-3">
              <a href="javascript:void(0)" class="video-play-trigger text-gray-900 hover:text-emerald-800" data-ytid="<?= e($fYtId) ?>" data-title="<?= e($fTitle) ?>">
                <?= e($fTitle) ?>
              </a>
            </h2>

            <?php if (!empty($fDesc)): ?>
              <p class="text-gray-600 text-sm leading-relaxed line-clamp-4">
                <?= e($fDesc) ?>
              </p>
            <?php endif; ?>
          </div>

          <div class="pt-4 border-t border-emerald-900/10 flex items-center justify-between">
            <button type="button" class="inline-flex items-center gap-2 bg-emerald-900 hover:bg-emerald-800 !text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors cursor-pointer video-play-trigger shadow-md" style="color: #ffffff !important;" data-ytid="<?= e($fYtId) ?>" data-title="<?= e($fTitle) ?>">
              <span class="material-symbols-outlined text-[18px] !text-white" style="color: #ffffff !important;">play_circle</span>
              <span class="!text-white font-bold" style="color: #ffffff !important;"><?= e(ps_text('अभी देखें (Watch Now)', 'Watch Now')) ?></span>
            </button>

            <a href="<?= e("https://www.youtube.com/watch?v={$fYtId}") ?>" target="_blank" rel="noopener noreferrer" class="text-xs text-gray-600 hover:text-red-600 font-semibold flex items-center gap-1 transition-colors">
              <span><?= e(ps_text('यूट्यूब पर खोलें', 'Open in YouTube')) ?></span>
              <span class="material-symbols-outlined text-[14px]">open_in_new</span>
            </a>
          </div>
        </div>

      </div>
    </section>
  <?php endif; ?>

  <!-- ================= FILTER & SEARCH TOOLBAR ================= -->
  <section class="w-full bg-white/95 backdrop-blur-md border-y border-emerald-900/10 py-4 sticky top-[116px] z-30 shadow-sm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
      
      <!-- Filter Category Pills -->
      <div class="flex flex-wrap items-center gap-2">
        <?php foreach ($categories as $catKey => $catMeta): 
          $isActive = ($selectedCategory === $catKey);
          $catUrl = base_url('/videos' . ($catKey !== 'all' ? '?category=' . urlencode($catKey) : ''));
        ?>
          <a href="<?= e($catUrl) ?>" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer <?= $isActive ? 'bg-emerald-900 !text-white shadow-md shadow-emerald-900/20' : 'bg-gray-100 hover:bg-emerald-100 text-gray-700 hover:text-emerald-900' ?>" <?= $isActive ? 'style="color: #ffffff !important;"' : '' ?>>
            <span class="material-symbols-outlined text-[18px] <?= $isActive ? '!text-white' : '' ?>" <?= $isActive ? 'style="color: #ffffff !important;"' : '' ?>><?= e($catMeta['icon']) ?></span>
            <span class="<?= $isActive ? '!text-white' : '' ?>" <?= $isActive ? 'style="color: #ffffff !important;"' : '' ?>><?= e($catMeta['label']) ?></span>
          </a>
        <?php endforeach; ?>
      </div>

      <!-- Search Form -->
      <form action="<?= e(base_url('/videos')) ?>" method="GET" class="relative min-w-[280px]">
        <?php if ($selectedCategory !== 'all'): ?>
          <input type="hidden" name="category" value="<?= e($selectedCategory) ?>">
        <?php endif; ?>
        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
        <input type="text" name="q" value="<?= e($searchQuery) ?>" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-700 transition-all">
        <?php if (!empty($searchQuery)): ?>
          <a href="<?= e(base_url('/videos' . ($selectedCategory !== 'all' ? '?category=' . urlencode($selectedCategory) : ''))) ?>" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-700">
            <span class="material-symbols-outlined text-[18px]">close</span>
          </a>
        <?php endif; ?>
      </form>

    </div>
  </section>

  <!-- ================= VIDEOS GRID SECTION ================= -->
  <section class="w-full py-10 md:py-16 flex-grow">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">

      <!-- Result Filter Status Header -->
      <?php if (!empty($searchQuery) || $selectedCategory !== 'all'): ?>
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-200">
          <div class="text-sm text-gray-600">
            <span><?= e(ps_text('परिणाम:', 'Results:')) ?></span>
            <span class="font-bold text-gray-900"><?= $totalVideos ?> <?= e(ps_text('वीडियो प्राप्त हुए', 'videos found')) ?></span>
            <?php if ($selectedCategory !== 'all'): ?>
              <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-900 px-2.5 py-0.5 rounded-md ml-2 text-xs font-semibold">
                <?= e($selectedCategory) ?>
              </span>
            <?php endif; ?>
            <?php if (!empty($searchQuery)): ?>
              <span class="text-xs text-gray-500 ml-2">"<?= e($searchQuery) ?>"</span>
            <?php endif; ?>
          </div>
          <a href="<?= e(base_url('/videos')) ?>" class="text-emerald-800 hover:underline text-xs font-bold flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">refresh</span>
            <span><?= e(ps_text('फ़िल्टर हटाएं', 'Reset filters')) ?></span>
          </a>
        </div>
      <?php endif; ?>

      <?php if (!empty($gridVideos)): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          <?php foreach ($gridVideos as $vid): 
            $ytId = !empty($vid['youtube_id']) ? $vid['youtube_id'] : VideoModel::extractYoutubeId($vid['youtube_url'] ?? '');
            $thumb = !empty($vid['thumbnail']) ? $vid['thumbnail'] : "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
            $title = ps_decode_entities($vid['title'] ?? '');
            $desc = ps_decode_entities($vid['description'] ?? '');
            $cat = $vid['category'] ?? 'General';
            $duration = $vid['duration'] ?? '05:30';
            $views = number_format((int)($vid['views_count'] ?? 1200));
          ?>
            <article class="bg-white rounded-3xl border border-gray-200/80 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between group hover:-translate-y-1">
              
              <!-- Widescreen 16:9 Thumbnail -->
              <div class="relative w-full aspect-video overflow-hidden bg-black cursor-pointer video-play-trigger" data-ytid="<?= e($ytId) ?>" data-title="<?= e($title) ?>">
                <img src="<?= e($thumb) ?>" alt="<?= e($title) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90 group-hover:opacity-100" loading="lazy" />
                
                <!-- Dark Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                <!-- Animated Red YouTube Play Icon -->
                <div class="absolute inset-0 flex items-center justify-center">
                  <div class="w-14 h-14 rounded-full bg-red-600/90 group-hover:bg-red-600 !text-white flex items-center justify-center transition-all duration-300 group-hover:scale-110 shadow-xl border-2 border-white/50" style="color: #ffffff !important;">
                    <span class="material-symbols-outlined text-[34px] ml-1 !text-white" style="color: #ffffff !important;">play_arrow</span>
                  </div>
                </div>

                <!-- Duration Badge -->
                <span class="absolute bottom-3 right-3 bg-black/80 !text-white font-mono text-xs font-bold px-2 py-0.5 rounded-md border border-white/20 backdrop-blur-xs" style="color: #ffffff !important;">
                  <?= e($duration) ?>
                </span>

                <!-- Category Pill -->
                <span class="absolute top-3 left-3 bg-emerald-900/90 !text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full border border-white/20 backdrop-blur-xs" style="color: #ffffff !important;">
                  <?= e($cat) ?>
                </span>
              </div>

              <!-- Card Body -->
              <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                  <h3 class="text-base font-bold text-gray-900 leading-snug group-hover:text-emerald-800 transition-colors line-clamp-2">
                    <a href="javascript:void(0)" class="video-play-trigger text-gray-900 hover:text-emerald-800" data-ytid="<?= e($ytId) ?>" data-title="<?= e($title) ?>">
                      <?= e($title) ?>
                    </a>
                  </h3>
                  <?php if (!empty($desc)): ?>
                    <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">
                      <?= e($desc) ?>
                    </p>
                  <?php endif; ?>
                </div>

                <!-- Footer Info -->
                <div class="pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                  <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px] text-amber-500">visibility</span>
                    <span><?= e($views) ?> views</span>
                  </div>

                  <button type="button" class="inline-flex items-center gap-1.5 bg-emerald-800 hover:bg-emerald-900 !text-white px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all duration-200 video-play-trigger cursor-pointer shadow-xs" style="color: #ffffff !important;" data-ytid="<?= e($ytId) ?>" data-title="<?= e($title) ?>">
                    <span class="!text-white" style="color: #ffffff !important;"><?= e(ps_text('चलाएं', 'Play')) ?></span>
                    <span class="material-symbols-outlined text-[16px] !text-white" style="color: #ffffff !important;">play_circle</span>
                  </button>
                </div>
              </div>

            </article>
          <?php endforeach; ?>
        </div>

        <!-- ================= PAGINATION CONTROLS ================= -->
        <?php if ($totalPages > 1): ?>
          <div class="mt-14 pt-8 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs sm:text-sm text-gray-600 font-medium">
              <?= e(ps_text('पृष्ठ', 'Page')) ?> <span class="font-bold text-gray-900"><?= $currentPage ?></span> 
              <?= e(ps_text('का', 'of')) ?> <span class="font-bold text-gray-900"><?= $totalPages ?></span>
              (<span class="font-bold text-gray-900"><?= $totalVideos ?></span> <?= e(ps_text('कुल वीडियो', 'total videos')) ?>)
            </div>

            <nav aria-label="Videos Pagination" class="flex items-center gap-2">
              <!-- Previous Button -->
              <?php if ($currentPage > 1): 
                $prevUrl = base_url('/videos?page=' . ($currentPage - 1) . ($selectedCategory !== 'all' ? '&category=' . urlencode($selectedCategory) : '') . ($searchQuery ? '&q=' . urlencode($searchQuery) : ''));
              ?>
                <a href="<?= e($prevUrl) ?>" class="px-4 py-2 rounded-xl border border-gray-300 bg-white text-gray-800 hover:bg-emerald-50 hover:border-emerald-300 transition-colors flex items-center gap-1 text-xs font-bold cursor-pointer">
                  <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                  <span><?= e(ps_text('पिछला', 'Previous')) ?></span>
                </a>
              <?php else: ?>
                <span class="px-4 py-2 rounded-xl border border-gray-200 bg-gray-100 text-gray-400 opacity-60 flex items-center gap-1 text-xs font-bold cursor-not-allowed">
                  <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                  <span><?= e(ps_text('पिछला', 'Previous')) ?></span>
                </span>
              <?php endif; ?>

              <!-- Page Numbers -->
              <?php for ($p = 1; $p <= $totalPages; $p++): 
                $pUrl = base_url('/videos?page=' . $p . ($selectedCategory !== 'all' ? '&category=' . urlencode($selectedCategory) : '') . ($searchQuery ? '&q=' . urlencode($searchQuery) : ''));
                $isCurrent = ($p === $currentPage);
              ?>
                <a href="<?= e($pUrl) ?>" class="w-10 h-10 rounded-xl flex items-center justify-center text-xs font-bold transition-all cursor-pointer <?= $isCurrent ? 'bg-emerald-800 !text-white shadow-md shadow-emerald-900/20' : 'bg-white border border-gray-300 text-gray-800 hover:bg-emerald-50' ?>" <?= $isCurrent ? 'style="color: #ffffff !important;"' : '' ?>>
                  <span class="<?= $isCurrent ? '!text-white' : '' ?>" <?= $isCurrent ? 'style="color: #ffffff !important;"' : '' ?>><?= $p ?></span>
                </a>
              <?php endfor; ?>

              <!-- Next Button -->
              <?php if ($currentPage < $totalPages): 
                $nextUrl = base_url('/videos?page=' . ($currentPage + 1) . ($selectedCategory !== 'all' ? '&category=' . urlencode($selectedCategory) : '') . ($searchQuery ? '&q=' . urlencode($searchQuery) : ''));
              ?>
                <a href="<?= e($nextUrl) ?>" class="px-4 py-2 rounded-xl border border-gray-300 bg-white text-gray-800 hover:bg-emerald-50 hover:border-emerald-300 transition-colors flex items-center gap-1 text-xs font-bold cursor-pointer">
                  <span><?= e(ps_text('अगला', 'Next')) ?></span>
                  <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </a>
              <?php else: ?>
                <span class="px-4 py-2 rounded-xl border border-gray-200 bg-gray-100 text-gray-400 opacity-60 flex items-center gap-1 text-xs font-bold cursor-not-allowed">
                  <span><?= e(ps_text('अगला', 'Next')) ?></span>
                  <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </span>
              <?php endif; ?>
            </nav>
          </div>
        <?php endif; ?>

      <?php else: ?>
        <!-- Empty State -->
        <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center max-w-lg mx-auto my-12 space-y-4 shadow-sm">
          <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center mx-auto">
            <span class="material-symbols-outlined text-[36px]">video_library</span>
          </div>
          <h3 class="text-xl font-bold text-gray-900"><?= e(ps_text('कोई वीडियो प्राप्त नहीं हुआ', 'No videos found')) ?></h3>
          <p class="text-gray-500 text-sm"><?= e(ps_text('आपके द्वारा चुने गए फ़िल्टर या खोज शब्द के लिए कोई वीडियो उपलब्ध नहीं है।', 'No videos match your selected category or search query.')) ?></p>
          <a href="<?= e(base_url('/videos')) ?>" class="inline-flex items-center gap-2 bg-emerald-800 !text-white px-6 py-2.5 rounded-xl text-xs font-bold hover:bg-emerald-900 transition-colors" style="color: #ffffff !important;">
            <span class="material-symbols-outlined text-[16px] !text-white" style="color: #ffffff !important;">refresh</span>
            <span class="!text-white" style="color: #ffffff !important;"><?= e(ps_text('सभी वीडियो देखें', 'View All Videos')) ?></span>
          </a>
        </div>
      <?php endif; ?>

    </div>
  </section>

  <!-- CTA Strip -->
  <?php ps_cta(ps_text('वीडियो एवं यूट्यूब चैनल से जुड़ें','Stay connected with our Video Channel'), ps_text('नए कार्यक्रमों और संबोधनों के वीडियो की तुरंत सूचना हेतु चैनल सब्सक्राइब करें।','Subscribe to get instant updates on new speeches and cultural events.')); ?>

</div>

<!-- ================= YOUTUBE VIDEO POPUP MODAL (GLASSMORPHISM) ================= -->
<div id="video-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300">
  <div class="relative w-full max-w-4xl bg-black rounded-3xl overflow-hidden shadow-2xl border border-white/20 transform scale-95 transition-all duration-300" id="video-modal-card">
    
    <!-- Modal Header -->
    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-900 to-black border-b border-white/10 text-white">
      <div class="flex items-center gap-2.5 overflow-hidden pr-4">
        <span class="material-symbols-outlined text-red-500 text-[24px]">play_circle</span>
        <h4 class="text-sm sm:text-base font-bold truncate text-gray-100" id="video-modal-title">YouTube Video Player</h4>
      </div>
      <button type="button" class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors cursor-pointer" id="close-video-modal" title="Close">
        <span class="material-symbols-outlined text-[20px]">close</span>
      </button>
    </div>

    <!-- 16:9 Aspect Ratio iFrame Container -->
    <div class="relative w-full aspect-video bg-black">
      <iframe id="video-iframe" class="w-full h-full border-0" src="" title="YouTube Video Player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('video-modal');
  const modalCard = document.getElementById('video-modal-card');
  const iframe = document.getElementById('video-iframe');
  const modalTitle = document.getElementById('video-modal-title');
  const closeBtn = document.getElementById('close-video-modal');

  function openModal(ytId, title) {
    if (!ytId) return;
    iframe.src = `https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0`;
    modalTitle.textContent = title || 'YouTube Video Player';
    
    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100', 'pointer-events-auto');
    modalCard.classList.remove('scale-95');
    modalCard.classList.add('scale-100');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    iframe.src = '';
    modal.classList.remove('opacity-100', 'pointer-events-auto');
    modal.classList.add('opacity-0', 'pointer-events-none');
    modalCard.classList.remove('scale-100');
    modalCard.classList.add('scale-95');
    document.body.style.overflow = '';
  }

  document.querySelectorAll('.video-play-trigger').forEach(el => {
    el.addEventListener('click', (e) => {
      e.preventDefault();
      const ytId = el.getAttribute('data-ytid');
      const title = el.getAttribute('data-title');
      openModal(ytId, title);
    });
  });

  if (closeBtn) {
    closeBtn.addEventListener('click', closeModal);
  }

  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        closeModal();
      }
    });
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('opacity-100')) {
      closeModal();
    }
  });
});
</script>
