<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseModel.php';

class BlogCategory extends BaseModel
{
    public function getDefaultCategories(): array
    {
        return [
            ['id' => 1, 'name' => 'साक्षात्कार', 'slug' => 'interview'],
            ['id' => 2, 'name' => 'गीत', 'slug' => 'geet'],
            ['id' => 3, 'name' => 'अवधी कहानी', 'slug' => 'story'],
            ['id' => 4, 'name' => 'संस्मरण/वर्णन', 'slug' => 'memories'],
            ['id' => 5, 'name' => 'समाचार एवं विचार', 'slug' => 'news-views'],
            ['id' => 6, 'name' => 'आलेख', 'slug' => 'alekh'],
            ['id' => 7, 'name' => 'सामान्य', 'slug' => 'general']
        ];
    }

    public function all(): array
    {
        $defaults = $this->getDefaultCategories();
        if ($this->db) {
            try {
                $stmt = $this->db->query('SELECT * FROM blog_categories ORDER BY id ASC');
                $result = $stmt->fetchAll();
                if (!empty($result)) {
                    // Ensure every record has an id key
                    foreach ($result as &$r) {
                        if (empty($r['id'])) {
                            $r['id'] = $r['slug'] ?? $r['name'];
                        }
                    }
                    return $result;
                }
                // Auto seed default categories into table
                foreach ($defaults as $cat) {
                    try {
                        $ins = $this->db->prepare('INSERT IGNORE INTO blog_categories (id, name, slug) VALUES (:id, :name, :slug)');
                        $ins->execute([':id' => $cat['id'], ':name' => $cat['name'], ':slug' => $cat['slug']]);
                    } catch (Throwable $e) {}
                }
                $stmt = $this->db->query('SELECT * FROM blog_categories ORDER BY id ASC');
                $result = $stmt->fetchAll();
                if (!empty($result)) {
                    return $result;
                }
            } catch (Throwable $e) {}
        }
        return $defaults;
    }

    public function find($id): ?array
    {
        if (empty($id) && $id !== 0 && $id !== '0') return null;
        if ($this->db) {
            try {
                $sql = is_numeric($id) ? 'SELECT * FROM blog_categories WHERE id = :id OR slug = :id_str' : 'SELECT * FROM blog_categories WHERE slug = :id OR name = :id';
                $stmt = $this->db->prepare($sql);
                if (is_numeric($id)) {
                    $stmt->execute([':id' => $id, ':id_str' => (string)$id]);
                } else {
                    $stmt->execute([':id' => $id]);
                }
                $result = $stmt->fetch();
                if ($result) return $result;
            } catch (Throwable $e) {}
        }

        foreach ($this->getDefaultCategories() as $cat) {
            if ((string)$cat['id'] === (string)$id || $cat['slug'] === (string)$id || $cat['name'] === (string)$id) {
                return $cat;
            }
        }

        return null;
    }

    public function findBySlug(string $slug): ?array
    {
        return $this->find($slug);
    }

    public function create(array $data): int
    {
        if (!$this->db) return 0;
        try {
            $stmt = $this->db->prepare('INSERT INTO blog_categories (name, slug) VALUES (:name, :slug)');
            $stmt->execute([
                ':name' => $data['name'],
                ':slug' => $data['slug'],
            ]);
            $id = (int) $this->db->lastInsertId();
            if ($id > 0) return $id;
        } catch (Throwable $e) {
            $maxStmt = $this->db->query('SELECT COALESCE(MAX(id), 0) FROM blog_categories');
            $nextId = (int) $maxStmt->fetchColumn() + 1;

            $stmt = $this->db->prepare('INSERT INTO blog_categories (id, name, slug) VALUES (:id, :name, :slug)');
            $stmt->execute([
                ':id' => $nextId,
                ':name' => $data['name'],
                ':slug' => $data['slug'],
            ]);
            return $nextId;
        }

        $maxStmt = $this->db->query('SELECT COALESCE(MAX(id), 0) FROM blog_categories');
        return (int) $maxStmt->fetchColumn();
    }

    public function update(int $id, array $data): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('UPDATE blog_categories SET name = :name, slug = :slug WHERE id = :id');
        return $stmt->execute([
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('DELETE FROM blog_categories WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function slugExists(string $slug, ?int $excludeId = null): bool
    {
        if (!$this->db) return false;
        $sql = 'SELECT COUNT(*) FROM blog_categories WHERE slug = :slug';
        $params = [':slug' => $slug];

        if ($excludeId !== null) {
            $sql .= ' AND id != :exclude_id';
            $params[':exclude_id'] = $excludeId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function normalizeSlug(string $name, ?int $excludeId = null): string
    {
        $slug = trim(preg_replace('/[^\p{L}\p{N}]+/u', '-', $name), '-');
        $slug = mb_strtolower(preg_replace('/-+/', '-', $slug), 'UTF-8');
        if ($slug === '') {
            $slug = 'category';
        }

        $original = $slug;
        $counter = 1;
        while ($this->slugExists($slug, $excludeId)) {
            $slug = $original . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function allWithPostCount(): array
    {
        if (!$this->db) {
            $cats = $this->all();
            foreach ($cats as &$c) {
                $c['post_count'] = 0;
            }
            return $cats;
        }
        try {
            $stmt = $this->db->query('
                SELECT c.*, COUNT(b.id) AS post_count
                FROM blog_categories c
                LEFT JOIN blogs b ON b.category_id = c.id
                GROUP BY c.id, c.name, c.slug, c.created_at, c.updated_at
                ORDER BY c.name ASC
            ');
            return $stmt->fetchAll();
        } catch (Throwable $e) {
            $cats = $this->all();
            foreach ($cats as &$c) {
                $c['post_count'] = 0;
            }
            return $cats;
        }
    }
}

