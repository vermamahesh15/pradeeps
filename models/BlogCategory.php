<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseModel.php';

class BlogCategory extends BaseModel
{
    public function all(): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->query('SELECT * FROM blog_categories ORDER BY name ASC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare('SELECT * FROM blog_categories WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();

        return $result === false ? null : $result;
    }

    public function findBySlug(string $slug): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare('SELECT * FROM blog_categories WHERE slug = :slug');
        $stmt->execute([':slug' => $slug]);
        $result = $stmt->fetch();

        return $result === false ? null : $result;
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

