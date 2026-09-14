<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Blog.php';
require_once __DIR__ . '/../models/BlogCategory.php';
require_once __DIR__ . '/../includes/helpers.php';

class BlogController
{
    private Blog $blog;
    private BlogCategory $category;

    public function __construct(Blog $blog, BlogCategory $category)
    {
        $this->blog = $blog;
        $this->category = $category;
    }

    public function list(array $query = []): void
    {
        $page = max((int) ($query['page'] ?? 1), 1);
        $limit = max((int) ($query['limit'] ?? 12), 1);
        $offset = ($page - 1) * $limit;
        $search = trim((string) ($query['search'] ?? ''));
        $categoryId = isset($query['category_id']) && is_numeric($query['category_id']) ? (int) $query['category_id'] : null;

        $data = [
            'items' => $this->blog->allPublished($limit, $offset, $search, $categoryId),
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $this->blog->countPublished($search, $categoryId),
            ],
        ];

        json_response(['status' => 'success', 'data' => $data]);
    }

    public function showBySlug(string $slug): void
    {
        $item = $this->blog->findBySlug($slug);
        if ($item === null) {
            json_response(['status' => 'error', 'message' => 'Blog not found.'], 404);
        }

        json_response(['status' => 'success', 'data' => $item]);
    }

    public function create(): void
    {
        $data = $this->requestPayload();
        $data = $this->sanitizeBlogData($data);
        $errors = $this->validateBlog($data);

        if (!empty($errors)) {
            json_response(['status' => 'error', 'errors' => $errors], 422);
        }

        $data['slug'] = $this->resolveSlug($data);
        $data['banner_image'] = $this->handleBannerUpload($_FILES['banner_image'] ?? null, $data['banner_image'] ?? '');

        $id = $this->blog->create($data);
        $item = $this->blog->find($id);

        json_response(['status' => 'success', 'message' => 'Blog created.', 'data' => $item], 201);
    }

    public function update(int $id): void
    {
        $existing = $this->blog->find($id);
        if ($existing === null) {
            json_response(['status' => 'error', 'message' => 'Blog not found.'], 404);
        }

        $data = $this->requestPayload();
        $data = $this->sanitizeBlogData($data);
        $errors = $this->validateBlog($data, $id);

        if (!empty($errors)) {
            json_response(['status' => 'error', 'errors' => $errors], 422);
        }

        $data['slug'] = $this->resolveSlug($data, $id);
        $data['banner_image'] = $this->handleBannerUpload($_FILES['banner_image'] ?? null, $existing['banner_image']);

        $this->blog->update($id, $data);
        $item = $this->blog->find($id);

        json_response(['status' => 'success', 'message' => 'Blog updated.', 'data' => $item]);
    }

    public function delete(int $id): void
    {
        $existing = $this->blog->find($id);
        if ($existing === null) {
            json_response(['status' => 'error', 'message' => 'Blog not found.'], 404);
        }

        $this->blog->delete($id);
        json_response(['status' => 'success', 'message' => 'Blog deleted.']);
    }

    public function listCategories(): void
    {
        $items = $this->category->all();
        json_response(['status' => 'success', 'data' => $items]);
    }

    public function createCategory(): void
    {
        $body = $this->requestPayload();
        $name = trim((string) ($body['name'] ?? ''));
        $slug = trim((string) ($body['slug'] ?? '')) ?: $this->category->normalizeSlug($name);
        $errors = [];

        if ($name === '') {
            $errors['name'] = 'Category name is required.';
        }

        if ($slug === '') {
            $errors['slug'] = 'Slug is required.';
        } elseif ($this->category->slugExists($slug)) {
            $errors['slug'] = 'Slug must be unique.';
        }

        if (!empty($errors)) {
            json_response(['status' => 'error', 'errors' => $errors], 422);
        }

        $id = $this->category->create(['name' => $name, 'slug' => $slug]);
        $item = $this->category->find($id);
        json_response(['status' => 'success', 'message' => 'Category created.', 'data' => $item], 201);
    }

    public function updateCategory(int $id): void
    {
        $existing = $this->category->find($id);
        if ($existing === null) {
            json_response(['status' => 'error', 'message' => 'Category not found.'], 404);
        }

        $body = $this->requestPayload();
        $name = trim((string) ($body['name'] ?? ''));
        $slug = trim((string) ($body['slug'] ?? '')) ?: $this->category->normalizeSlug($name, $id);
        $errors = [];

        if ($name === '') {
            $errors['name'] = 'Category name is required.';
        }

        if ($slug === '') {
            $errors['slug'] = 'Slug is required.';
        } elseif ($this->category->slugExists($slug, $id)) {
            $errors['slug'] = 'Slug must be unique.';
        }

        if (!empty($errors)) {
            json_response(['status' => 'error', 'errors' => $errors], 422);
        }

        $this->category->update($id, ['name' => $name, 'slug' => $slug]);
        $item = $this->category->find($id);
        json_response(['status' => 'success', 'message' => 'Category updated.', 'data' => $item]);
    }

    public function deleteCategory(int $id): void
    {
        $existing = $this->category->find($id);
        if ($existing === null) {
            json_response(['status' => 'error', 'message' => 'Category not found.'], 404);
        }

        $this->category->delete($id);
        json_response(['status' => 'success', 'message' => 'Category deleted.']);
    }

    private function requestPayload(): array
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        if (str_contains($contentType, 'application/json')) {
            $body = json_decode(file_get_contents('php://input'), true);
            return is_array($body) ? $body : [];
        }

        return $_POST;
    }

    private function sanitizeBlogData(array $input): array
    {
        return [
            'category_id' => isset($input['category_id']) && is_numeric($input['category_id']) ? (int) $input['category_id'] : null,
            'title' => trim((string) ($input['title'] ?? '')),
            'slug' => trim((string) ($input['slug'] ?? '')),
            'excerpt' => trim((string) ($input['excerpt'] ?? '')),
            'content' => trim((string) ($input['content'] ?? '')),
            'banner_image' => trim((string) ($input['banner_image'] ?? '')),
            'author' => trim((string) ($input['author'] ?? '')),
            'published_at' => trim((string) ($input['published_at'] ?? '')) ?: null,
        ];
    }

    private function validateBlog(array $data, ?int $excludeId = null): array
    {
        $errors = [];

        if ($data['title'] === '') {
            $errors['title'] = 'Title is required.';
        }

        if ($data['slug'] !== '' && $this->blog->slugExists($data['slug'], $excludeId)) {
            $errors['slug'] = 'Slug must be unique.';
        }

        if ($data['category_id'] !== null && $this->category->find($data['category_id']) === null) {
            $errors['category_id'] = 'Selected category does not exist.';
        }

        if ($data['published_at'] !== null && strtotime($data['published_at']) === false) {
            $errors['published_at'] = 'Published date must be a valid datetime.';
        }

        return $errors;
    }

    private function resolveSlug(array $data, ?int $excludeId = null): string
    {
        if ($data['slug'] !== '') {
            return $this->blog->normalizeSlug($data['slug'], $excludeId);
        }

        return $this->blog->normalizeSlug($data['title'], $excludeId);
    }

    private function handleBannerUpload(?array $file, string $existingPath = ''): string
    {
        if (empty($file) || empty($file['name'])) {
            return $existingPath;
        }

        $err = '';
        $uploaded = upload_file($file, $err, 'blogs', 1200, 630);
        return $uploaded ?: $existingPath;
    }
}
