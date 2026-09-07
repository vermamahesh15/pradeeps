<?php declare(strict_types=1); ps_page_hero(ps_text('जानकारी','INFORMATION'),$page['title']??$title); ?>
<section class="ps-section"><div class="ps-container"><div class="ps-article-body"><?= ps_rich_text($page['content']??'') ?></div></div></section>
