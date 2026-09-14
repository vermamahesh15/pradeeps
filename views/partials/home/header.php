<?php
declare(strict_types=1);
$currentLang = current_lang();
$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$currPath = current_path();
?><!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0YJRF6JN7F"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0YJRF6JN7F');
</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5149941446062796"
     crossorigin="anonymous"></script>
if (!isset($nav) || !is_array($nav)) {
    $nav = [
        ['/', ps_text('मुख्य पृष्ठ', 'Home')],
        ['/about', ps_text('परिचय', 'About')],
        [
            'label' => ps_text('अभियान व पहल', 'Campaigns'),
            'children' => [
                ['/campaigns', ps_text('सभी अभियान', 'All Campaigns')],
                ['/green-gang', ps_text('ग्रीन गैंग', 'Green Gang')],
                ['/volunteer', ps_text('स्वयंसेवक बनें', 'Join as Volunteer')]
            ]
        ],
        [
            'label' => ps_text('प्रभाव व यात्रा', 'Impact & Journey'),
            'children' => [
                ['/impact', ps_text('जनप्रभाव', 'Community Impact')],
                ['/journey', ps_text('सेवा यात्रा', 'Service Journey')],
                ['/awards', ps_text('सम्मान व पुरस्कार', 'Awards & Recognition')]
            ]
        ],
        [
            'label' => ps_text('गैलरी व मीडिया', 'Gallery & Media'),
            'children' => [
                ['/portfolio', ps_text('छायाचित्र दीर्घा', 'Photo Gallery')],
                ['/videos', ps_text('वीडियो दीर्घा', 'Video Gallery')],
                ['/media', ps_text('प्रेस व कतरनें', 'Press Coverage')]
            ]
        ],
        ['/salahkaar', ps_text('सलाहकार', 'Counsellor')],
        ['/events', ps_text('कार्यक्रम','Events')],
        ['/blog', ps_text('साहित्य व विचार', 'Literature & Writings')],
        ['/contact', ps_text('संपर्क','Contact')]
    ];
}
?>
<header class="fixed top-0 left-0 w-full z-[9999] shadow-[0_2px_12px_rgba(0,0,0,0.06)]">
    <!-- Top Utility Bar -->
    <div class="w-full bg-[#172033] text-[#FFFFFF] py-1.5 px-4 sm:px-8">
        <div class="max-w-container-max mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-6 font-label-sm text-label-sm text-[#E2E8F0]">
                <a class="flex items-center gap-1.5 hover:text-white transition-colors" href="tel:<?= e($phoneClean) ?>">
                    <span class="material-symbols-outlined text-[15px] text-[#B28A42]">call</span>
                    <span><?= e($phone) ?></span>
                </a>
                <span class="hidden sm:inline opacity-30">|</span>
                <a class="hidden sm:flex items-center gap-1.5 hover:text-white transition-colors" href="mailto:<?= e($email) ?>">
                    <span class="material-symbols-outlined text-[15px] text-[#B28A42]">mail</span>
                    <span><?= e($email) ?></span>
                </a>
            </div>
            <div class="flex items-center gap-3">
                <div class="inline-flex items-center gap-1.5 bg-[#15803D] text-white px-2.5 py-0.5 rounded-full font-label-sm text-label-sm font-semibold shadow-xs">
                    <span class="material-symbols-outlined text-[14px] text-[#86EFAC]">eco</span>
                    <span><?= e(ps_text('ग्रीन मॉर्निंग!', 'Green Morning!')) ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <div class="h-20 bg-[#FFFEFB] backdrop-blur-md px-4 sm:px-8 flex items-center border-b border-[#E5E7EB]">
        <div class="max-w-container-max mx-auto w-full flex items-center justify-between gap-4">
            <!-- Brand Identity: Logo Image Only -->
            <?php 
              $siteLogo = setting('logo', 'assets/images/logo.webp');
              $rootDir = dirname(__DIR__, 3);
              $hasLogo = !empty($siteLogo) && (file_exists($rootDir . '/' . ltrim($siteLogo, '/')) || preg_match('#^https?://#i', $siteLogo));
            ?>
            <a href="<?= e(base_url('/')) ?>" class="flex items-center group shrink-0 py-1" style="max-height: 64px;" title="<?= e(app_config('name', 'Pradeep Sarang')) ?>">
                <?php if ($hasLogo): ?>
                    <?= ps_responsive_img($siteLogo, app_config('name', 'Pradeep Sarang'), 'h-12 sm:h-14 md:h-16 w-auto object-contain transition-transform group-hover:scale-105', '(max-width: 640px) 180px, 240px', 'eager', ['style' => 'max-height: 56px; width: auto; max-width: 100%; object-fit: contain;']) ?>
                <?php else: ?>
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-[#14532D] text-white flex items-center justify-center shadow-xs border border-[#15803D]/40 group-hover:bg-[#0F3D21] transition-colors">
                            <span class="material-symbols-outlined text-[22px] text-[#86EFAC]" style="font-variation-settings: 'FILL' 1;">eco</span>
                        </div>
                        <span class="font-serif text-2xl font-bold text-[#14532D]">प्रदीप सारंग</span>
                    </div>
                <?php endif; ?>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden xl:flex items-center gap-1 2xl:gap-1.5 font-label-md text-label-md py-1">
                <?php foreach ($nav as $navItem): 
                    if (isset($navItem['children'])): 
                        $dropdownLabel = $navItem['label'];
                        $children = $navItem['children'];
                        $isParentActive = false;
                        foreach ($children as [$childUrl, $childLabel]) {
                            if (is_nav_item_active($childUrl, $currPath)) {
                                $isParentActive = true;
                                break;
                            }
                        }
                ?>
                    <div class="relative group">
                        <button type="button" 
                                class="px-2.5 py-1.5 rounded-lg whitespace-nowrap transition-all text-[13.5px] flex items-center gap-1 cursor-pointer <?= $isParentActive ? 'bg-[#14532D] text-white font-bold shadow-xs' : 'text-[#344054] hover:text-[#14532D] hover:bg-[#F3F5F1]' ?>">
                            <span><?= e($dropdownLabel) ?></span>
                            <span class="material-symbols-outlined text-[16px] text-[#667085] transition-transform duration-200 group-hover:rotate-180">expand_more</span>
                        </button>
                        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-64 z-[10000] animate-fadeIn">
                            <div class="bg-white rounded-xl border border-[#E5E7EB] shadow-2xl p-2 flex flex-col gap-1 nav-dropdown-panel" style="background-color: #ffffff !important; opacity: 1 !important; z-index: 10000 !important; position: relative;">
                                <?php foreach ($children as [$subUrl, $subLabel]): 
                                    $isSubActive = is_nav_item_active($subUrl, $currPath);
                                ?>
                                    <a href="<?= e(base_url($subUrl)) ?>" 
                                       class="px-3.5 py-2.5 rounded-lg text-[13.5px] font-semibold transition-colors flex items-center justify-between <?= $isSubActive ? 'bg-[#14532D] text-white font-bold shadow-xs' : 'text-[#172033] hover:text-[#14532D] hover:bg-[#F3F5F1]' ?>">
                                        <span><?= e($subLabel) ?></span>
                                        <span class="material-symbols-outlined text-[16px] opacity-60">chevron_right</span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php 
                    else: 
                        [$url, $label] = $navItem;
                        $isActive = is_nav_item_active($url, $currPath);
                        $isBlog = ($url === '/blog');
                ?>
                        <a href="<?= e(base_url($url)) ?>" 
                           class="px-2.5 py-1.5 rounded-lg whitespace-nowrap transition-all text-[13.5px] <?= $isActive ? 'bg-[#14532D] text-white font-bold shadow-xs' : 'text-[#344054] hover:text-[#14532D] hover:bg-[#F3F5F1]' ?>"
                           <?= $isActive ? 'aria-current="page"' : '' ?>>
                            <?php if ($isBlog): ?>
                                <span class="inline-flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[15px] <?= $isActive ? 'text-white' : 'text-[#C05632]' ?>">menu_book</span>
                                    <span><?= e($label) ?></span>
                                </span>
                            <?php else: ?>
                                <?= e($label) ?>
                            <?php endif; ?>
                        </a>
                <?php 
                    endif; 
                endforeach; 
                ?>
            </nav>

            <!-- Actions: Language Switcher, CTA, Admin, Mobile Toggle -->
            <div class="flex items-center gap-2.5 sm:gap-3.5">
                <div class="flex items-center bg-[#FFFFFF] border border-[#E5E7EB] rounded-full p-0.5 shadow-xs">
                    <a href="<?= e(base_url('/') . '?' . http_build_query(array_merge($_GET, ['lang' => 'hi']))) ?>" 
                       class="px-2.5 py-1 rounded-full <?= $currentLang === 'hi' ? 'bg-[#14532D] text-white font-bold' : 'text-[#172033] hover:text-[#C05632]' ?> font-label-sm text-label-sm transition-colors">
                        HI
                    </a>
                </div>

                <a class="hidden md:inline-flex items-center justify-center gap-1.5 bg-[#C05632] text-white hover:bg-[#A9472B] px-4 py-2 rounded-lg font-label-md text-label-md transition-colors whitespace-nowrap shadow-sm font-semibold" href="<?= e(base_url('/volunteer')) ?>">
                    <span class="material-symbols-outlined text-[17px]">handshake</span>
                    <span><?= e(ps_text('जुड़ें अभियान से', 'Join Movement')) ?></span>
                </a>

                <a href="<?= e(base_url('/admin')) ?>" title="<?= e(ps_text('प्रशासनिक पोर्टल', 'Admin Portal')) ?>" class="w-8 h-8 rounded-full bg-[#172033] hover:bg-[#14532D] transition-colors flex items-center justify-center shrink-0 shadow-xs">
                    <span class="material-symbols-outlined text-white text-[18px]">person</span>
                </a>

                <button id="ps-mobile-toggle" class="xl:hidden p-1.5 text-[#172033] hover:bg-[#F3F5F1] rounded-lg focus:outline-none" aria-label="Toggle navigation" type="button" onclick="document.getElementById('ps-mobile-menu-drawer').classList.toggle('hidden')">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div id="ps-mobile-menu-drawer" class="hidden xl:hidden bg-pure-white border-b border-border-warm shadow-2xl px-6 py-5 max-h-[75vh] overflow-y-auto z-[10000] relative" style="background-color: #ffffff !important; opacity: 1 !important;">
        <div class="flex flex-col space-y-3 font-label-md text-label-md">
            <?php foreach ($nav as $navItem): 
                if (isset($navItem['children'])): 
                    $dropdownLabel = $navItem['label'];
                    $children = $navItem['children'];
                    $isParentActive = false;
                    foreach ($children as [$childUrl, $childLabel]) {
                        if (is_nav_item_active($childUrl, $currPath)) {
                            $isParentActive = true;
                            break;
                        }
                    }
            ?>
                <details class="group py-1" <?= $isParentActive ? 'open' : '' ?>>
                    <summary class="flex items-center justify-between py-1.5 px-2 rounded-lg cursor-pointer transition-colors select-none <?= $isParentActive ? 'text-on-primary font-bold bg-primary-container' : 'text-on-surface hover:text-primary' ?>">
                        <span><?= e($dropdownLabel) ?></span>
                        <span class="material-symbols-outlined text-[18px] transition-transform duration-200 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="pl-3 mt-1.5 space-y-1 border-l-2 border-primary-container/20 ml-2">
                        <?php foreach ($children as [$subUrl, $subLabel]): 
                            $isSubActive = is_nav_item_active($subUrl, $currPath);
                        ?>
                            <a href="<?= e(base_url($subUrl)) ?>"
                               onclick="document.getElementById('ps-mobile-menu-drawer').classList.add('hidden')"
                               class="block py-1.5 px-3 rounded-lg text-sm transition-colors <?= $isSubActive ? 'text-on-primary font-bold bg-primary-container shadow-xs' : 'text-on-surface-variant hover:text-primary' ?>">
                                <?= e($subLabel) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </details>
            <?php 
                else: 
                    [$url, $label] = $navItem;
                    $isActive = is_nav_item_active($url, $currPath);
                    $isBlog = ($url === '/blog');
            ?>
                    <a href="<?= e(base_url($url)) ?>" 
                       onclick="document.getElementById('ps-mobile-menu-drawer').classList.add('hidden')"
                       class="py-1.5 px-2.5 rounded-lg font-medium transition-colors flex items-center gap-1.5 <?= $isActive ? 'text-on-primary font-bold bg-primary-container shadow-xs' : 'text-on-surface hover:text-primary' ?>">
                        <?php if ($isBlog): ?>
                            <span class="material-symbols-outlined text-[18px] <?= $isActive ? 'text-on-primary' : 'text-primary' ?>">menu_book</span>
                        <?php endif; ?>
                        <span><?= e($label) ?></span>
                    </a>
            <?php 
                endif; 
            endforeach; 
            ?>
            <div class="pt-3 border-t border-border-warm flex flex-col gap-2.5">
                <a class="inline-flex items-center justify-center bg-primary-container text-on-primary hover:bg-deep-forest px-4 py-2.5 rounded-lg font-label-md text-label-md transition-colors text-center" href="<?= e(base_url('/volunteer')) ?>">
                    <?= e(ps_text('जुड़ें अभियान से', 'Join Movement')) ?>
                </a>
            </div>
        </div>
    </div>
</header>
