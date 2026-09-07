<?php
declare(strict_types=1);
$currentLang = current_lang();
$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$currPath = current_path();
?>
<header class="fixed top-0 left-0 w-full z-[9999] shadow-[0_2px_12px_rgba(0,0,0,0.06)]">
    <!-- Top Utility Bar -->
    <div class="w-full bg-deep-forest text-on-primary py-1.5 px-4 sm:px-8">
        <div class="max-w-container-max mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-6 font-label-sm text-label-sm text-surface-container-high">
                <a class="flex items-center gap-1.5 hover:text-on-primary transition-colors" href="tel:<?= e($phoneClean) ?>">
                    <span class="material-symbols-outlined text-[15px]">call</span>
                    <span><?= e($phone) ?></span>
                </a>
                <span class="hidden sm:inline opacity-30">|</span>
                <a class="hidden sm:flex items-center gap-1.5 hover:text-on-primary transition-colors" href="mailto:<?= e($email) ?>">
                    <span class="material-symbols-outlined text-[15px]">mail</span>
                    <span><?= e($email) ?></span>
                </a>
            </div>
            <div class="flex items-center gap-3">
                <div class="inline-flex items-center gap-1.5 bg-primary-container text-on-primary px-2.5 py-0.5 rounded-full font-label-sm text-label-sm">
                    <span class="material-symbols-outlined text-[14px] text-primary-fixed">eco</span>
                    <span><?= e(ps_text('ग्रीन मॉर्निंग!', 'Green Morning!')) ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <div class="h-20 bg-cream-canvas backdrop-blur-md px-4 sm:px-8 flex items-center border-b border-border-warm/80">
        <div class="max-w-container-max mx-auto w-full flex items-center justify-between gap-4">
            <!-- Brand Identity: Stylish Typography Mark -->
            <a href="<?= e(base_url('/')) ?>" class="flex items-center gap-2.5 group shrink-0 py-1">
                <div class="w-9 h-9 rounded-xl bg-deep-forest text-on-primary flex items-center justify-center shadow-xs border border-primary-fixed/20 group-hover:bg-primary transition-colors">
                    <span class="material-symbols-outlined text-[20px] text-fresh-sprout" style="font-variation-settings: 'FILL' 1;">eco</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-serif text-2xl sm:text-[26px] tracking-tight leading-none font-bold text-deep-forest" style="font-family: 'Playfair Display', 'Cinzel', serif;">
                        <span class="font-normal text-secondary/90 italic">pradeep</span> <span class="font-bold text-deep-forest">sarang</span>
                    </span>
                    <span class="font-label-sm text-[10.5px] text-text-muted tracking-widest uppercase font-semibold mt-1">
                        <?= e(ps_text('पर्यावरणविद् • लोकसेवक • साहित्यकार', 'Environmentalist • Social Worker')) ?>
                    </span>
                </div>
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
                                class="px-2.5 py-1.5 rounded-lg whitespace-nowrap transition-all text-[13.5px] flex items-center gap-1 cursor-pointer <?= $isParentActive ? 'bg-primary-container text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:text-deep-forest hover:bg-soft-meadow' ?>">
                            <span><?= e($dropdownLabel) ?></span>
                            <span class="material-symbols-outlined text-[16px] transition-transform duration-200 group-hover:rotate-180">expand_more</span>
                        </button>
                        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-64 z-[10000] animate-fadeIn">
                            <div class="bg-pure-white rounded-xl border border-border-warm shadow-2xl p-2 flex flex-col gap-1 nav-dropdown-panel" style="background-color: #ffffff !important; opacity: 1 !important; z-index: 10000 !important; position: relative;">
                                <?php foreach ($children as [$subUrl, $subLabel]): 
                                    $isSubActive = is_nav_item_active($subUrl, $currPath);
                                ?>
                                    <a href="<?= e(base_url($subUrl)) ?>" 
                                       class="px-3.5 py-2.5 rounded-lg text-[13.5px] font-semibold transition-colors flex items-center justify-between <?= $isSubActive ? 'bg-primary-container text-on-primary font-bold shadow-xs' : 'text-deep-forest hover:text-primary hover:bg-soft-meadow' ?>">
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
                           class="px-2.5 py-1.5 rounded-lg whitespace-nowrap transition-all text-[13.5px] <?= $isActive ? 'bg-primary-container text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:text-deep-forest hover:bg-soft-meadow' ?>"
                           <?= $isActive ? 'aria-current="page"' : '' ?>>
                            <?php if ($isBlog): ?>
                                <span class="inline-flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[15px] <?= $isActive ? 'text-on-primary' : 'text-primary' ?>">menu_book</span>
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
                <div class="flex items-center bg-surface-container rounded-full p-0.5">
                    <a href="<?= e(base_url('/') . '?' . http_build_query(array_merge($_GET, ['lang' => 'hi']))) ?>" 
                       class="px-2.5 py-1 rounded-full <?= $currentLang === 'hi' ? 'bg-primary-container text-on-primary font-bold' : 'text-on-surface-variant hover:text-on-surface' ?> font-label-sm text-label-sm transition-colors">
                        HI
                    </a>
                    <a href="<?= e(base_url('/') . '?' . http_build_query(array_merge($_GET, ['lang' => 'en']))) ?>" 
                       class="px-2.5 py-1 rounded-full <?= $currentLang === 'en' ? 'bg-primary-container text-on-primary font-bold' : 'text-on-surface-variant hover:text-on-surface' ?> font-label-sm text-label-sm transition-colors">
                        EN
                    </a>
                </div>

                <a class="hidden md:inline-flex items-center justify-center bg-primary-container text-on-primary hover:bg-deep-forest px-4 py-2 rounded-lg font-label-md text-label-md transition-colors whitespace-nowrap shadow-sm" href="<?= e(base_url('/volunteer')) ?>">
                    <?= e(ps_text('जुड़ें अभियान से', 'Join Movement')) ?>
                </a>

                <a href="<?= e(base_url('/admin')) ?>" title="<?= e(ps_text('प्रशासनिक पोर्टल', 'Admin Portal')) ?>" class="w-8 h-8 rounded-full bg-primary hover:bg-deep-forest transition-colors flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                </a>

                <button id="ps-mobile-toggle" class="xl:hidden p-1.5 text-deep-forest hover:bg-surface-container rounded-lg focus:outline-none" aria-label="Toggle navigation" type="button" onclick="document.getElementById('ps-mobile-menu-drawer').classList.toggle('hidden')">
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
