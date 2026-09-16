<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseModel.php';

class ContentModel extends BaseModel
{
    public function home(): array
    {
        return [
            'settings' => $this->demo['settings'],
            'sliders' => $this->allFromDemo('sliders'),
            'services' => $this->allFromDemo('services'),
            'campaigns' => array_slice($this->all('campaigns'), 0, 5),
            'events' => array_slice($this->all('events'), 0, 10),
            'portfolio' => $this->all('portfolio'),
            'blogs' => array_slice($this->all('blogs'), 0, 3),
            'testimonials' => $this->allFromDemo('testimonials'),
            'team' => $this->allFromDemo('team'),
            'stats' => $this->allFromDemo('stats'),
            'gallery' => $this->allGallery(20),
            'newspaper_cuttings' => $this->allNewspaperCuttings(8),
        ];
    }

    public function ensureCampaignColumns(): void
    {
        if (!$this->db) return;
        static $checked = false;
        if ($checked) return;
        $checked = true;

        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS campaigns (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                en_title VARCHAR(190) NULL,
                slug VARCHAR(190) NULL,
                short_description TEXT NULL,
                description TEXT NULL,
                target_amount DECIMAL(10,2) DEFAULT 0.00,
                raised_amount DECIMAL(10,2) DEFAULT 0.00,
                banner_image VARCHAR(255) NULL,
                status VARCHAR(50) DEFAULT 'active',
                is_primary TINYINT(1) DEFAULT 0,
                sort_order INT DEFAULT 0,
                category VARCHAR(100) DEFAULT 'unity',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

            $cols = $this->db->query("SHOW COLUMNS FROM campaigns")->fetchAll(PDO::FETCH_COLUMN);
            if (!in_array('en_title', $cols, true)) {
                $this->db->exec("ALTER TABLE campaigns ADD COLUMN en_title VARCHAR(190) NULL");
            }
            if (!in_array('is_primary', $cols, true)) {
                $this->db->exec("ALTER TABLE campaigns ADD COLUMN is_primary TINYINT(1) DEFAULT 0");
            }
            if (!in_array('sort_order', $cols, true)) {
                $this->db->exec("ALTER TABLE campaigns ADD COLUMN sort_order INT DEFAULT 0");
            }
            if (!in_array('category', $cols, true)) {
                $this->db->exec("ALTER TABLE campaigns ADD COLUMN category VARCHAR(100) DEFAULT 'unity'");
            }
        } catch (Throwable $e) {
            // Ignore schema alter errors if user privileges limited
        }
    }

    public function all(string $type): array
    {
        if (!$this->db) {
            return $this->allFromDemo($type);
        }

        try {
            if ($type === 'portfolio') {
                return $this->db->query('SELECT * FROM portfolio ORDER BY created_at DESC')->fetchAll();
            }
            if ($type === 'campaigns') {
                $this->ensureCampaignColumns();
                return $this->db->query('SELECT * FROM campaigns ORDER BY is_primary DESC, sort_order ASC, created_at DESC')->fetchAll();
            }
            if ($type === 'events') {
                try {
                    $this->db->exec("UPDATE events SET status = 'past' WHERE event_date < CURRENT_DATE() AND status != 'past'");
                    $this->db->exec("UPDATE events SET status = 'upcoming' WHERE event_date >= CURRENT_DATE() AND status != 'upcoming'");
                } catch (Throwable $e) {}
                return $this->db->query('SELECT * FROM events ORDER BY event_date DESC')->fetchAll();
            }
            if ($type === 'blogs') {
                return $this->db->query('SELECT b.*, c.name AS category_name 
                                       FROM blogs b 
                                       LEFT JOIN blog_categories c ON b.category_id = c.id 
                                       WHERE b.published_at IS NOT NULL AND b.published_at <= NOW() 
                                       ORDER BY b.published_at DESC')->fetchAll();
            }
            if ($type === 'gallery') {
                return $this->allGallery();
            }
        } catch (Throwable $e) {
            // Fallback to demo data if the table query fails
        }
        return $this->allFromDemo($type);
    }

    public function allEvents(): array
    {
        if (!$this->db) return $this->allFromDemo('events');
        try {
            $this->db->exec("UPDATE events SET status = 'past' WHERE event_date < CURRENT_DATE() AND status != 'past'");
            $this->db->exec("UPDATE events SET status = 'upcoming' WHERE event_date >= CURRENT_DATE() AND status != 'upcoming'");
        } catch (Throwable $e) {}
        return $this->db->query('SELECT * FROM events ORDER BY event_date DESC')->fetchAll();
    }

    public function findEvent(int $id): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare('SELECT * FROM events WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function createEvent(array $data): int
    {
        if (!$this->db) return 0;
        $stmt = $this->db->prepare('INSERT INTO events (title, slug, excerpt, content, event_date, location, image, status) VALUES (:title, :slug, :excerpt, :content, :event_date, :location, :image, :status)');
        $stmt->execute([
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':excerpt' => $data['excerpt'],
            ':content' => $data['content'],
            ':event_date' => $data['event_date'],
            ':location' => $data['location'],
            ':image' => $data['image'],
            ':status' => $data['status']
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function updateEvent(int $id, array $data): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('UPDATE events SET title = :title, slug = :slug, excerpt = :excerpt, content = :content, event_date = :event_date, location = :location, image = :image, status = :status WHERE id = :id');
        return $stmt->execute([
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':excerpt' => $data['excerpt'],
            ':content' => $data['content'],
            ':event_date' => $data['event_date'],
            ':location' => $data['location'],
            ':image' => $data['image'],
            ':status' => $data['status'],
            ':id' => $id
        ]);
    }

    public function deleteEvent(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('DELETE FROM events WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function eventSlugExists(string $slug, ?int $excludeId = null): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM events WHERE slug = :slug' . ($excludeId ? ' AND id != :id' : ''));
        $params = [':slug' => $slug];
        if ($excludeId) $params[':id'] = $excludeId;
        $stmt->execute($params);
        return (int) $stmt->fetchColumn() > 0;
    }

    public function normalizeEventSlug(string $title, ?int $excludeId = null): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        $slug = preg_replace('/-+/', '-', $slug);
        if ($slug === '') $slug = 'event';
        $original = $slug;
        $counter = 1;
        while ($this->eventSlugExists($slug, $excludeId)) { $slug = $original . '-' . $counter; $counter++; }
        return $slug;
    }

    public function allCampaigns(int $limit = 100, int $offset = 0): array
    {
        if (!$this->db) return $this->allFromDemo('causes');
        try {
            $this->ensureCampaignColumns();
            $stmt = $this->db->prepare('SELECT * FROM campaigns ORDER BY is_primary DESC, sort_order ASC, created_at DESC LIMIT :limit OFFSET :offset');
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Throwable $e) {
            return $this->allFromDemo('causes');
        }
    }

    public function findCampaign(int $id): ?array
    {
        if (!$this->db) return null;
        try {
            $this->ensureCampaignColumns();
            $stmt = $this->db->prepare('SELECT * FROM campaigns WHERE id = :id');
            $stmt->execute([':id' => $id]);
            $result = $stmt->fetch();
            return $result ?: null;
        } catch (Throwable $e) { return null; }
    }

    public function setPrimaryCampaign(int $id): bool
    {
        if (!$this->db) return false;
        $this->ensureCampaignColumns();
        try {
            $this->db->exec('UPDATE campaigns SET is_primary = 0');
            $stmt = $this->db->prepare('UPDATE campaigns SET is_primary = 1 WHERE id = :id');
            return $stmt->execute([':id' => $id]);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function createCampaign(array $data): int
    {
        if (!$this->db) return 0;
        $this->ensureCampaignColumns();
        $isPrimary = !empty($data['is_primary']) ? 1 : 0;
        if ($isPrimary) {
            $this->db->exec('UPDATE campaigns SET is_primary = 0');
        }
        $stmt = $this->db->prepare('INSERT INTO campaigns (title, en_title, slug, excerpt, content, goal_amount, raised_amount, image, status, is_primary, sort_order, category) VALUES (:title, :en_title, :slug, :excerpt, :content, :goal_amount, :raised_amount, :image, :status, :is_primary, :sort_order, :category)');
        $stmt->execute([
            ':title' => $data['title'],
            ':en_title' => $data['en_title'] ?? '',
            ':slug' => $data['slug'],
            ':excerpt' => $data['excerpt'],
            ':content' => $data['content'],
            ':goal_amount' => $data['goal_amount'],
            ':raised_amount' => $data['raised_amount'],
            ':image' => $data['image'],
            ':status' => $data['status'],
            ':is_primary' => $isPrimary,
            ':sort_order' => (int)($data['sort_order'] ?? 0),
            ':category' => $data['category'] ?? 'unity'
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function updateCampaign(int $id, array $data): bool
    {
        if (!$this->db) return false;
        $this->ensureCampaignColumns();
        $isPrimary = !empty($data['is_primary']) ? 1 : 0;
        if ($isPrimary) {
            $this->db->exec('UPDATE campaigns SET is_primary = 0');
        }
        $stmt = $this->db->prepare('UPDATE campaigns SET title = :title, en_title = :en_title, slug = :slug, excerpt = :excerpt, content = :content, goal_amount = :goal_amount, raised_amount = :raised_amount, image = :image, status = :status, is_primary = :is_primary, sort_order = :sort_order, category = :category WHERE id = :id');
        return $stmt->execute([
            ':title' => $data['title'],
            ':en_title' => $data['en_title'] ?? '',
            ':slug' => $data['slug'],
            ':excerpt' => $data['excerpt'],
            ':content' => $data['content'],
            ':goal_amount' => $data['goal_amount'],
            ':raised_amount' => $data['raised_amount'],
            ':image' => $data['image'],
            ':status' => $data['status'],
            ':is_primary' => $isPrimary,
            ':sort_order' => (int)($data['sort_order'] ?? 0),
            ':category' => $data['category'] ?? 'unity',
            ':id' => $id
        ]);
    }

    public function deleteCampaign(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('DELETE FROM campaigns WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function allGallery(int $limit = 100): array
    {
        if (!$this->db) return [];
        try {
            $stmt = $this->db->prepare('SELECT * FROM gallery ORDER BY created_at DESC LIMIT :limit');
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Throwable $e) {
            return [];
        }
    }

    public function findGallery(int $id): ?array
    {
        if (!$this->db) return null;
        try {
        $stmt = $this->db->prepare('SELECT * FROM gallery WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
        } catch (Throwable $e) { return null; }
    }

    public function createGallery(array $data): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('INSERT INTO gallery (title, image) VALUES (:title, :image)');
        return $stmt->execute([
            ':title' => $data['title'],
            ':image' => $data['image']
        ]);
    }

    public function deleteGallery(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('DELETE FROM gallery WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function allNewspaperCuttings(int $limit = 100): array
    {
        if (!$this->db) return [];
        try {
            $stmt = $this->db->prepare('SELECT * FROM newspaper_cuttings ORDER BY created_at DESC LIMIT :limit');
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Throwable $e) {
            return [];
        }
    }

    public function findNewspaperCutting(int $id): ?array
    {
        if (!$this->db) return null;
        try {
            $stmt = $this->db->prepare('SELECT * FROM newspaper_cuttings WHERE id = :id');
            $stmt->execute([':id' => $id]);
            return $stmt->fetch() ?: null;
        } catch (Throwable $e) { return null; }
    }

    public function createNewspaperCutting(array $data): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('INSERT INTO newspaper_cuttings (title, image) VALUES (:title, :image)');
        return $stmt->execute([
            ':title' => $data['title'],
            ':image' => $data['image']
        ]);
    }

    public function deleteNewspaperCutting(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('DELETE FROM newspaper_cuttings WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function allPages(): array
    {
        if (!$this->db) return [];
        try {
        return $this->db->query('SELECT * FROM pages ORDER BY created_at DESC')->fetchAll();
        } catch (Throwable $e) { return []; }
    }

    public function findPage(int $id): ?array
    {
        if (!$this->db) return null;
        try {
        $stmt = $this->db->prepare('SELECT * FROM pages WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
        } catch (Throwable $e) { return null; }
    }

    public function findPageBySlug(string $slug): ?array
    {
        if (!$this->db) return null;
        try {
        $stmt = $this->db->prepare('SELECT * FROM pages WHERE slug = :slug');
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch() ?: null;
        } catch (Throwable $e) { return null; }
    }

    public function createPage(array $data): int
    {
        if (!$this->db) return 0;
        $stmt = $this->db->prepare('INSERT INTO pages (title, slug, content, meta_title, meta_description, language_code) VALUES (:title, :slug, :content, :meta_title, :meta_description, :language_code)');
        $stmt->execute([
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':content' => $data['content'],
            ':meta_title' => $data['meta_title'],
            ':meta_description' => $data['meta_description'],
            ':language_code' => $data['language_code'] ?? 'en'
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function updatePage(int $id, array $data): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('UPDATE pages SET title = :title, slug = :slug, content = :content, meta_title = :meta_title, meta_description = :meta_description, language_code = :language_code WHERE id = :id');
        return $stmt->execute([
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':content' => $data['content'],
            ':meta_title' => $data['meta_title'],
            ':meta_description' => $data['meta_description'],
            ':language_code' => $data['language_code'],
            ':id' => $id
        ]);
    }

    public function deletePage(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('DELETE FROM pages WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function pageSlugExists(string $slug, ?int $excludeId = null): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM pages WHERE slug = :slug' . ($excludeId ? ' AND id != :id' : ''));
        $params = [':slug' => $slug];
        if ($excludeId) $params[':id'] = $excludeId;
        $stmt->execute($params);
        return (int) $stmt->fetchColumn() > 0;
    }

    public function normalizePageSlug(string $title, ?int $excludeId = null): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        $slug = preg_replace('/-+/', '-', $slug);
        if ($slug === '') $slug = 'page';
        $original = $slug;
        $counter = 1;
        while ($this->pageSlugExists($slug, $excludeId)) { $slug = $original . '-' . $counter; $counter++; }
        return $slug;
    }

    public function campaignSlugExists(string $slug, ?int $excludeId = null): bool
    {
        if (!$this->db) return false;
        try {
            $sql = 'SELECT COUNT(*) FROM campaigns WHERE slug = :slug';
            $params = [':slug' => $slug];
            if ($excludeId !== null) {
                $sql .= ' AND id != :exclude_id';
                $params[':exclude_id'] = $excludeId;
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return (int) $stmt->fetchColumn() > 0;
        } catch (Throwable $e) { return false; }
    }

    public function normalizeCampaignSlug(string $title, ?int $excludeId = null): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        $slug = preg_replace('/-+/', '-', $slug);
        if ($slug === '') $slug = 'campaign';
        $original = $slug;
        $counter = 1;
        while ($this->campaignSlugExists($slug, $excludeId)) {
            $slug = $original . '-' . $counter;
            $counter++;
        }
        return $slug;
    }

    public function findBySlug(string $type, string $slug): ?array
    {
        if ($this->db) {
            $table = preg_replace('/[^a-z0-9_]/', '', $type);
            try {
                $stmt = $this->db->prepare("SELECT * FROM $table WHERE slug = :slug");
                $stmt->execute([':slug' => $slug]);
                $res = $stmt->fetch();
                if ($res) return $res;
            } catch (Throwable $e) {
                // Fail silently to demo data
            }
        }

        foreach ($this->allFromDemo($type) as $item) {
            if (($item['slug'] ?? null) === $slug) {
                return $item;
            }
        }
        return null;
    }

    public function getStates(): array
    {
        if (!$this->db) return [];
        try {
            return $this->db->query("SELECT * FROM tab_state WHERE state_status IS NULL OR state_status = 1 ORDER BY state_name ASC")->fetchAll();
        } catch (Throwable $e) { return []; }
    }

    public function getCitiesByState($stateId): array
    {
        if (!$this->db) return [];
        try {
            if (!is_numeric($stateId) && is_string($stateId)) {
                $stStmt = $this->db->prepare("SELECT state_id FROM tab_state WHERE LOWER(state_name) = LOWER(:name) LIMIT 1");
                $stStmt->execute([':name' => $stateId]);
                $foundId = $stStmt->fetchColumn();
                if ($foundId) {
                    $stateId = (int)$foundId;
                } else {
                    return [];
                }
            }
            $stmt = $this->db->prepare("SELECT * FROM tab_city WHERE state_id = :state_id AND (city_status IS NULL OR city_status = 1) ORDER BY city_name ASC");
            $stmt->execute([':state_id' => (int)$stateId]);
            return $stmt->fetchAll();
        } catch (Throwable $e) { return []; }
    }

    public function allDonations(): array
    {
        if (!$this->db) return [];
        try {
            return $this->db->query('SELECT * FROM donations ORDER BY created_at DESC')->fetchAll();
        } catch (Throwable $e) {
            return [];
        }
    }

    public function updateDonationStatus(int $id, string $status): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('UPDATE donations SET status = :status WHERE id = :id');
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }

    public function updateDonationSettings(array $data): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('UPDATE donation_settings SET 
            org_name = :org_name,
            account_name = :account_name,
            bank_name = :bank_name,
            account_number = :account_number,
            ifsc = :ifsc,
            upi_id = :upi_id,
            qr_code = :qr_code,
            phone = :phone,
            email = :email,
            thank_you_msg = :thank_you_msg
            WHERE id = 1');
        return $stmt->execute($data);
    }

    public function getDonationSettings(): ?array
    {
        if (!$this->db) return null;
        try {
            $stmt = $this->db->query('SELECT * FROM donation_settings WHERE id = 1');
            return $stmt->fetch() ?: null;
        } catch (Throwable $e) {
            return null;
        }
    }

    public function ensureTimelineColumns(): void
    {
        if (!$this->db) return;
        static $checked = false;
        if ($checked) return;
        $checked = true;

        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS timeline (
                id INT AUTO_INCREMENT PRIMARY KEY,
                entry_type VARCHAR(50) DEFAULT 'yatra',
                category VARCHAR(100) DEFAULT 'social',
                year VARCHAR(50) NOT NULL,
                title VARCHAR(255) NOT NULL,
                description TEXT NULL,
                image VARCHAR(255) NULL,
                sort_order INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

            $cols = $this->db->query("SHOW COLUMNS FROM timeline")->fetchAll(PDO::FETCH_COLUMN);
            if (!in_array('entry_type', $cols, true)) {
                $this->db->exec("ALTER TABLE timeline ADD COLUMN entry_type VARCHAR(50) DEFAULT 'yatra'");
            }
            if (!in_array('category', $cols, true)) {
                $this->db->exec("ALTER TABLE timeline ADD COLUMN category VARCHAR(100) DEFAULT 'social'");
            }
            if (!in_array('image', $cols, true)) {
                $this->db->exec("ALTER TABLE timeline ADD COLUMN image VARCHAR(255) NULL");
            }
        } catch (Throwable $e) {
            // Ignore schema alter errors if user privileges limited
        }
    }

    public function seedTimelineIfEmpty(): void
    {
        if (!$this->db) return;
        static $seeded = false;
        if ($seeded) return;
        $seeded = true;

        try {
            $count = (int)$this->db->query('SELECT COUNT(*) FROM timeline')->fetchColumn();
            if ($count < 5) {
                $this->db->exec('DELETE FROM timeline');
                $seedEntries = $this->allFromDemo('timeline');
                $stmt = $this->db->prepare('INSERT INTO timeline (id, entry_type, category, year, title, description, sort_order) VALUES (:id, :entry_type, :category, :year, :title, :description, :sort_order)');
                foreach ($seedEntries as $entry) {
                    $stmt->execute([
                        ':id' => $entry['id'],
                        ':entry_type' => $entry['entry_type'],
                        ':category' => $entry['category'],
                        ':year' => $entry['year'],
                        ':title' => $entry['title'],
                        ':description' => $entry['description'],
                        ':sort_order' => $entry['sort_order'],
                    ]);
                }
            }
        } catch (Throwable $e) {}
    }

    public function getTimeline(?string $entryType = null): array
    {
        $this->ensureTimelineColumns();
        $this->seedTimelineIfEmpty();
        $list = [];
        if ($this->db) {
            try {
                if ($entryType !== null && $entryType !== '' && $entryType !== 'all') {
                    $stmt = $this->db->prepare('SELECT * FROM timeline WHERE entry_type = :entry_type ORDER BY sort_order ASC, year DESC');
                    $stmt->execute([':entry_type' => $entryType]);
                    $list = $stmt->fetchAll();
                } else {
                    $stmt = $this->db->query('SELECT * FROM timeline ORDER BY sort_order ASC, year DESC');
                    $list = $stmt->fetchAll();
                }
            } catch (Throwable $e) {}
        }
        if (empty($list)) {
            $list = $this->allFromDemo('timeline');
            if ($entryType !== null && $entryType !== '' && $entryType !== 'all') {
                $list = array_values(array_filter($list, fn($item) => ($item['entry_type'] ?? 'yatra') === $entryType));
            }
        }
        return $list;
    }

    public function findTimeline(int $id): ?array
    {
        if (!$this->db) return null;
        $this->ensureTimelineColumns();
        try {
            $stmt = $this->db->prepare('SELECT * FROM timeline WHERE id = :id');
            $stmt->execute([':id' => $id]);
            $result = $stmt->fetch();
            if ($result) return $result;
        } catch (Throwable $e) {}

        $demo = $this->allFromDemo('timeline');
        foreach ($demo as $item) {
            if ((int)($item['id'] ?? 0) === $id) {
                return $item;
            }
        }
        return null;
    }

    public function createTimeline(array $data): bool
    {
        if (!$this->db) return false;
        $this->ensureTimelineColumns();
        $stmt = $this->db->prepare('INSERT INTO timeline (entry_type, category, year, title, description, image, sort_order) VALUES (:entry_type, :category, :year, :title, :description, :image, :sort_order)');
        return $stmt->execute([
            ':entry_type' => $data['entry_type'] ?? 'yatra',
            ':category' => $data['category'] ?? 'social',
            ':year' => $data['year'],
            ':title' => $data['title'],
            ':description' => $data['description'] ?? '',
            ':image' => $data['image'] ?? '',
            ':sort_order' => (int)($data['sort_order'] ?? 0)
        ]);
    }

    public function updateTimeline(int $id, array $data): bool
    {
        if (!$this->db) return false;
        $this->ensureTimelineColumns();
        $stmt = $this->db->prepare('UPDATE timeline SET entry_type = :entry_type, category = :category, year = :year, title = :title, description = :description, image = :image, sort_order = :sort_order WHERE id = :id');
        return $stmt->execute([
            ':entry_type' => $data['entry_type'] ?? 'yatra',
            ':category' => $data['category'] ?? 'social',
            ':year' => $data['year'],
            ':title' => $data['title'],
            ':description' => $data['description'] ?? '',
            ':image' => $data['image'] ?? '',
            ':sort_order' => (int)($data['sort_order'] ?? 0),
            ':id' => $id
        ]);
    }

    public function deleteTimeline(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('DELETE FROM timeline WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function metrics(): array
    {
        $blogsCount = 0;
        $timelineCount = 0;
        $volunteersCount = 0;
        $contactsCount = 0;
        $campaignsCount = 0;
        $eventsCount = 0;
        $galleryCount = 0;
        $pagesCount = 0;
        $newspaperCount = 0;
        $donationCount = 0;
        $aboutPhotosCount = 0;

        if ($this->db) {
            try {
                $blogsCount = (int)$this->db->query('SELECT COUNT(*) FROM blogs')->fetchColumn();
            } catch (Throwable $e) {}
            try {
                $timelineCount = (int)$this->db->query('SELECT COUNT(*) FROM timeline')->fetchColumn();
            } catch (Throwable $e) {}
            try {
                $volunteersCount = (int)$this->db->query('SELECT COUNT(*) FROM volunteers')->fetchColumn();
            } catch (Throwable $e) {}
            try {
                $contactsCount = (int)$this->db->query('SELECT COUNT(*) FROM contacts')->fetchColumn();
            } catch (Throwable $e) {}
            try {
                $campaignsCount = (int)$this->db->query('SELECT COUNT(*) FROM campaigns')->fetchColumn();
            } catch (Throwable $e) {}
            try {
                $eventsCount = (int)$this->db->query('SELECT COUNT(*) FROM events')->fetchColumn();
            } catch (Throwable $e) {}
            try {
                $galleryCount = (int)$this->db->query('SELECT COUNT(*) FROM gallery')->fetchColumn();
            } catch (Throwable $e) {}
            try {
                $pagesCount = (int)$this->db->query('SELECT COUNT(*) FROM pages')->fetchColumn();
            } catch (Throwable $e) {}
            try {
                $newspaperCount = (int)$this->db->query('SELECT COUNT(*) FROM newspaper_cuttings')->fetchColumn();
            } catch (Throwable $e) {}
            try {
                $donationCount = (int)$this->db->query('SELECT COUNT(*) FROM donations')->fetchColumn();
            } catch (Throwable $e) {}
            try {
                $aboutPhotosCount = (int)$this->db->query('SELECT COUNT(*) FROM about_personal_photos')->fetchColumn();
            } catch (Throwable $e) {}
        } else {
            $blogsCount = count($this->allFromDemo('blogs'));
            $eventsCount = count($this->allFromDemo('events'));
            $campaignsCount = count($this->allFromDemo('campaigns'));
        }

        $vStats = $this->getVisitorStats();
        $visitorsCount = $vStats['total'] ?? 0;

        return [
            'blogs' => $blogsCount,
            'timeline' => $timelineCount,
            'volunteers' => $volunteersCount,
            'contacts' => $contactsCount,
            'campaigns' => $campaignsCount,
            'events' => $eventsCount,
            'gallery' => $galleryCount,
            'pages' => $pagesCount,
            'newspaper' => $newspaperCount,
            'donations' => $donationCount,
            'about_photos' => $aboutPhotosCount,
            'visitors' => $visitorsCount,
        ];
    }

    public function saveVolunteer(array $data): bool
    {
        if (!$this->db) return false;
        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS volunteers (
                id INT AUTO_INCREMENT PRIMARY KEY,
                full_name VARCHAR(150) NOT NULL,
                volunteer_id VARCHAR(50) UNIQUE NULL,
                father_name VARCHAR(150) NULL,
                email VARCHAR(190) NOT NULL,
                gender ENUM('Male', 'Female', 'Other') DEFAULT 'Male',
                dob DATE NULL,
                phone VARCHAR(50) NULL,
                state VARCHAR(100) NULL,
                district VARCHAR(100) NULL,
                pincode VARCHAR(10) NULL,
                occupation VARCHAR(150) NULL,
                photo VARCHAR(255) NULL,
                skills VARCHAR(255) NULL,
                interests VARCHAR(255) NULL,
                availability VARCHAR(100) NULL,
                resume VARCHAR(255) NULL,
                message TEXT NULL,
                status ENUM('Active', 'Inactive', 'Pending') DEFAULT 'Pending',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
        } catch (Throwable $e) {}

        $stateVal = $data['state'] ?? '';
        if (is_numeric($stateVal)) {
            try {
                $stNameStmt = $this->db->prepare("SELECT state_name FROM tab_state WHERE state_id = :sid LIMIT 1");
                $stNameStmt->execute([':sid' => (int)$stateVal]);
                $stName = $stNameStmt->fetchColumn();
                if ($stName) {
                    $stateVal = $stName;
                }
            } catch (Throwable $e) {}
        }

        $stmt = $this->db->prepare("INSERT INTO volunteers (volunteer_id, full_name, father_name, email, gender, dob, phone, state, district, pincode, occupation, photo, skills, interests, availability, message, status) 
            VALUES (:vid, :fname, :father, :email, :gender, :dob, :phone, :state, :dist, :pin, :occ, :photo, :skills, :interests, :avail, :msg, :status)");
        
        return $stmt->execute([
            ':vid' => 'VOL-' . strtoupper(substr(uniqid(), -6)),
            ':fname' => $data['full_name'],
            ':father' => $data['father_name'] ?? null,
            ':email' => $data['email'],
            ':gender' => $data['gender'] ?? 'Male',
            ':dob' => $data['dob'] ?? null,
            ':phone' => $data['phone'],
            ':state' => $stateVal,
            ':dist' => $data['district'],
            ':pin' => $data['pincode'] ?? null,
            ':occ' => $data['occupation'] ?? null,
            ':photo' => $data['photo'] ?? null,
            ':skills' => $data['skills'] ?? null,
            ':interests' => $data['interests'] ?? null,
            ':avail' => $data['availability'] ?? null,
            ':msg' => $data['message'] ?? null,
            ':status' => $data['status'] ?? 'Pending'
        ]);
    }

    public function findVolunteer(int $id): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare("SELECT * FROM volunteers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function updateVolunteer(int $id, array $data): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare("UPDATE volunteers SET 
            full_name = :fname, father_name = :father, email = :email, gender = :gender, 
            dob = :dob, phone = :phone, state = :state, district = :dist, pincode = :pin, 
            occupation = :occ, photo = :photo, status = :status WHERE id = :id");
        
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function updateVolunteerStatus(int $id, string $status): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare("UPDATE volunteers SET status = :status WHERE id = :id");
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }

    public function deleteVolunteer(int $id): bool
    {
        if (!$this->db) return false;
        $v = $this->findVolunteer($id);
        if ($v && $v['photo'] && file_exists(__DIR__ . '/../' . $v['photo'])) {
            @unlink(__DIR__ . '/../' . $v['photo']);
        }
        $stmt = $this->db->prepare("DELETE FROM volunteers WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function filterVolunteers(array $filters): array
    {
        if (!$this->db) return [];
        try {
            $sql = "SELECT * FROM volunteers WHERE 1=1";
            $params = [];

            if (!empty($filters['name'])) {
                $sql .= " AND (full_name LIKE :name OR volunteer_id LIKE :name)";
                $params[':name'] = '%' . $filters['name'] . '%';
            }
            if (!empty($filters['email'])) {
                $sql .= " AND email LIKE :email";
                $params[':email'] = '%' . $filters['email'] . '%';
            }
            if (!empty($filters['phone'])) {
                $sql .= " AND phone LIKE :phone";
                $params[':phone'] = '%' . $filters['phone'] . '%';
            }

            $sql .= " ORDER BY created_at DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (Throwable $e) {
            return [];
        }
    }

    public function saveContact(array $data): bool
    {
        if (!$this->db) {
            $_SESSION['_demo_contacts'][] = $data;
            return true;
        }
        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS contacts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(150) NOT NULL,
                email VARCHAR(190) NOT NULL,
                phone VARCHAR(50) NULL,
                subject VARCHAR(190) NULL,
                message TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

            $stmt = $this->db->prepare("INSERT INTO contacts (name, email, phone, subject, message) VALUES (:name, :email, :phone, :subject, :message)");
            return $stmt->execute([
                ':name' => $data['name'] ?? '',
                ':email' => $data['email'] ?? '',
                ':phone' => $data['phone'] ?? null,
                ':subject' => $data['subject'] ?? null,
                ':message' => $data['message'] ?? '',
            ]);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function allContacts(): array
    {
        if (!$this->db) return $_SESSION['_demo_contacts'] ?? [];
        try {
            return $this->db->query("SELECT * FROM contacts ORDER BY created_at DESC")->fetchAll();
        } catch (Throwable $e) {
            return [];
        }
    }

    public function deleteContact(int $id): bool
    {
        if (!$this->db) return false;
        try {
            $stmt = $this->db->prepare("DELETE FROM contacts WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function saveSubscriber(array $data): bool
    {
        if (!$this->db) {
            $_SESSION['_demo_subscribers'][] = $data;
            return true;
        }
        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS subscribers (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(190) NOT NULL UNIQUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

            $stmt = $this->db->prepare("INSERT IGNORE INTO subscribers (email) VALUES (:email)");
            return $stmt->execute([
                ':email' => $data['email'] ?? '',
            ]);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function ensureSettingsTable(): void
    {
        if (!$this->db) return;
        static $checked = false;
        if ($checked) return;
        $checked = true;
        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS settings (
                id INT AUTO_INCREMENT PRIMARY KEY,
                setting_key VARCHAR(190) NOT NULL UNIQUE,
                setting_value LONGTEXT NULL
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        } catch (Throwable $e) {}
    }

    public function ensureVisitorHistoricalTotalTable(): void
    {
        if (!$this->db) return;
        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS visitor_historical_total (
                id INT AUTO_INCREMENT PRIMARY KEY,
                total_count BIGINT NOT NULL DEFAULT 8421,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

            $count = (int)$this->db->query("SELECT COUNT(*) FROM visitor_historical_total")->fetchColumn();
            if ($count === 0) {
                $this->db->exec("INSERT INTO visitor_historical_total (id, total_count) VALUES (1, 8421)");
            }
        } catch (Throwable $e) {}
    }

    public function getVisitorHistoricalTotal(): int
    {
        $this->ensureVisitorHistoricalTotalTable();
        if (!$this->db) return 20421;

        try {
            $val = $this->db->query("SELECT total_count FROM visitor_historical_total WHERE id = 1")->fetchColumn();
            return ($val !== false) ? (int)$val : 8421;
        } catch (Throwable $e) {
            return 8421;
        }
    }

    public function trackVisitorSession(): int
    {
        if (!$this->db) {
            return 20421;
        }

        try {
            $historicalTotal = $this->getVisitorHistoricalTotal();

            $userAgent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
            $isBot = false;
            $botPatterns = ['bot', 'crawler', 'spider', 'slurp', 'ahrefs', 'semrush', 'facebookexternalhit', 'twitterbot', 'curl', 'wget', 'bytespider', 'gptbot'];
            foreach ($botPatterns as $pattern) {
                if (strpos($userAgent, $pattern) !== false) {
                    $isBot = true;
                    break;
                }
            }

            // Only insert new log into existing 'visitors' table for new human session
            if (!$isBot && empty($_SESSION['has_visited_site'])) {
                $_SESSION['has_visited_site'] = true;
                $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
                $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
                $pageUrl = current_path();

                $inStmt = $this->db->prepare("INSERT INTO visitors (ip_address, user_agent, page_url) VALUES (:ip, :ua, :url)");
                $inStmt->execute([
                    ':ip' => substr($ip, 0, 45),
                    ':ua' => $ua,
                    ':url' => substr($pageUrl, 0, 255)
                ]);
            }

            $liveCount = (int)$this->db->query("SELECT COUNT(*) FROM visitors")->fetchColumn();
            return $historicalTotal + $liveCount;
        } catch (Throwable $e) {
            return 8421;
        }
    }

    public function getVisitorStats(): array
    {
        $historical = $this->getVisitorHistoricalTotal();
        $live = 0;
        if ($this->db) {
            try {
                $live = (int)$this->db->query("SELECT COUNT(*) FROM visitors")->fetchColumn();
            } catch (Throwable $e) {}
        }
        return [
            'historical_total' => $historical,
            'live_count' => $live,
            'total' => $historical + $live
        ];
    }

    public function archiveAndResetVisitors(): array
    {
        if (!$this->db) {
            return ['status' => false, 'message' => 'Database connection unavailable.'];
        }

        try {
            $this->ensureVisitorHistoricalTotalTable();
            $liveCount = (int)$this->db->query("SELECT COUNT(*) FROM visitors")->fetchColumn();
            $currentHistorical = $this->getVisitorHistoricalTotal();
            $newHistorical = $currentHistorical + $liveCount;

            // 1. Update standalone Table 2: visitor_historical_total
            $upStmt = $this->db->prepare("UPDATE visitor_historical_total SET total_count = :val WHERE id = 1");
            $upStmt->execute([':val' => $newHistorical]);

            // 2. Truncate Table 1 (visitors table)
            $this->db->exec("TRUNCATE TABLE visitors");

            return [
                'status' => true,
                'archived_count' => $liveCount,
                'previous_historical' => $currentHistorical,
                'new_historical_total' => $newHistorical,
                'message' => "Successfully archived " . number_format($liveCount) . " visitor logs from Table 1 ('visitors'). New baseline in Table 2 ('visitor_historical_total') is " . number_format($newHistorical) . "."
            ];
        } catch (Throwable $e) {
            return ['status' => false, 'message' => 'Archiving failed: ' . $e->getMessage()];
        }
    }

    public function getSettings(): array
    {
        $defaultSettings = (require __DIR__ . '/../includes/data.php')['settings'];
        if (isset($_SESSION['_demo_settings'])) {
            $defaultSettings = array_merge($defaultSettings, $_SESSION['_demo_settings']);
        }
        if (!$this->db) {
            return $defaultSettings;
        }
        try {
            $this->ensureSettingsTable();
            $stmt = $this->db->query('SELECT setting_key, setting_value FROM settings');
            $dbSettings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR) ?: [];
            $merged = array_merge($defaultSettings, $dbSettings);
            
            // Overwrite any legacy placeholder phone numbers
            if (empty($merged['phone']) || strpos($merged['phone'], '98765') !== false) {
                $merged['phone'] = '+91 9919007190';
                $up = $this->db->prepare("INSERT INTO settings (setting_key, setting_value) VALUES ('phone', '+91 9919007190') ON DUPLICATE KEY UPDATE setting_value = '+91 9919007190'");
                $up->execute();
            }
            if (empty($merged['whatsapp']) || strpos($merged['whatsapp'], '98765') !== false) {
                $merged['whatsapp'] = '+91 9919007190';
                $up = $this->db->prepare("INSERT INTO settings (setting_key, setting_value) VALUES ('whatsapp', '+91 9919007190') ON DUPLICATE KEY UPDATE setting_value = '+91 9919007190'");
                $up->execute();
            }
            return $merged;
        } catch (Throwable $e) {
            return $defaultSettings;
        }
    }

    public function updateSettings(array $data): bool
    {
        $this->ensureSettingsTable();
        if (!$this->db) {
            $_SESSION['_demo_settings'] = array_merge($_SESSION['_demo_settings'] ?? [], $data);
            return true;
        }
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare('INSERT INTO settings (setting_key, setting_value) 
                VALUES (:key, :val) 
                ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)');
            foreach ($data as $key => $value) {
                $valStr = ($value !== null) ? (string)$value : '';
                $stmt->execute([':key' => (string)$key, ':val' => $valStr]);
            }
            $this->db->commit();

            $_SESSION['_demo_settings'] = array_merge($_SESSION['_demo_settings'] ?? [], $data);
            return true;
        } catch (Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            foreach ($data as $key => $value) {
                $valStr = ($value !== null) ? (string)$value : '';
                try {
                    $upStmt = $this->db->prepare('UPDATE settings SET setting_value = :val WHERE setting_key = :key');
                    $upStmt->execute([':key' => (string)$key, ':val' => $valStr]);
                    if ($upStmt->rowCount() === 0) {
                        $inStmt = $this->db->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (:key, :val)');
                        $inStmt->execute([':key' => (string)$key, ':val' => $valStr]);
                    }
                } catch (Throwable $e2) {}
            }
            $_SESSION['_demo_settings'] = array_merge($_SESSION['_demo_settings'] ?? [], $data);
            return true;
        }
    }

    public function getPublishedPersonalPhotos(): array
    {
        require_once __DIR__ . '/PersonalPhotoModel.php';
        return (new PersonalPhotoModel())->allPublished();
    }
}
