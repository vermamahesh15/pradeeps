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
        $stmt = $this->db->prepare('INSERT INTO blog_categories (name, slug) VALUES (:name, :slug)');
        $stmt->execute([
            ':name' => $data['name'],
            ':slug' => $data['slug'],
        ]);

        return (int) $this->db->lastInsertId();
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
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        $slug = preg_replace('/-+/', '-', $slug);
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
}
