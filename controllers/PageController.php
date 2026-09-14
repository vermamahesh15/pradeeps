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
        if ($view === '404') {
            http_response_code(404);
        }
        $title = $data['title'] ?? app_config('name');
        $viewFile = __DIR__ . '/../views/pages/' . $view . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(404);
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
            'title' => 'Home',
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
            '/about' => ['view' => 'about', 'title' => 'About Us'],
            '/campaigns' => ['view' => 'causes', 'title' => 'Campaigns', 'items' => $this->content->all('campaigns')],
            '/events' => ['view' => 'events', 'title' => 'Events', 'items' => $this->content->all('events')],
            '/portfolio' => ['view' => 'portfolio', 'title' => 'Gallery', 'items' => $this->content->allGallery(100)],
            '/media' => ['view' => 'media', 'title' => 'Media Coverage', 'items' => $this->content->allNewspaperCuttings(100)],
            '/awards' => ['view' => 'awards', 'title' => 'Awards & Achievements', 'items' => $this->content->getTimeline()],
            '/contact' => ['view' => 'contact', 'title' => 'Contact'],
            '/volunteer' => ['view' => 'volunteer', 'title' => 'Volunteer Registration', 'states' => $this->content->getStates()],
            '/donation' => ['view' => 'donation', 'title' => 'Donate Now'],
        ];

        if ($slug === '/about') {
            $this->render('about', [
                'title' => 'About Us',
                'timeline' => $this->content->getTimeline()
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
                'title' => 'वीडियो दीर्घा (Video Gallery)',
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
            $this->render('blog', [
                'title' => 'Blog',
                'items' => $this->blogModel->allPublished(12, 0),
                'categories' => $this->categoryModel->all(),
            ]);
            return;
        }

        if ($slug === '/donation' || $slug === '/donate') {
            $this->render('donation', [
                'title' => 'Donate Now',
                'donation_settings' => $this->content->getDonationSettings()
            ]);
            return;
        }

        if ($slug === '/journey' || $slug === '/timeline') {
            $this->render('journey', [
                'title' => 'Service Journey & Timeline',
                'timeline' => $this->content->getTimeline()
            ]);
            return;
        }

        if ($slug === '/impact') {
            $this->render('impact', [
                'title' => 'Community Impact & Proof',
                'campaigns' => $this->content->all('campaigns')
            ]);
            return;
        }

        if ($slug === '/green-gang' || $slug === '/greengang') {
            $this->render('green-gang', [
                'title' => 'Green Gang Movement & Green Morning',
                'campaigns' => $this->content->all('campaigns')
            ]);
            return;
        }

        if ($slug === '/salahkaar' || $slug === '/counsellor' || $slug === '/counsellor-guidance') {
            $this->render('salahkaar', [
                'title' => 'Counsellor & Guidance'
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
        $post = $this->blogModel->findBySlug($slug);
        if ($post === null) {
            if ($slug === 'how-to-become-a-journalist-key-things-you-should-know' || $slug === 'how-to-become-a-journalist' || $slug === 'journalist') {
                $post = [
                    'id' => 99,
                    'title' => 'पत्रकार कैसे बनें: मुख्य बातें जो आपको जाननी चाहिए',
                    'slug' => 'how-to-become-a-journalist-key-things-you-should-know',
                    'category_name' => 'पत्रकारिता एवं मीडिया',
                    'author' => 'श्री प्रदीप सारंग',
                    'author_name' => 'श्री प्रदीप सारंग',
                    'published_at' => '2026-05-20',
                    'excerpt' => 'पत्रकारिता लोकतंत्र का चौथा स्तंभ है। यदि आप एक सफल, निष्पक्ष और प्रभावकारी पत्रकार बनना चाहते हैं, तो इन महत्वपूर्ण बातों, शैक्षणिक योग्यता और नैतिक सिद्धांतों को जानना आपके लिए अत्यंत आवश्यक है।',
                    'featured_image' => 'assets/images/slider_final_1.webp',
                    'content' => '',
                ];
            } else if ($slug === 'jharihakh' || $slug === 'blog-detail' || $slug === 'sample') {
                $post = [
                    'title' => 'झरिहख',
                    'slug' => 'jharihakh',
                    'category_name' => 'अवधी संस्मरण',
                    'author_name' => 'श्री प्रदीप सारंग',
                    'published_at' => '2026-05-19',
                    'excerpt' => 'वर्षा, बचपन और गाँव की चौपाल के सजीव संस्मरण',
                    'content' => '',
                ];
            } else {
                $this->render('404');
                return;
            }
        }

        $related = $this->blogModel->allPublished(3, 0, '', null);
        $related = array_filter($related, fn ($blog) => ($blog['slug'] ?? '') !== $slug);

        $this->render('blog-detail', [
            'title' => $post['title'],
            'post' => $post,
            'related' => array_slice(array_values($related), 0, 3),
        ]);
    }

    public function ampBlogDetail(string $slug): void
    {
        $post = $this->blogModel->findBySlug($slug);
        if ($post === null) {
            if ($slug === 'how-to-become-a-journalist-key-things-you-should-know' || $slug === 'how-to-become-a-journalist' || $slug === 'journalist') {
                $post = [
                    'id' => 99,
                    'title' => 'पत्रकार कैसे बनें: मुख्य बातें जो आपको जाननी चाहिए',
                    'slug' => 'how-to-become-a-journalist-key-things-you-should-know',
                    'category_name' => 'पत्रकारिता एवं मीडिया',
                    'author' => 'श्री प्रदीप सारंग',
                    'author_name' => 'श्री प्रदीप सारंग',
                    'published_at' => '2026-05-20',
                    'excerpt' => 'पत्रकारिता लोकतंत्र का चौथा स्तंभ है। यदि आप एक सफल, निष्पक्ष और प्रभावकारी पत्रकार बनना चाहते हैं, तो इन महत्वपूर्ण बातों, शैक्षणिक योग्यता और नैतिक सिद्धांतों को जानना आपके लिए अत्यंत आवश्यक है।',
                    'featured_image' => 'assets/images/slider_final_1.webp',
                    'content' => '',
                ];
            } else if ($slug === 'jharihakh' || $slug === 'blog-detail' || $slug === 'sample') {
                $post = [
                    'title' => 'झरिहख',
                    'slug' => 'jharihakh',
                    'category_name' => 'अवधी संस्मरण',
                    'author_name' => 'श्री प्रदीप सारंग',
                    'published_at' => '2026-05-19',
                    'excerpt' => 'वर्षा, बचपन और गाँव की चौपाल के सजीव संस्मरण',
                    'content' => '',
                ];
            } else {
                $this->renderAmp('amp-page', ['title' => 'Article Not Found', 'canonicalUrl' => base_url('/blog/' . $slug)]);
                return;
            }
        }

        $related = $this->blogModel->allPublished(3, 0, '', null);
        $related = array_filter($related, fn ($blog) => ($blog['slug'] ?? '') !== $slug);

        $this->renderAmp('amp-blog-detail', [
            'title' => $post['title'],
            'post' => $post,
            'canonicalUrl' => base_url('/blog/' . $post['slug']),
            'related' => array_slice(array_values($related), 0, 3),
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
