<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/ContentModel.php';
require_once __DIR__ . '/../models/Blog.php';
require_once __DIR__ . '/../models/BlogCategory.php';

class PageController
{
    private ContentModel $content;
    private Blog $blogModel;
    private BlogCategory $categoryModel;

    public function __construct(ContentModel $content, Blog $blogModel, BlogCategory $categoryModel)
    {
        $this->content = $content;
        $this->blogModel = $blogModel;
        $this->categoryModel = $categoryModel;
    }

    public function render(string $view, array $data = []): void
    {
        if ($view === '404' && http_response_code() === 200) {
            http_response_code(404);
        }
        $title = $data['title'] ?? app_config('name');
        $viewFile = __DIR__ . '/../views/pages/' . $view . '.php';

        if (!file_exists($viewFile)) {
            if (http_response_code() === 200) {
                http_response_code(404);
            }
            $viewFile = __DIR__ . '/../views/pages/404.php';
            $title = 'Page Not Found';
        }

        if (!isset($data['settings'])) {
            $data['settings'] = $this->content->getSettings();
        }

        if (!isset($data['shared'])) {
            $data['shared'] = [
                'campaigns' => $this->content->all('campaigns'),
                'events' => $this->content->all('events'),
                'blogs' => $this->blogModel->allPublished(4),
                'gallery' => $this->content->allGallery(12),
                'newspaper_cuttings' => $this->content->allNewspaperCuttings(12),
                'timeline' => $this->content->getTimeline(),
            ];
        }

        extract($data);
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function renderAmp(string $view, array $data = []): void
    {
        if ($view === '404') {
            http_response_code(404);
        }
        $title = $data['title'] ?? app_config('name');
        $viewFile = __DIR__ . '/../views/pages/' . $view . '.php';

        if (!file_exists($viewFile)) {
            $viewFile = __DIR__ . '/../views/pages/amp-page.php';
        }

        if (!isset($data['settings'])) {
            $data['settings'] = $this->content->getSettings();
        }

        extract($data);
        require __DIR__ . '/../views/layouts/amp.php';
    }

    public function home(): void
    {
        $this->render('home', [
            'title' => ps_text('मुख्य पृष्ठ', 'Home'),
            'page' => [
                'campaigns' => $this->content->all('campaigns'),
                'events' => $this->content->all('events'),
                'blogs' => $this->blogModel->allPublished(4),
                'gallery' => $this->content->allGallery(100),
                'newspaper_cuttings' => $this->content->allNewspaperCuttings(100),
                'timeline' => $this->content->getTimeline(),
            ],
        ]);
    }

    public function page(string $slug): void
    {
        // Ensure the slug is cleaned up for matching
        $slug = rtrim($slug, '/') ?: '/';

        $map = [
            '/about' => ['view' => 'about', 'title' => ps_text('परिचय', 'About Us')],
            '/campaigns' => ['view' => 'causes', 'title' => ps_text('प्रमुख अभियान', 'Campaigns'), 'items' => $this->content->all('campaigns')],
            '/events' => ['view' => 'events', 'title' => ps_text('कार्यक्रम', 'Events'), 'items' => $this->content->all('events')],
            '/portfolio' => ['view' => 'portfolio', 'title' => ps_text('छायाचित्र दीर्घा', 'Gallery'), 'items' => $this->content->allGallery(100)],
            '/media' => ['view' => 'media', 'title' => ps_text('प्रेस व कतरनें', 'Media Coverage'), 'items' => $this->content->allNewspaperCuttings(100)],
            '/awards' => ['view' => 'awards', 'title' => ps_text('सम्मान व पुरस्कार', 'Awards & Achievements'), 'items' => $this->content->getTimeline()],
            '/contact' => ['view' => 'contact', 'title' => ps_text('संपर्क', 'Contact')],
            '/volunteer' => ['view' => 'volunteer', 'title' => ps_text('स्वयंसेवक पंजीकरण', 'Volunteer Registration'), 'states' => $this->content->getStates()],
            '/donation' => ['view' => 'donation', 'title' => ps_text('सहयोग करें', 'Donate Now')],
        ];

        if ($slug === '/about') {
            $this->render('about', [
                'title' => ps_text('परिचय', 'About Us'),
                'timeline' => $this->content->getTimeline(),
                'personalPhotos' => $this->content->getPublishedPersonalPhotos()
            ]);
            return;
        }

        if ($slug === '/videos' || $slug === '/video-gallery' || $slug === '/youtube-videos') {
            require_once __DIR__ . '/../models/VideoModel.php';
            $videoModel = new VideoModel();
            $category = trim($_GET['category'] ?? '');
            $search = trim($_GET['q'] ?? '');
            $page = max(1, (int)($_GET['page'] ?? 1));
            $limit = 12;
            $offset = ($page - 1) * $limit;

            $videos = $videoModel->allActive($limit, $offset, $category, $search);
            $totalVideos = $videoModel->getTotalActiveCount($category, $search);
            $totalPages = max(1, (int)ceil($totalVideos / $limit));

            $this->render('videos', [
                'title' => ps_text('वीडियो दीर्घा', 'Video Gallery'),
                'videos' => $videos,
                'selectedCategory' => $category ?: 'all',
                'searchQuery' => $search,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'totalVideos' => $totalVideos,
                'limit' => $limit,
            ]);
            return;
        }

        if ($slug === '/blog' || $slug === '/blog-and-thoughts') {
            $items = $this->blogModel->allPublished(500);

            $this->render('blog', [
                'title' => ps_text('साहित्य व विचार', 'Blog'),
                'items' => $items,
                'categories' => $this->categoryModel->all(),
            ]);
            return;
        }

        if ($slug === '/donation' || $slug === '/donate' || $slug === '/donate-now') {
            $this->render('donate-now', [
                'title' => ps_text('सहयोग करें', 'Donate Now'),
                'donation_settings' => $this->content->getDonationSettings()
            ]);
            return;
        }

        if ($slug === '/journey' || $slug === '/timeline') {
            $this->render('journey', [
                'title' => ps_text('सेवा यात्रा', 'Service Journey'),
                'timeline' => $this->content->getTimeline()
            ]);
            return;
        }

        if ($slug === '/impact') {
            $this->render('impact', [
                'title' => ps_text('जनप्रभाव', 'Community Impact'),
                'campaigns' => $this->content->all('campaigns')
            ]);
            return;
        }

        if ($slug === '/green-gang' || $slug === '/greengang') {
            $this->render('green-gang', [
                'title' => ps_text('ग्रीन गैंग — जानकारी, नियम व निर्देश', 'Green Gang Movement'),
                'campaigns' => $this->content->all('campaigns')
            ]);
            return;
        }

        if ($slug === '/salahkaar' || $slug === '/counsellor' || $slug === '/counsellor-guidance') {
            $this->render('salahkaar', [
                'title' => ps_text('सलाहकार', 'Counsellor & Guidance')
            ]);
            return;
        }

        if ($slug === '/authors' || $slug === '/writers' || $slug === '/team') {
            require_once __DIR__ . '/../models/UserModel.php';
            $userModel = new UserModel();
            $roleFilter = trim($_GET['role'] ?? 'all');
            $search = trim($_GET['q'] ?? '');
            $page = max(1, (int)($_GET['page'] ?? 1));
            $limit = 6;
            $offset = ($page - 1) * $limit;

            $authors = $userModel->getPublicAuthors($roleFilter, $limit, $offset, $search);
            $totalAuthors = $userModel->getTotalPublicAuthorsCount($roleFilter, $search);
            $totalPages = max(1, (int)ceil($totalAuthors / $limit));

            $this->render('authors', [
                'title' => 'Authors & Thought Leaders (हमारे लेखक व विचारक)',
                'authors' => $authors,
                'currentRole' => $roleFilter,
                'searchQuery' => $search,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'totalAuthors' => $totalAuthors,
                'limit' => $limit,
            ]);
            return;
        }

        if ($slug === '/cookie-policy' || $slug === '/cookies') {
            $this->render('cookie-policy', [
                'title' => 'कुकी नीति (Cookie Policy)'
            ]);
            return;
        }

        if ($slug === '/disclaimer') {
            $this->render('disclaimer', [
                'title' => 'अस्वीकरण (Disclaimer)'
            ]);
            return;
        }

        if ($slug === '/editorial-policy') {
            $this->render('editorial-policy', [
                'title' => 'संपादकीय नीति (Editorial Policy)'
            ]);
            return;
        }

        if ($slug === '/author-guidelines') {
            $this->render('author-guidelines', [
                'title' => 'लेखक दिशा-निर्देश (Author Guidelines)'
            ]);
            return;
        }

        if ($slug === '/privacy-policy' || $slug === '/privacy') {
            $this->render('privacy-policy', [
                'title' => 'गोपनीयता नीति (Privacy Policy)'
            ]);
            return;
        }

        if ($slug === '/terms-and-conditions' || $slug === '/terms' || $slug === '/terms-of-service') {
            $this->render('terms-and-conditions', [
                'title' => 'नियम एवं शर्तें (Terms & Conditions)'
            ]);
            return;
        }

        $config = $map[$slug] ?? null;
        if ($config === null) {
            // Check database for dynamic pages
            $dbSlug = ltrim($slug, '/');
            $page = $this->content->findPageBySlug($dbSlug);
            
            if ($page) {
                $this->render('page-template', [
                    'title' => $page['title'],
                    'page' => $page
                ]);
                return;
            }
            $this->render('404');
            return;
        }

        $this->render($config['view'], $config);
    }

    public function blogDetail(string $slug): void
    {
        // 1. Gather all approved published articles from database
        $allArticles = $this->blogModel->allPublished(500);

        // 2. Resolve current requested article
        $slugClean = trim(strtolower($slug));
        $currentIndex = -1;

        // Direct slug match
        foreach ($allArticles as $idx => $art) {
            if (strtolower(trim($art['slug'] ?? '')) === $slugClean) {
                $currentIndex = $idx;
                break;
            }
        }

        // Aliases match if not found
        if ($currentIndex === -1) {
            $aliasMap = [
                'sughari' => 'sughagri',
                'jharihakh' => 'jharihakh',
            ];
            $targetSlug = $aliasMap[$slugClean] ?? '';
            if ($targetSlug !== '') {
                foreach ($allArticles as $idx => $art) {
                    if (strtolower(trim($art['slug'] ?? '')) === $targetSlug) {
                        $currentIndex = $idx;
                        break;
                    }
                }
            }
        }

        // Check if individual published DB post exists
        if ($currentIndex === -1) {
            $individualPost = $this->blogModel->findBySlug($slug, true);
            if ($individualPost !== null) {
                array_unshift($allArticles, $individualPost);
                $currentIndex = 0;
            }
        }

        if ($currentIndex === -1) {
            $this->render('404');
            return;
        }

        $post = $allArticles[$currentIndex];
        $totalArticles = count($allArticles);
        $prevArticle = $currentIndex > 0 ? $allArticles[$currentIndex - 1] : null;
        $nextArticle = $currentIndex < $totalArticles - 1 ? $allArticles[$currentIndex + 1] : null;

        $related = array_values(array_filter($allArticles, fn ($blog) => ($blog['slug'] ?? '') !== ($post['slug'] ?? '')));

        $this->render('blog-detail', [
            'title' => $post['title'],
            'post' => $post,
            'allArticles' => $allArticles,
            'currentIndex' => $currentIndex,
            'totalArticles' => $totalArticles,
            'prevArticle' => $prevArticle,
            'nextArticle' => $nextArticle,
            'related' => array_slice($related, 0, 3),
        ]);
    }

    public function ampBlogDetail(string $slug): void
    {
        $allArticles = $this->blogModel->allPublished(500);

        $slugClean = trim(strtolower($slug));
        $currentIndex = -1;
        foreach ($allArticles as $idx => $art) {
            if (strtolower(trim($art['slug'] ?? '')) === $slugClean) {
                $currentIndex = $idx;
                break;
            }
        }

        if ($currentIndex === -1) {
            $aliasMap = [
                'sughari' => 'sughagri',
                'jharihakh' => 'jharihakh',
            ];
            $targetSlug = $aliasMap[$slugClean] ?? '';
            if ($targetSlug !== '') {
                foreach ($allArticles as $idx => $art) {
                    if (strtolower(trim($art['slug'] ?? '')) === $targetSlug) {
                        $currentIndex = $idx;
                        break;
                    }
                }
            }
        }

        if ($currentIndex === -1) {
            $individualPost = $this->blogModel->findBySlug($slug, true);
            if ($individualPost !== null) {
                array_unshift($allArticles, $individualPost);
                $currentIndex = 0;
            }
        }

        if ($currentIndex === -1) {
            $this->renderAmp('amp-page', ['title' => 'Article Not Found', 'canonicalUrl' => base_url('/blog/' . $slug)]);
            return;
        }

        $post = $allArticles[$currentIndex];
        $totalArticles = count($allArticles);
        $related = array_values(array_filter($allArticles, fn ($blog) => ($blog['slug'] ?? '') !== ($post['slug'] ?? '')));

        $this->renderAmp('amp-blog-detail', [
            'title' => $post['title'],
            'post' => $post,
            'canonicalUrl' => base_url('/blog/' . $post['slug']),
            'related' => array_slice($related, 0, 3),
        ]);
    }

    public function ampPage(string $slug): void
    {
        $cleanSlug = '/' . trim(preg_replace('#(^/amp/|/amp$)#i', '', '/' . ltrim($slug, '/')), '/');
        $canonical = base_url($cleanSlug);

        // 1. About
        if ($cleanSlug === '/about' || $cleanSlug === '/parichay') {
            $this->renderAmp('amp-page', [
                'title' => 'परिचय (About Shri Pradeep Sarang)',
                'subtitle' => 'पर्यावरणविद् • लोकसेवक • अवधी साहित्यकार',
                'canonicalUrl' => $canonical,
                'content' => '
                    <p>श्री प्रदीप सारंग उत्तर प्रदेश के एक प्रतिष्ठित पर्यावरणविद्, सामाजिक कार्यकर्ता एवं अवधी भाषा व संस्कृति के समर्पित साधक हैं। इन्होंने प्रकृति संरक्षण, ग्रामीण सशक्तिकरण और अवधी साहित्य के पुनरुद्धार में अपना जीवन समर्पित किया है।</p>
                    <h2>हरियाली और पर्यावरण संरक्षण</h2>
                    <p>\'ग्रीन गैंग\' एवं \'ग्रीन मॉर्निंग\' अभियानों के माध्यम से 50,000 से अधिक फलदार व छायादार वृक्षों का रोपण तथा जन-जागरूकता कार्यक्रमों का संचालन किया गया है।</p>
                    <h2>अवधी साहित्य एवं सांस्कृतिक अवदान</h2>
                    <p>अवधी लोकभाषा, लोकगीतों, मुहावरों और ग्रामीण जनजीवन की अमूल्य स्मृतियों को लिपिबद्ध कर आधुनिक पीढ़ी तक पहुँचाने का अविस्मरणीय कार्य कर रहे हैं। \'झरिहख\' और \'सुघरी\' जैसी भावपूर्ण रचनाएं साहित्य जगत में विशेष स्थान रखती हैं।</p>
                ',
                'items' => [
                    [
                        'title' => '50,000+ वृक्षारोपण अभियान',
                        'description' => 'ग्रामीण क्षेत्रों एवं विद्यालयों में छायादार व फलदार पौधों का रोपण व संरक्षण।',
                        'image' => 'assets/images/about/photo-1.jpg',
                    ],
                    [
                        'title' => 'अवधी भाषा व साहित्य सेवा',
                        'description' => 'विलुप्त होते अवधी शब्दों, लोककथाओं और ग्रामीण संवेदनाओं का प्रामाणिक दस्तावेजीकरण।',
                        'image' => 'assets/images/about/photo-2.jpg',
                    ]
                ]
            ]);
            return;
        }

        // 2. Campaigns
        if ($cleanSlug === '/campaigns' || $cleanSlug === '/causes') {
            $campaigns = $this->content->all('campaigns');
            $items = array_map(function ($c) {
                return [
                    'title' => $c['title'] ?? '',
                    'description' => $c['short_description'] ?? $c['description'] ?? '',
                    'image' => $c['banner_image'] ?? $c['image'] ?? '',
                    'url' => base_url('/campaigns/' . ($c['slug'] ?? '') . '/amp'),
                ];
            }, $campaigns);

            $this->renderAmp('amp-page', [
                'title' => 'प्रमुख जन-अभियान (Key Campaigns)',
                'subtitle' => 'प्रकृति संरक्षण, सामाजिक सुधार एवं जनचेतना की मुहिम',
                'canonicalUrl' => $canonical,
                'content' => '<p>श्री प्रदीप सारंग के नेतृत्व में समाज के सर्वांगीण विकास, प्रकृति संतुलन और मानवीय संवेदनाओं के विस्तार हेतु चलाए जा रहे प्रमुख अभियान:</p>',
                'items' => $items,
            ]);
            return;
        }

        // 3. Green Gang
        if ($cleanSlug === '/green-gang' || $cleanSlug === '/greengang') {
            $campaigns = $this->content->all('campaigns');
            $this->renderAmp('amp-page', [
                'title' => 'ग्रीन गैंग आंदोलन (Green Gang Movement)',
                'subtitle' => 'हरियाली, प्रकृति प्रेम और जन-भागीदारी का महा-अभियान',
                'canonicalUrl' => $canonical,
                'content' => '
                    <p><strong>ग्रीन गैंग</strong> समाज के उत्साही युवाओं, महिलाओं और नागरिकों का एक संगठित स्वयंसेवी समूह है, जिसका मुख्य उद्देश्य पर्यावरण की रक्षा, सघन पौधरोपण और प्रकृति संवर्धन है।</p>
                    <h2>मुख्य उपलब्धियां एवं उद्देश्य:</h2>
                    <p>• <strong>50,000+ वृक्षारोपण:</strong> सड़क किनारों, विद्यालयों, ग्राम पंचायतों एवं सार्वजनिक स्थलों पर बड़े पैमाने पर पौधरोपण व संरक्षण।</p>
                    <p>• <strong>ग्रीन मॉर्निंग मुहिम:</strong> प्रातःकालीन भ्रमण के साथ पर्यावरण संरक्षण, स्वच्छता और स्वास्थ्य जागरूकता का संदेश।</p>
                    <p>• <strong>जल संरक्षण एवं प्लास्टिक मुक्ति:</strong> स्थानीय स्तर पर जल स्रोतों की स्वच्छता और एकल-उपयोग प्लास्टिक पर रोकथाम हेतु जनजागरण।</p>
                    <p>यदि आप भी इस हरित क्रांति का हिस्सा बनना चाहते हैं, तो स्वयंसेवक के रूप में हमसे जुड़ें।</p>
                ',
                'items' => array_map(function ($c) {
                    return [
                        'title' => $c['title'] ?? '',
                        'description' => $c['short_description'] ?? $c['description'] ?? '',
                        'image' => $c['banner_image'] ?? $c['image'] ?? '',
                        'url' => base_url('/campaigns/' . ($c['slug'] ?? '') . '/amp'),
                    ];
                }, $campaigns),
            ]);
            return;
        }

        // 4. Events
        if ($cleanSlug === '/events') {
            $events = $this->content->all('events');
            $items = array_map(function ($ev) {
                return [
                    'title' => $ev['title'] ?? '',
                    'date' => !empty($ev['event_date']) ? 'आयोजन तिथि: ' . date('d M Y', strtotime($ev['event_date'])) : '',
                    'description' => $ev['short_description'] ?? $ev['description'] ?? '',
                    'image' => $ev['banner_image'] ?? $ev['image'] ?? '',
                    'url' => base_url('/events/' . ($ev['slug'] ?? '') . '/amp'),
                ];
            }, $events);

            $this->renderAmp('amp-page', [
                'title' => 'कार्यक्रम व गतिविधियाँ (Events & Activities)',
                'subtitle' => 'जनसंपर्क, पर्यावरण संगोष्ठी एवं सामाजिक सम्मेलन',
                'canonicalUrl' => $canonical,
                'content' => '<p>पर्यावरण संरक्षण, अवधी विचार गोष्ठियों और सामाजिक कल्याण से जुड़े सार्वजनिक आयोजनों की सूची:</p>',
                'items' => $items,
            ]);
            return;
        }

        // 5. Blog / Thoughts
        if ($cleanSlug === '/blog' || $cleanSlug === '/blog-and-thoughts') {
            $blogs = $this->blogModel->allPublished(25);
            $items = array_map(function ($b) {
                return [
                    'title' => $b['title'] ?? '',
                    'date' => 'लेखक: ' . ($b['author'] ?: 'श्री प्रदीप सारंग') . ' • ' . (!empty($b['published_at']) ? date('d M Y', strtotime($b['published_at'])) : ''),
                    'description' => $b['excerpt'] ?: ps_excerpt($b['content'] ?? '', 140),
                    'image' => $b['featured_image'] ?? $b['banner_image'] ?? $b['image'] ?? '',
                    'url' => base_url('/blog/' . ($b['slug'] ?? '') . '/amp'),
                ];
            }, $blogs);

            $this->renderAmp('amp-page', [
                'title' => 'साहित्य व विचार (Literature & Thoughts)',
                'subtitle' => 'अवधी रचनाएं, पर्यावरण विचार एवं सामाजिक दृष्टिकोण',
                'canonicalUrl' => $canonical,
                'content' => '<p>श्री प्रदीप सारंग एवं अन्य प्रबुद्ध विचारकों द्वारा लिखित उत्कृष्ट आलेख, संस्मरण और विचार:</p>',
                'items' => $items,
            ]);
            return;
        }

        // 6. Contact
        if ($cleanSlug === '/contact') {
            $this->renderAmp('amp-page', [
                'title' => 'संपर्क करें (Contact Shri Pradeep Sarang)',
                'subtitle' => 'कार्यालय, संवाद एवं स्वयंसेवक सहयोग',
                'canonicalUrl' => $canonical,
                'content' => '
                    <p>पर्यावरण संरक्षण मुहिम, अवधी साहित्य परिचर्चा अथवा सामाजिक कार्यों में सहभागिता के लिए संपर्क करें:</p>
                    <h2>कार्यालय पता (Office Address):</h2>
                    <p>ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत</p>
                    <h2>फोन व संवाद (Phone & Inquiries):</h2>
                    <p><a href="tel:+919919007190" style="color:var(--primary); font-weight:bold;">+91 9919007190</a></p>
                    <h2>ईमेल (Email):</h2>
                    <p><a href="mailto:contact@pradeepsarang.in" style="color:var(--primary); font-weight:bold;">contact@pradeepsarang.in</a></p>
                    <h2>सोशल मीडिया व संदेश:</h2>
                    <p>फेसबुक, यूट्यूब एवं डिजिटल माध्यमों पर हमारे साथ जुड़ें और हरित संदेश को जन-जन तक पहुँचाएँ।</p>
                ',
            ]);
            return;
        }

        // 7. Privacy Policy
        if ($cleanSlug === '/privacy-policy' || $cleanSlug === '/privacy') {
            $this->renderAmp('amp-page', [
                'title' => 'गोपनीयता नीति (Privacy Policy)',
                'subtitle' => 'डेटा सुरक्षा एवं निजता अधिकार',
                'canonicalUrl' => $canonical,
                'content' => '
                    <p>हम आपकी निजता का पूर्ण सम्मान करते हैं। यह नीति स्पष्ट करती है कि वेबसाइट पर पाठकों, लेखकों, स्वयंसेवकों और उपयोगकर्ताओं के व्यक्तिगत विवरण का संग्रहण, उपयोग और सुरक्षा किस प्रकार की जाती है।</p>
                    <h2>1. एकत्र की जाने वाली जानकारी</h2>
                    <p>जब आप संपर्क फॉर्म या स्वयंसेवक पंजीकरण भरते हैं, तो हम आपका नाम, ईमेल, फोन नंबर और संदेश सुरक्षित रूप से प्राप्त करते हैं।</p>
                    <h2>2. सूचना का उपयोग</h2>
                    <p>आपकी जानकारी का उपयोग केवल आपके प्रश्नों के उत्तर देने, अभियानों की सूचना देने और वेबसाइट अनुभव को बेहतर बनाने हेतु किया जाता है। हम किसी भी तीसरे पक्ष को आपकी व्यक्तिगत जानकारी विक्रय नहीं करते।</p>
                    <h2>3. संपर्क सूत्र</h2>
                    <p>निजता संबंधी किसी भी प्रश्न के लिए <strong>contact@pradeepsarang.in</strong> पर संपर्क कर सकते हैं।</p>
                ',
            ]);
            return;
        }

        // 8. Terms and Conditions
        if ($cleanSlug === '/terms-and-conditions' || $cleanSlug === '/terms' || $cleanSlug === '/terms-of-service') {
            $this->renderAmp('amp-page', [
                'title' => 'नियम एवं शर्तें (Terms & Conditions)',
                'subtitle' => 'वेबसाइट उपयोग की शर्तें',
                'canonicalUrl' => $canonical,
                'content' => '
                    <p>प्रदीप सारंग की आधिकारिक वेबसाइट का उपयोग करने पर आप इन शर्तों के प्रति अपनी सहमति व्यक्त करते हैं।</p>
                    <h2>1. बौद्धिक संपदा अधिकार</h2>
                    <p>इस वेबसाइट पर प्रकाशित समस्त सामग्री, साहित्य, आलेख, फोटोग्राफ एवं डिजाइन सुरक्षित हैं। उचित श्रेय के बिना इनका व्यावसायिक उपयोग वर्जित है।</p>
                    <h2>2. वेबसाइट का उपयोग</h2>
                    <p>उपयोगकर्ता वेबसाइट का उपयोग केवल वैध, सकारात्मक और रचनात्मक उद्देश्यों के लिए करेंगे।</p>
                ',
            ]);
            return;
        }

        // 9. Disclaimer
        if ($cleanSlug === '/disclaimer') {
            $this->renderAmp('amp-page', [
                'title' => 'अस्वीकरण (Disclaimer)',
                'subtitle' => 'सामान्य सूचना एवं विचार अभिव्यक्ति',
                'canonicalUrl' => $canonical,
                'content' => '
                    <p>इस वेबसाइट पर प्रस्तुत सभी विचार, आलेख और सूचनाएं जनकल्याण, पर्यावरण चेतना और अवधी साहित्य के संवर्धन के उद्देश्य से साझा की गई हैं।</p>
                    <p>यद्यपि समस्त जानकारी की शुद्धता बनाए रखने का पूरा प्रयास किया गया है, तथापि पाठकों से अनुरोध है कि किसी भी व्यावहारिक क्रियान्वयन से पूर्व स्वतंत्र रूप से पुष्टि कर लें।</p>
                ',
            ]);
            return;
        }

        // 10. Single Campaign detail AMP (/campaigns/{slug}/amp)
        if (preg_match('#^/campaigns/(.+)$#', $cleanSlug, $m)) {
            $cSlug = $m[1];
            $item = $this->content->findBySlug('campaigns', $cSlug);
            if ($item !== null) {
                $this->renderAmp('amp-page', [
                    'title' => $item['title'] ?? 'अभियान',
                    'subtitle' => 'जन-अभियान विवरण',
                    'canonicalUrl' => $canonical,
                    'content' => '
                        ' . (!empty($item['banner_image']) ? '<img src="' . htmlspecialchars($item['banner_image']) . '" width="800" height="450" alt="' . htmlspecialchars($item['title'] ?? '') . '">' : '') . '
                        <p>' . nl2br(htmlspecialchars($item['short_description'] ?? '')) . '</p>
                        ' . ($item['content'] ?? $item['description'] ?? '') . '
                    ',
                ]);
                return;
            }
        }

        // 11. Single Event detail AMP (/events/{slug}/amp)
        if (preg_match('#^/events/(.+)$#', $cleanSlug, $m)) {
            $eSlug = $m[1];
            $item = $this->content->findBySlug('events', $eSlug);
            if ($item !== null) {
                $this->renderAmp('amp-page', [
                    'title' => $item['title'] ?? 'कार्यक्रम',
                    'subtitle' => !empty($item['event_date']) ? 'दिनांक: ' . date('d M Y', strtotime($item['event_date'])) : '',
                    'canonicalUrl' => $canonical,
                    'content' => '
                        ' . (!empty($item['banner_image']) ? '<img src="' . htmlspecialchars($item['banner_image']) . '" width="800" height="450" alt="' . htmlspecialchars($item['title'] ?? '') . '">' : '') . '
                        <p>' . nl2br(htmlspecialchars($item['short_description'] ?? '')) . '</p>
                        ' . ($item['content'] ?? $item['description'] ?? '') . '
                    ',
                ]);
                return;
            }
        }

        // 12. Check dynamic pages in DB
        $dbSlug = ltrim($cleanSlug, '/');
        $page = $this->content->findPageBySlug($dbSlug);
        if ($page) {
            $this->renderAmp('amp-page', [
                'title' => $page['title'],
                'canonicalUrl' => $canonical,
                'content' => $page['content'] ?? '',
            ]);
            return;
        }

        // 13. Fallback: Not Found
        http_response_code(404);
        $this->renderAmp('amp-page', [
            'title' => 'Page Not Found',
            'canonicalUrl' => base_url('/'),
            'content' => '<p>' . htmlspecialchars(ps_text('यह पृष्ठ उपलब्ध नहीं है।', 'The requested page was not found.')) . '</p>',
        ]);
    }

    public function campaignDetail(string $slug): void
    {
        $slugLower = strtolower($slug);
        $item = $this->content->findBySlug('campaigns', $slug);
        
        $allCampaigns = $this->content->all('campaigns');

        if ($item === null && !empty($allCampaigns)) {
            foreach ($allCampaigns as $c) {
                $cSlug = strtolower($c['slug'] ?? '');
                $cTitle = strtolower($c['title'] ?? '');
                if ($cSlug === $slugLower || str_contains($cSlug, $slugLower) || str_contains($slugLower, $cSlug)) {
                    $item = $c;
                    break;
                }
            }
        }

        // Smart static lookup by keyword if not found in DB
        if ($item === null) {
            if (str_contains($slugLower, 'hariyali') || str_contains($slugLower, 'green')) {
                $item = [
                    'title' => 'हरियाली-अभियान (\'ग्रीन गैंग\' एवं \'ग्रीन मॉर्निंग\')',
                    'slug' => $slug,
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db',
                    'excerpt' => 'धरती पर हरियाली बढ़ाने तथा जन-जन की जीवनशैली में प्रकृति प्रेम को शामिल कराने के उद्देश्य से स्थापित 50,000+ वृक्षारोपण की सजीव मुहिम।',
                    'content' => '<p>5 जून 2019 से निरंतर गतिशील हरियाली अभियान के अंतर्गत जनपद बाराबंकी एवं उत्तर प्रदेश के विभिन्न अंचलों में 50,000 से अधिक बरगद, पीपल, नीम और पाकड़ के वृक्षों का रोपण किया जा चुका है। \'ग्रीन मॉर्निंग\' अभिवादन का संस्कार ग्रामीण जन-जीवन का अभिन्न अंग बन चुका है।</p><p>प्रत्येक प्रातः ग्राम चौपालों और विद्यालयों में \'गुड मॉर्निंग\' के स्थान पर \'ग्रीन मॉर्निंग\' बोलने की परंपरा ने पर्यावरण संवर्धन को दैनिक जीवन की आदत बना दिया है।</p>',
                ];
            } elseif (str_contains($slugLower, 'parinda') || str_contains($slugLower, 'bird')) {
                $item = [
                    'title' => 'परिंदा एवं वन्यजीव संरक्षण अभियान',
                    'slug' => $slug,
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIdMQwsnVo2dk4ut7g6q_cAP6eTxbCJ79UEWEL6LMYJP9Bzoa711KY0DUcQDKRXxuQ_6LQhxi0vQ2STd8MG_7M8PMwLDKDbl4rkN0NWnrSqVTvaAamPZA23ot4DWOtvh7QMTvSKjQWd4KHteII-UyAePIVzkOU6Kjt18WGSoV63V45Zxnm-uJxCWTIYBFdLiZQTIIpMJ2BicU3nJOrp9TW5wTXMOaNdUj57zI1cu2Z0PJgk4oP02r7',
                    'excerpt' => 'भीषण ग्रीष्म ऋतु में बेज़ुबान पक्षियों के जीवन की रक्षा हेतु 10,000+ मिट्टी के सकोरे व दाना-पानी वितरण अभियान।',
                    'content' => '<p>भीषण ग्रीष्म ऋतु में पक्षियों के जीवन की रक्षा हेतु 10,000+ मिट्टी के सकोरे व दाना-पानी वितरण अभियान। 2016 में माननीय वन मंत्री, उ.प्र. शासन द्वारा वन्य जीव संरक्षण विशिष्ट प्रशस्ति पत्र से अलंकृत।</p><p>ग्रामीण अंचलों में छतों, आंगन और सार्वजनिक स्थानों पर पक्षी-जलपात्र स्थापित कर गौरैया एवं अन्य स्थानीय पक्षियों की प्रजातियों के संरक्षण का संकल्प लिया गया है।</p>',
                ];
            } elseif (str_contains($slugLower, 'tulsi')) {
                $item = [
                    'title' => 'तुलसी जयंती पखवारा (16 से 31 अगस्त)',
                    'slug' => $slug,
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNOtpSZS1SiMog6MZDa71DZSMfh6EnAA77Ymmt7zKpBOaoF2T1kWglq8Y53Zsa7euU3rS45qwNdtPbOCAvU8DxMXXSuSW8gAKL7TrAh3UL63gGDIxTMAgC3LukNGRs-_8I2A4TvGb7cVawrjP4eHZn4vCttQfvJgSJxC3lGfMoqJThtsk31BlhWfn-Tl3NqXbIas9Z_rC1JGQtFVyUukAuxzurqbr99QVnyPNLwWoq03MVbPtd27MK',
                    'excerpt' => 'संस्कृति, लोक-चेतना व मानस दर्शन हेतु प्रतिवर्ष 16 से 31 अगस्त तक आयोजित तुलसी जयंती पखवारा।',
                    'content' => '<p>प्रतिवर्ष 16 से 31 अगस्त तक आयोजित तुलसी जयंती पखवारा के अंतर्गत श्रीरामचरितमानस के अवधी आध्यात्मिक दर्शन, संत तुलसीदास की लोक-साहित्य परंपरा और युवाओं में नैतिक मूल्यों के संवर्धन हेतु गोष्ठियाँ व काव्य-सत्र आयोजित किए जाते हैं।</p>',
                ];
            } elseif (str_contains($slugLower, 'awadhi') || str_contains($slugLower, 'avadhi') || str_contains($slugLower, 'language')) {
                $item = [
                    'title' => 'अवधी भाषा, साहित्य व लोक-संस्कृति संवर्धन',
                    'slug' => $slug,
                    'image' => 'https://picsum.photos/seed/cause-two/900/700',
                    'excerpt' => 'अवधी भाषा की समृद्ध सांस्कृतिक विरासत के संरक्षण, \'झरिहख\' संस्मरण संकलन एवं अवधी लोक-साहित्य का प्रचार-प्रसार।',
                    'content' => '<p>अवधी भाषा की समृद्ध सांस्कृतिक विरासत के संरक्षण, \'झरिहख\' संस्मरण संकलन, 151 छन्दबद्ध कुंडलियों तथा कहावतों के संकलन हेतु निरंतर संचालित साहित्यिक अभियान।</p>',
                ];
            } elseif (str_contains($slugLower, 'kapda') || str_contains($slugLower, 'rural-skills')) {
                $item = [
                    'title' => 'कपड़ा बैंक (शीतकालीन वस्त्र वितरण अभियान)',
                    'slug' => $slug,
                    'image' => 'https://picsum.photos/seed/cause-three/900/700',
                    'excerpt' => 'शीत ऋतु में अत्यंत असहाय, निर्धन एवं ग्रामीण परिवारों को ऊनी वस्त्र एवं कम्बल उपलब्ध कराने की मानवीय पहल।',
                    'content' => '<p>शीत ऋतु में अत्यंत असहाय, निर्धन एवं ग्रामीण परिवारों को ऊनी वस्त्र, कम्बल एवं उपयोग योग्य वस्त्र उपलब्ध कराने हेतु संचालित लोक-सेवा अभियान।</p>',
                ];
            } elseif (str_contains($slugLower, 'sardar') || str_contains($slugLower, 'patel') || str_contains($slugLower, 'ekta')) {
                $item = [
                    'title' => 'सरदार पटेल राष्ट्रीय एकता अभियान',
                    'slug' => $slug,
                    'image' => 'assets/images/sardar_patel.webp',
                    'excerpt' => 'राष्ट्रीय एकता, सामाजिक समरसता और अखंड भारत के संदेश को जन-जन तक पहुँचाने हेतु संचालित प्राथमिक जन-अभियान।',
                    'content' => '<p>भारत के प्रथम गृहमंत्री भारत रत्न सरदार वल्लभभाई पटेल के कृतित्व एवं व्यक्तित्व से जन-जन को परिचित कराने तथा राष्ट्रीय एकता और सामाजिक समरसता के सिद्धांतों के प्रसार हेतु यह प्रमुख अभियान संचालित है। इसके माध्यम से युवाओं को राष्ट्र निर्माण, नागरिक दायित्व एवं निःस्वार्थ सेवा के प्रति निरंतर प्रेरित किया जाता है।</p><p>इसके अंतर्गत उत्तर प्रदेश के विभिन्‍न अंचलों में निरंतर राष्ट्रीय चेतना यात्राएं, युवा संवाद, गणतंत्र दिवस परेड (NSS 1987-88) के आदर्शों का संवर्धन और सर्वधर्म समरसता गोष्ठियां आयोजित की जाती हैं।</p>',
                ];
            } else {
                // Generic fallback matching title to requested slug
                $titleWords = array_map('ucfirst', explode('-', str_replace(['_', '/'], '-', $slug)));
                $formattedTitle = implode(' ', $titleWords);
                $item = [
                    'title' => $formattedTitle ?: 'जन-अभियान विवरण',
                    'slug' => $slug,
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db',
                    'excerpt' => 'प्रदीप सारंग द्वारा संचालित इस जन-अभियान का मुख्य उद्देश्य ग्रामीण सशक्तिकरण, पर्यावरण संवर्धन एवं सामुदायिक कल्याण है।',
                    'content' => '<p>इस जन-अभियान के अंतर्गत अवध अंचल में निरंतर जन-जागरूकता, पौधरोपण, जल-सकोरे वितरण और सामुदायिक सहभागिता के कार्यक्रम संचालित किए जा रहे हैं।</p>',
                ];
            }
        }

        $this->render('cause-detail', [
            'title' => $item['title'] ?? 'Campaign Detail',
            'item' => $item,
            'campaigns' => $allCampaigns
        ]);
    }

    public function eventDetail(string $slug): void
    {
        $item = $this->content->findBySlug('events', $slug);
        if ($item === null) {
            $this->render('404');
            return;
        }

        $allEvents = $this->content->allEvents();
        $this->render('event-detail', [
            'title' => $item['title'],
            'item' => $item,
            'events' => $allEvents
        ]);
    }

    public function handleForms(): void
    {
        if (!is_post()) {
            return;
        }

        verify_csrf();
        $type = $_POST['form_type'] ?? '';

        switch ($type) {
            case 'contact':
                $this->saveContact();
                break;
            case 'volunteer':
                $this->saveVolunteer();
                break;
            case 'newsletter':
                $this->saveNewsletter();
                break;
        }
    }

    private function saveContact(): void
    {
        $this->content->saveContact([
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'subject' => trim($_POST['subject'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'submitted_at' => date('Y-m-d H:i:s'),
        ]);
        flash('success', 'Contact request submitted successfully.');
        redirect('/contact');
    }

    private function saveVolunteer(): void
    {
        $error = '';
        $resume = null;
        if (!empty($_FILES['resume']['name'])) {
            $resume = upload_file($_FILES['resume'], $error, 'resumes');
        }

        $photo = null;
        if (!empty($_FILES['photo']['name'])) {
            $photo = upload_file($_FILES['photo'], $error, 'volunteers');
        }

        $this->content->saveVolunteer([
            'full_name' => trim($_POST['full_name'] ?? ''),
            'father_name' => trim($_POST['father_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'gender' => $_POST['gender'] ?? 'Male',
            'dob' => $_POST['dob'] ?? null,
            'phone' => trim($_POST['phone'] ?? ''),
            'state' => trim($_POST['state'] ?? ''),
            'district' => trim($_POST['district'] ?? ''),
            'pincode' => trim($_POST['pincode'] ?? ''),
            'occupation' => trim($_POST['occupation'] ?? ''),
            'skills' => trim($_POST['skills'] ?? ''),
            'interests' => trim($_POST['interests'] ?? ''),
            'availability' => trim($_POST['availability'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'resume' => $resume,
            'photo' => $photo,
            'status' => 'Pending'
        ]);
        flash('success', 'Volunteer application received. Thank you for joining us.');
        redirect('/volunteer');
    }

    private function saveNewsletter(): void
    {
        $this->content->saveSubscriber([
            'email' => trim($_POST['email'] ?? ''),
            'submitted_at' => date('Y-m-d H:i:s'),
        ]);
        flash('success', 'You have been subscribed to the newsletter.');
        redirect('/');
    }
}
