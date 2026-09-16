<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/BlogCategory.php';

class Blog extends BaseModel
{
    public function allPublished(int $limit = 15, int $offset = 0, string $search = '', ?int $categoryId = null): array
    {
        if (!$this->db) return $this->allFromDemo('blogs');
        $sql = 'SELECT b.*, c.name AS category_name, c.slug AS category_slug, u.name AS author_name
                FROM blogs b
                LEFT JOIN blog_categories c ON b.category_id = c.id
                LEFT JOIN users u ON b.author_id = u.id
                WHERE b.status = \'published\'
                  AND b.published_at IS NOT NULL
                  AND b.published_at <= NOW()';

        $params = [];
        if ($search !== '') {
            $sql .= ' AND (b.title LIKE :search OR b.content LIKE :search2)';
            $params[':search'] = '%' . $search . '%';
            $params[':search2'] = '%' . $search . '%';
        }

        if ($categoryId !== null) {
            $sql .= ' AND b.category_id = :category_id';
            $params[':category_id'] = $categoryId;
        }

        $sql .= ' ORDER BY b.published_at DESC, b.created_at DESC LIMIT :limit OFFSET :offset';
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $items = $stmt->fetchAll();
        foreach ($items as &$item) {
            $authorName = !empty($item['author']) ? $item['author'] : (!empty($item['author_name']) ? $item['author_name'] : 'प्रदीप सारंग');
            if ($authorName === 'Super Admin' || (isset($item['author_id']) && (int)$item['author_id'] === 1)) {
                $authorName = 'प्रदीप सारंग';
            }
            $item['author'] = $authorName;
            $item['author_name'] = $authorName;
        }
        unset($item);
        return $items;
    }

    public function all(int $limit = 100, int $offset = 0, ?int $authorId = null, ?string $status = null): array
    {
        if (!$this->db) return $this->allFromDemo('blogs');
        $sql = 'SELECT b.*, c.name AS category_name, c.slug AS category_slug, u.name AS author_name, u.email AS author_email
                FROM blogs b
                LEFT JOIN blog_categories c ON b.category_id = c.id
                LEFT JOIN users u ON b.author_id = u.id';
        
        $where = [];
        $params = [];

        if ($authorId !== null) {
            $where[] = 'b.author_id = :author_id';
            $params[':author_id'] = $authorId;
        }

        if ($status !== null) {
            $where[] = 'b.status = :status';
            $params[':status'] = $status;
        }

        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $sql .= ' ORDER BY b.created_at DESC LIMIT :limit OFFSET :offset';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();

        $items = $stmt->fetchAll();
        foreach ($items as &$item) {
            $authorName = !empty($item['author']) ? $item['author'] : (!empty($item['author_name']) ? $item['author_name'] : 'प्रदीप सारंग');
            $item['author'] = $authorName;
            $item['author_name'] = $authorName;
        }
        unset($item);
        return $items;
    }

    public function count(?int $authorId = null, ?string $status = null): int
    {
        if (!$this->db) return 0;
        $sql = 'SELECT COUNT(*) FROM blogs b';
        $where = [];
        $params = [];

        if ($authorId !== null) {
            $where[] = 'b.author_id = :author_id';
            $params[':author_id'] = $authorId;
        }

        if ($status !== null) {
            $where[] = 'b.status = :status';
            $params[':status'] = $status;
        }

        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function countPublished(string $search = '', ?int $categoryId = null): int
    {
        if (!$this->db) return count($this->allFromDemo('blogs'));
        $sql = 'SELECT COUNT(*) AS total FROM blogs b WHERE b.status = \'published\' AND b.published_at IS NOT NULL AND b.published_at <= NOW()';
        $params = [];

        if ($search !== '') {
            $sql .= ' AND b.title LIKE :search';
            $params[':search'] = '%' . $search . '%';
        }

        if ($categoryId !== null) {
            $sql .= ' AND b.category_id = :category_id';
            $params[':category_id'] = $categoryId;
        }

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();

        return (int) ($stmt->fetchColumn() ?: 0);
    }

    public function findBySlug(string $slug, bool $publishedOnly = true): ?array
    {
        if (!$this->db) return null;
        $sql = 'SELECT b.*, c.name AS category_name, c.slug AS category_slug, u.name AS author_name, u.profile_photo AS author_photo, u.biography AS author_bio
                FROM blogs b
                LEFT JOIN blog_categories c ON b.category_id = c.id
                LEFT JOIN users u ON b.author_id = u.id
                WHERE b.slug = :slug';

        if ($publishedOnly) {
            $sql .= ' AND b.status = \'published\' AND b.published_at IS NOT NULL AND b.published_at <= NOW()';
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':slug' => $slug]);
        $result = $stmt->fetch();
        if ($result) {
            $authorName = !empty($result['author']) ? $result['author'] : (!empty($result['author_name']) ? $result['author_name'] : 'प्रदीप सारंग');
            $result['author'] = $authorName;
            $result['author_name'] = $authorName;
        }

        return $result === false ? null : $result;
    }

    public function find($id): ?array
    {
        if (empty($id)) return null;
        if ($this->db) {
            try {
                $sql = 'SELECT b.*, c.name AS category_name, c.slug AS category_slug, u.name AS author_name, u.email AS author_email FROM blogs b LEFT JOIN blog_categories c ON (b.category_id = c.id OR b.category_id = c.slug) LEFT JOIN users u ON b.author_id = u.id WHERE ';
                if (is_numeric($id)) {
                    $sql .= 'b.id = :id';
                } else {
                    $sql .= 'b.slug = :id';
                }
                $stmt = $this->db->prepare($sql);
                $stmt->execute([':id' => $id]);
                $result = $stmt->fetch();
                if ($result) {
                    $authorName = !empty($result['author']) ? $result['author'] : (!empty($result['author_name']) ? $result['author_name'] : 'प्रदीप सारंग');
                    $result['author'] = $authorName;
                    $result['author_name'] = $authorName;
                    return $result;
                }
            } catch (Throwable $e) {}
        }

        $demo = $this->allFromDemo('blogs');
        foreach ($demo as $item) {
            if ((string)($item['id'] ?? '') === (string)$id || ($item['slug'] ?? '') === (string)$id) {
                $authorName = !empty($item['author']) ? $item['author'] : (!empty($item['author_name']) ? $item['author_name'] : 'प्रदीप सारंग');
                $item['author'] = $authorName;
                $item['author_name'] = $authorName;
                return $item;
            }
        }

        return null;
    }

    public function create(array $data): int
    {
        if (!$this->db) return 0;
        $authorName = !empty($data['author']) ? $data['author'] : (!empty($data['author_name']) ? $data['author_name'] : ($_SESSION['user_name'] ?? 'प्रदीप सारंग'));
        if ($authorName === 'Super Admin' || ($_SESSION['user_role'] ?? '') === 'super_admin' || (isset($data['author_id']) && (int)$data['author_id'] === 1)) {
            $authorName = 'प्रदीप सारंग';
        }
        
        $params = [
            ':category_id' => $data['category_id'],
            ':author_id' => $data['author_id'] ?? null,
            ':title' => $data['title'],
            ':en_title' => $data['en_title'] ?? null,
            ':slug' => $data['slug'],
            ':excerpt' => $data['excerpt'] ?? null,
            ':content' => $data['content'] ?? null,
            ':banner_image' => $data['banner_image'] ?? null,
            ':author' => $authorName,
            ':created_by' => $data['created_by'] ?? null,
            ':updated_by' => $data['updated_by'] ?? null,
            ':status' => $data['status'] ?? 'draft',
            ':featured_image' => $data['featured_image'] ?? null,
            ':seo_title' => $data['seo_title'] ?? null,
            ':meta_description' => $data['meta_description'] ?? null,
            ':meta_keywords' => $data['meta_keywords'] ?? null,
            ':canonical_url' => $data['canonical_url'] ?? null,
            ':og_image' => $data['og_image'] ?? null,
            ':published_at' => $data['published_at'] ?? null,
        ];

        try {
            // Attempt standard AUTO_INCREMENT insert
            $stmt = $this->db->prepare('INSERT INTO blogs (category_id, author_id, title, en_title, slug, excerpt, content, banner_image, author, created_by, updated_by, status, featured_image, seo_title, meta_description, meta_keywords, canonical_url, og_image, published_at) 
                VALUES (:category_id, :author_id, :title, :en_title, :slug, :excerpt, :content, :banner_image, :author, :created_by, :updated_by, :status, :featured_image, :seo_title, :meta_description, :meta_keywords, :canonical_url, :og_image, :published_at)');
            $stmt->execute($params);
            $lastId = (int) $this->db->lastInsertId();
            if ($lastId > 0) {
                return $lastId;
            }
        } catch (Throwable $e) {
            // Auto-repair missing AUTO_INCREMENT constraint on id column
            try {
                $this->db->exec('ALTER TABLE blogs MODIFY id INT NOT NULL AUTO_INCREMENT');
                $stmt = $this->db->prepare('INSERT INTO blogs (category_id, author_id, title, en_title, slug, excerpt, content, banner_image, author, created_by, updated_by, status, featured_image, seo_title, meta_description, meta_keywords, canonical_url, og_image, published_at) 
                    VALUES (:category_id, :author_id, :title, :en_title, :slug, :excerpt, :content, :banner_image, :author, :created_by, :updated_by, :status, :featured_image, :seo_title, :meta_description, :meta_keywords, :canonical_url, :og_image, :published_at)');
                $stmt->execute($params);
                $lastId = (int) $this->db->lastInsertId();
                if ($lastId > 0) return $lastId;
            } catch (Throwable $ex) {}

            // Manual Next ID calculation fallback if ALTER TABLE is restricted
            $maxStmt = $this->db->query('SELECT COALESCE(MAX(id), 0) FROM blogs');
            $nextId = (int) $maxStmt->fetchColumn() + 1;

            $params[':id'] = $nextId;
            $stmt = $this->db->prepare('INSERT INTO blogs (id, category_id, author_id, title, en_title, slug, excerpt, content, banner_image, author, created_by, updated_by, status, featured_image, seo_title, meta_description, meta_keywords, canonical_url, og_image, published_at) 
                VALUES (:id, :category_id, :author_id, :title, :en_title, :slug, :excerpt, :content, :banner_image, :author, :created_by, :updated_by, :status, :featured_image, :seo_title, :meta_description, :meta_keywords, :canonical_url, :og_image, :published_at)');
            $stmt->execute($params);
            if (function_exists('ps_generate_sitemap')) {
                ps_generate_sitemap($this);
            }
            return $nextId;
        }

        $maxStmt = $this->db->query('SELECT COALESCE(MAX(id), 0) FROM blogs');
        $createdId = (int) $maxStmt->fetchColumn();
        if (function_exists('ps_generate_sitemap')) {
            ps_generate_sitemap($this);
        }
        return $createdId;
    }

    public function update($id, array $data): bool
    {
        if (!$this->db) return false;
        $authorName = !empty($data['author']) ? $data['author'] : (!empty($data['author_name']) ? $data['author_name'] : ($_SESSION['user_name'] ?? 'प्रदीप सारंग'));
        if ($authorName === 'Super Admin' || ($_SESSION['user_role'] ?? '') === 'super_admin' || (isset($data['author_id']) && (int)$data['author_id'] === 1)) {
            $authorName = 'प्रदीप सारंग';
        }
        $whereSql = is_numeric($id) ? 'WHERE id = :id' : 'WHERE slug = :id';
        $stmt = $this->db->prepare('UPDATE blogs SET category_id = :category_id, author_id = :author_id, title = :title, en_title = :en_title, slug = :slug, excerpt = :excerpt, content = :content, banner_image = :banner_image, author = :author, updated_by = :updated_by, status = :status, featured_image = :featured_image, seo_title = :seo_title, meta_description = :meta_description, meta_keywords = :meta_keywords, canonical_url = :canonical_url, og_image = :og_image, published_at = :published_at ' . $whereSql);
        $res = $stmt->execute([
            ':category_id' => $data['category_id'],
            ':author_id' => $data['author_id'] ?? null,
            ':title' => $data['title'],
            ':en_title' => $data['en_title'] ?? null,
            ':slug' => $data['slug'],
            ':excerpt' => $data['excerpt'] ?? null,
            ':content' => $data['content'] ?? null,
            ':banner_image' => $data['banner_image'] ?? null,
            ':author' => $authorName,
            ':updated_by' => $data['updated_by'] ?? null,
            ':status' => $data['status'] ?? 'draft',
            ':featured_image' => $data['featured_image'] ?? null,
            ':seo_title' => $data['seo_title'] ?? null,
            ':meta_description' => $data['meta_description'] ?? null,
            ':meta_keywords' => $data['meta_keywords'] ?? null,
            ':canonical_url' => $data['canonical_url'] ?? null,
            ':og_image' => $data['og_image'] ?? null,
            ':published_at' => $data['published_at'] ?? null,
            ':id' => $id,
        ]);
        if ($res && function_exists('ps_generate_sitemap')) {
            ps_generate_sitemap($this);
        }
        return $res;
    }

    public function delete($id): bool
    {
        if (!$this->db) return false;
        $whereSql = is_numeric($id) ? 'WHERE id = :id' : 'WHERE slug = :id';
        $stmt = $this->db->prepare('DELETE FROM blogs ' . $whereSql);
        $res = $stmt->execute([':id' => $id]);
        if ($res && function_exists('ps_generate_sitemap')) {
            ps_generate_sitemap($this);
        }
        return $res;
    }

    public function slugExists(string $slug, $excludeId = null): bool
    {
        if (!$this->db) return false;
        $sql = 'SELECT COUNT(*) FROM blogs WHERE slug = :slug';
        $params = [':slug' => $slug];

        if ($excludeId !== null && $excludeId !== '' && $excludeId !== 0 && $excludeId !== '0') {
            if (is_numeric($excludeId)) {
                $sql .= ' AND id != :exclude_id';
            } else {
                $sql .= ' AND slug != :exclude_id';
            }
            $params[':exclude_id'] = $excludeId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function normalizeSlug(string $title, $excludeId = null): string
    {
        // Support Hindi / non-latin titles by falling back, but try to convert English if possible.
        // For non-latin titles, we can generate a random unique hash or direct transliteration.
        // Let's do standard transliteration check or fallback if empty.
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        $slug = preg_replace('/-+/', '-', $slug);
        if ($slug === '') {
            // Fallback for non-english slug (like Hindi text)
            // We use urlencode or unique ID
            $slug = 'post-' . substr(md5($title), 0, 8);
        }

        $original = $slug;
        $counter = 1;
        while ($this->slugExists($slug, $excludeId)) {
            $slug = $original . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function autoGenerateSeoMeta(array $blogData, ?BlogCategory $categoryModel = null): array
    {
        $rawTitle = trim(strip_tags($blogData['title'] ?? ''));
        $rawExcerpt = trim(strip_tags($blogData['excerpt'] ?? ''));
        $rawContent = trim(strip_tags($blogData['content'] ?? ''));

        // 1. Auto SEO Title
        if (empty($blogData['seo_title'])) {
            $blogData['seo_title'] = $rawTitle . ' | ' . app_config('name');
        }

        // 2. Auto Meta Description (Always clean of all HTML tags and entities)
        if (empty($blogData['meta_description'])) {
            $sourceText = !empty($rawExcerpt) ? $rawExcerpt : $rawContent;
            $cleanDesc = clean_plain_text($sourceText);
            $blogData['meta_description'] = mb_strlen($cleanDesc) > 160 ? mb_substr($cleanDesc, 0, 157) . '...' : $cleanDesc;
        } else {
            $blogData['meta_description'] = clean_plain_text((string)$blogData['meta_description']);
        }

        // 3. Auto Meta Keywords
        if (empty($blogData['meta_keywords'])) {
            $catName = '';
            if (!empty($blogData['category_id']) && $categoryModel !== null) {
                $catObj = $categoryModel->find($blogData['category_id']);
                if ($catObj && !empty($catObj['name'])) {
                    $catName = $catObj['name'];
                }
            }
            
            $keywords = [];
            if ($rawTitle) $keywords[] = $rawTitle;
            if ($catName) $keywords[] = $catName;
            if (!empty($blogData['author'])) $keywords[] = $blogData['author'];
            $keywords[] = 'प्रदीप सारंग';
            $keywords[] = 'अवधी साहित्य';
            $keywords[] = 'Pradeep Sarang';
            $keywords[] = 'आलेख व विचार';

            $blogData['meta_keywords'] = implode(', ', array_unique(array_filter($keywords)));
        }

        // 4. Auto Canonical URL & Clean Duplicated Schemes
        if (empty($blogData['canonical_url']) && !empty($blogData['slug'])) {
            $blogData['canonical_url'] = base_url('/blog/' . $blogData['slug']);
        } elseif (!empty($blogData['canonical_url'])) {
            if (preg_match('#^(https?://[^/]+)+(https?://.+)#i', $blogData['canonical_url'], $m)) {
                $blogData['canonical_url'] = $m[2];
            }
        }

        // 5. Auto Open Graph Image
        if (empty($blogData['og_image'])) {
            $blogData['og_image'] = $blogData['banner_image'] ?? ($blogData['featured_image'] ?? 'assets/images/home/headerbackground.png');
        }

        return $blogData;
    }
}
