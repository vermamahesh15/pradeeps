<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/../includes/helpers.php';

class PersonalPhotoModel extends BaseModel
{
    private static bool $tableEnsured = false;

    public function __construct()
    {
        parent::__construct();
        $this->ensureDirs();
        $this->ensureTable();
    }

    /**
     * Ensure upload directories exist and permissions are open.
     */
    public function ensureDirs(): void
    {
        $root = realpath(__DIR__ . '/..') ?: dirname(__DIR__);
        $dirs = [
            $root . '/uploads',
            $root . '/uploads/about',
            $root . '/uploads/about/thumbs'
        ];
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }
            @chmod($dir, 0777);
        }
    }

    /**
     * Automatically ensures the table exists.
     */
    public function ensureTable(): void
    {
        if (self::$tableEnsured || !$this->db) {
            return;
        }

        try {
            $sql = "CREATE TABLE IF NOT EXISTS `about_personal_photos` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `title` VARCHAR(190) NULL,
                `caption` TEXT NULL,
                `photo_path` VARCHAR(255) NOT NULL,
                `thumbnail_path` VARCHAR(255) NULL,
                `alt_text` VARCHAR(255) NULL,
                `location` VARCHAR(190) NULL,
                `photo_date` DATE NULL,
                `photo_year` VARCHAR(20) NULL,
                `display_order` INT NOT NULL DEFAULT 0,
                `status` ENUM('published', 'hidden') NOT NULL DEFAULT 'published',
                `uploaded_by` INT NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX `idx_status_order` (`status`, `display_order` ASC),
                INDEX `idx_uploaded_by` (`uploaded_by`),
                INDEX `idx_photo_year` (`photo_year`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
            
            $this->db->exec($sql);
            self::$tableEnsured = true;
        } catch (\Throwable $e) {
            // Log or continue silently if already created
        }
    }

    /**
     * Get all photographs (for admin listing).
     */
    public function all(string $statusFilter = 'all', string $search = ''): array
    {
        if (!$this->db) return [];

        $sql = "SELECT p.*, u.name AS uploader_name, u.email AS uploader_email 
                FROM `about_personal_photos` p 
                LEFT JOIN `users` u ON p.uploaded_by = u.id 
                WHERE 1=1";
        $params = [];

        if ($statusFilter !== 'all' && in_array($statusFilter, ['published', 'hidden'], true)) {
            $sql .= " AND p.status = :status";
            $params[':status'] = $statusFilter;
        }

        if ($search !== '') {
            $sql .= " AND (p.title LIKE :search OR p.caption LIKE :search OR p.location LIKE :search OR p.photo_year LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        $sql .= " ORDER BY p.display_order ASC, p.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Get all published photos for public frontend About page.
     */
    public function allPublished(): array
    {
        if (!$this->db) return [];

        $sql = "SELECT * FROM `about_personal_photos` 
                WHERE `status` = 'published' 
                ORDER BY `display_order` ASC, `created_at` DESC";
        $stmt = $this->db->query($sql);
        return $stmt ? $stmt->fetchAll() : [];
    }

    /**
     * Find single photo by ID.
     */
    public function find(int $id): ?array
    {
        if (!$this->db) return null;

        $stmt = $this->db->prepare("SELECT p.*, u.name AS uploader_name 
            FROM `about_personal_photos` p 
            LEFT JOIN `users` u ON p.uploaded_by = u.id 
            WHERE p.id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Get next display order number.
     */
    public function getNextOrder(): int
    {
        if (!$this->db) return 1;
        $stmt = $this->db->query("SELECT MAX(display_order) FROM `about_personal_photos`");
        $max = (int)$stmt->fetchColumn();
        return $max + 1;
    }

    /**
     * Create a new photograph record.
     */
    public function create(array $data): int
    {
        if (!$this->db) return 0;

        $stmt = $this->db->prepare("INSERT INTO `about_personal_photos` 
            (title, caption, photo_path, thumbnail_path, alt_text, location, photo_date, photo_year, display_order, status, uploaded_by) 
            VALUES (:title, :caption, :photo_path, :thumbnail_path, :alt_text, :location, :photo_date, :photo_year, :display_order, :status, :uploaded_by)");

        $order = isset($data['display_order']) && is_numeric($data['display_order']) 
            ? (int)$data['display_order'] 
            : $this->getNextOrder();

        $photoDate = !empty($data['photo_date']) ? $data['photo_date'] : null;
        $photoYear = !empty($data['photo_year']) ? trim((string)$data['photo_year']) : null;
        if (empty($photoYear) && !empty($photoDate)) {
            $photoYear = substr($photoDate, 0, 4);
        }

        $stmt->execute([
            ':title'          => !empty($data['title']) ? trim((string)$data['title']) : null,
            ':caption'        => !empty($data['caption']) ? trim((string)$data['caption']) : null,
            ':photo_path'     => $data['photo_path'],
            ':thumbnail_path' => $data['thumbnail_path'] ?? null,
            ':alt_text'       => !empty($data['alt_text']) ? trim((string)$data['alt_text']) : (!empty($data['title']) ? trim((string)$data['title']) : 'Pradeep Sarang Photograph'),
            ':location'       => !empty($data['location']) ? trim((string)$data['location']) : null,
            ':photo_date'     => $photoDate,
            ':photo_year'     => $photoYear,
            ':display_order'  => $order,
            ':status'         => in_array($data['status'] ?? 'published', ['published', 'hidden'], true) ? $data['status'] : 'published',
            ':uploaded_by'    => !empty($data['uploaded_by']) ? (int)$data['uploaded_by'] : null,
        ]);

        return (int)$this->db->lastInsertId();
    }

    /**
     * Update an existing photograph record.
     */
    public function update(int $id, array $data): bool
    {
        if (!$this->db) return false;

        $fields = [];
        $params = [':id' => $id];

        $allowed = [
            'title', 'caption', 'photo_path', 'thumbnail_path', 'alt_text',
            'location', 'photo_date', 'photo_year', 'display_order', 'status'
        ];

        foreach ($allowed as $field) {
            if (array_key_exists($field, $data)) {
                $fields[] = "`$field` = :$field";
                $val = $data[$field];
                if ($field === 'display_order') {
                    $val = (int)$val;
                } elseif (in_array($field, ['title', 'caption', 'alt_text', 'location', 'photo_year'], true)) {
                    $val = ($val !== '' && $val !== null) ? trim((string)$val) : null;
                } elseif ($field === 'photo_date') {
                    $val = !empty($val) ? $val : null;
                }
                $params[":$field"] = $val;
            }
        }

        if (empty($fields)) {
            return false;
        }

        $sql = "UPDATE `about_personal_photos` SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Delete photo record and associated physical files.
     */
    public function delete(int $id): bool
    {
        if (!$this->db) return false;

        $photo = $this->find($id);
        if (!$photo) return false;

        $stmt = $this->db->prepare("DELETE FROM `about_personal_photos` WHERE id = :id");
        $deleted = $stmt->execute([':id' => $id]);

        if ($deleted) {
            $root = realpath(__DIR__ . '/..') ?: dirname(__DIR__);
            $filesToDelete = array_filter([$photo['photo_path'] ?? null, $photo['thumbnail_path'] ?? null]);
            foreach ($filesToDelete as $relPath) {
                // Security check: ensure path is within uploads/
                $relPath = ltrim(str_replace('\\', '/', $relPath), '/');
                if (str_starts_with($relPath, 'uploads/')) {
                    $fullPath = $root . '/' . $relPath;
                    if (file_exists($fullPath) && is_file($fullPath)) {
                        @unlink($fullPath);
                    }
                }
            }
        }

        return $deleted;
    }

    /**
     * Toggle status between 'published' and 'hidden'.
     */
    public function toggleStatus(int $id): ?string
    {
        if (!$this->db) return null;

        $photo = $this->find($id);
        if (!$photo) return null;

        $newStatus = ($photo['status'] === 'published') ? 'hidden' : 'published';
        $stmt = $this->db->prepare("UPDATE `about_personal_photos` SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $newStatus, ':id' => $id]);
        return $newStatus;
    }

    /**
     * Update multiple photo display orders at once.
     */
    public function updateOrders(array $orderMap): bool
    {
        if (!$this->db || empty($orderMap)) return false;

        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("UPDATE `about_personal_photos` SET display_order = :order WHERE id = :id");
            foreach ($orderMap as $id => $order) {
                $stmt->execute([
                    ':order' => (int)$order,
                    ':id'    => (int)$id
                ]);
            }
            $this->db->commit();
            return true;
        } catch (\Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            return false;
        }
    }

    /**
     * Total count helper.
     */
    public function countAll(): int
    {
        if (!$this->db) return 0;
        $stmt = $this->db->query("SELECT COUNT(*) FROM `about_personal_photos`");
        return (int)$stmt->fetchColumn();
    }

    /**
     * Published count helper.
     */
    public function countPublished(): int
    {
        if (!$this->db) return 0;
        $stmt = $this->db->query("SELECT COUNT(*) FROM `about_personal_photos` WHERE `status` = 'published'");
        return (int)$stmt->fetchColumn();
    }

    /**
     * Safely delete physical files from disk.
     */
    public function deletePhysicalFiles(?string $photoPath, ?string $thumbPath = null): void
    {
        $root = realpath(__DIR__ . '/..') ?: dirname(__DIR__);
        $files = array_filter([$photoPath, $thumbPath]);
        foreach ($files as $relPath) {
            $clean = ltrim(str_replace('\\', '/', $relPath), '/');
            if (str_starts_with($clean, 'uploads/')) {
                $full = $root . '/' . $clean;
                if (file_exists($full) && is_file($full)) {
                    @unlink($full);
                }
            }
        }
    }

    /**
     * Process an uploaded image of any format (.png, .jpg, .jpeg, .gif, .webp, .bmp):
     * 1. Validates upload integrity and MIME image type.
     * 2. Auto-rotates image if EXIF orientation is present (smartphones/cameras).
     * 3. Converts image completely to WebP format.
     * 4. Saves .webp in uploads/about/.
     * 5. Ensures any initial temporary/source non-webp file is cleanly removed.
     * 6. Generates high-quality WebP thumbnail in uploads/about/thumbs/.
     * 
     * @return array{photo_path: string, thumbnail_path: string}|null
     */
    public function processUploadedPhoto(array $file, ?string &$error = null, int $maxWidth = 2000, int $maxHeight = 2000): ?array
    {
        $error = '';
        if (empty($file) || !isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            $error = 'No photo file was selected.';
            return null;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $error = 'Upload failed with error code: ' . $file['error'];
            return null;
        }

        $tmpPath = $file['tmp_name'];
        if (!is_uploaded_file($tmpPath) && !file_exists($tmpPath)) {
            $error = 'Invalid uploaded file source.';
            return null;
        }

        $imgInfo = @getimagesize($tmpPath);
        if ($imgInfo === false) {
            $error = 'The uploaded file is not a valid image format. Allowed formats: JPG, JPEG, PNG, WEBP, GIF, BMP.';
            return null;
        }

        $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP, IMAGETYPE_GIF];
        if (defined('IMAGETYPE_BMP')) {
            $allowedTypes[] = IMAGETYPE_BMP;
        }

        if (!in_array($imgInfo[2], $allowedTypes, true)) {
            $error = 'Unsupported image format. Allowed formats: JPG, JPEG, PNG, WEBP, GIF, BMP.';
            return null;
        }

        if (!extension_loaded('gd') || !function_exists('imagewebp')) {
            $error = 'GD library with WebP support is required on the server.';
            return null;
        }

        $raw = @file_get_contents($tmpPath);
        $srcImg = $raw ? @imagecreatefromstring($raw) : false;
        if (!$srcImg) {
            $error = 'Failed to parse image data via GD library.';
            return null;
        }

        // Auto-rotate based on EXIF orientation if available (especially from iPhones/smartphones)
        if (function_exists('exif_read_data') && $imgInfo[2] === IMAGETYPE_JPEG) {
            try {
                $exif = @exif_read_data($tmpPath);
                if (!empty($exif['Orientation'])) {
                    switch ($exif['Orientation']) {
                        case 3:
                            $rotated = imagerotate($srcImg, 180, 0);
                            if ($rotated) { imagedestroy($srcImg); $srcImg = $rotated; }
                            break;
                        case 6:
                            $rotated = imagerotate($srcImg, -90, 0);
                            if ($rotated) { imagedestroy($srcImg); $srcImg = $rotated; }
                            break;
                        case 8:
                            $rotated = imagerotate($srcImg, 90, 0);
                            if ($rotated) { imagedestroy($srcImg); $srcImg = $rotated; }
                            break;
                    }
                }
            } catch (\Throwable $e) {
                // Continue if EXIF read fails
            }
        }

        $origW = imagesx($srcImg);
        $origH = imagesy($srcImg);

        // Calculate aspect ratio scale to keep within max limits
        $scale = min(1.0, min($maxWidth / $origW, $maxHeight / $origH));
        $targetW = max(1, (int)round($origW * $scale));
        $targetH = max(1, (int)round($origH * $scale));

        $mainImg = imagecreatetruecolor($targetW, $targetH);
        imagealphablending($mainImg, false);
        imagesavealpha($mainImg, true);
        $transparent = imagecolorallocatealpha($mainImg, 255, 255, 255, 127);
        imagefilledrectangle($mainImg, 0, 0, $targetW, $targetH, $transparent);
        imagecopyresampled($mainImg, $srcImg, 0, 0, 0, 0, $targetW, $targetH, $origW, $origH);

        $root = realpath(__DIR__ . '/..') ?: dirname(__DIR__);
        $aboutDir = $root . '/uploads/about';
        $thumbDir = $root . '/uploads/about/thumbs';

        if (!is_dir($aboutDir)) @mkdir($aboutDir, 0775, true);
        if (!is_dir($thumbDir)) @mkdir($thumbDir, 0775, true);

        $cleanOrigName = pathinfo($file['name'], PATHINFO_FILENAME);
        $cleanSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cleanOrigName), '-')) ?: 'photo';
        $cleanSlug = substr($cleanSlug, 0, 35);
        $uniqueId = uniqid('ps_');

        $mainFilename = $uniqueId . '_' . $cleanSlug . '.webp';
        $mainDestPath = $aboutDir . '/' . $mainFilename;

        // Save main image converted to WebP (88% quality)
        $savedMain = @imagewebp($mainImg, $mainDestPath, 88);
        imagedestroy($mainImg);

        if (!$savedMain || !file_exists($mainDestPath) || filesize($mainDestPath) === 0) {
            imagedestroy($srcImg);
            $error = 'Failed to convert and save image as .webp format.';
            return null;
        }

        // Generate WebP thumbnail (450x450, 82% quality)
        $thumbScale = min(1.0, min(450 / $origW, 450 / $origH));
        $thumbW = max(1, (int)round($origW * $thumbScale));
        $thumbH = max(1, (int)round($origH * $thumbScale));

        $thumbImg = imagecreatetruecolor($thumbW, $thumbH);
        imagealphablending($thumbImg, false);
        imagesavealpha($thumbImg, true);
        $transparentThumb = imagecolorallocatealpha($thumbImg, 255, 255, 255, 127);
        imagefilledrectangle($thumbImg, 0, 0, $thumbW, $thumbH, $transparentThumb);
        imagecopyresampled($thumbImg, $srcImg, 0, 0, 0, 0, $thumbW, $thumbH, $origW, $origH);

        $thumbFilename = 'thumb_' . $uniqueId . '_' . $cleanSlug . '.webp';
        $thumbDestPath = $thumbDir . '/' . $thumbFilename;

        $savedThumb = @imagewebp($thumbImg, $thumbDestPath, 82);
        imagedestroy($thumbImg);
        imagedestroy($srcImg);

        // Delete initial temporary / uploaded file to ensure non-webp source is deleted
        if (file_exists($tmpPath) && is_file($tmpPath)) {
            @unlink($tmpPath);
        }

        $relPhotoPath = 'uploads/about/' . $mainFilename;
        $relThumbPath = ($savedThumb && file_exists($thumbDestPath)) ? 'uploads/about/thumbs/' . $thumbFilename : $relPhotoPath;

        return [
            'photo_path' => $relPhotoPath,
            'thumbnail_path' => $relThumbPath
        ];
    }

    /**
     * Generate an optimized WebP thumbnail from an existing image path.
     */
    public function generateThumbnail(string $sourceRelativePath, int $thumbWidth = 420, int $thumbHeight = 420): ?string
    {
        $root = realpath(__DIR__ . '/..') ?: dirname(__DIR__);
        $srcPath = $root . '/' . ltrim($sourceRelativePath, '/');

        if (!file_exists($srcPath) || !is_file($srcPath)) {
            return null;
        }

        if (!extension_loaded('gd') || !function_exists('imagewebp')) {
            return $sourceRelativePath;
        }

        $raw = @file_get_contents($srcPath);
        $srcImg = $raw ? @imagecreatefromstring($raw) : false;
        if (!$srcImg) {
            return $sourceRelativePath;
        }

        $origW = imagesx($srcImg);
        $origH = imagesy($srcImg);

        // Aspect fit thumbnail
        $scale = min(1.0, min($thumbWidth / $origW, $thumbHeight / $origH));
        $targetW = max(1, (int)round($origW * $scale));
        $targetH = max(1, (int)round($origH * $scale));

        $dstImg = imagecreatetruecolor($targetW, $targetH);
        imagealphablending($dstImg, false);
        imagesavealpha($dstImg, true);
        $transparent = imagecolorallocatealpha($dstImg, 255, 255, 255, 127);
        imagefilledrectangle($dstImg, 0, 0, $targetW, $targetH, $transparent);

        imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $targetW, $targetH, $origW, $origH);

        $thumbDir = $root . '/uploads/about/thumbs';
        if (!is_dir($thumbDir)) {
            @mkdir($thumbDir, 0775, true);
        }

        $baseName = pathinfo($srcPath, PATHINFO_FILENAME);
        $thumbFilename = 'thumb_' . $baseName . '.webp';
        $destPath = $thumbDir . '/' . $thumbFilename;

        $saved = @imagewebp($dstImg, $destPath, 82);

        imagedestroy($srcImg);
        imagedestroy($dstImg);

        if ($saved && file_exists($destPath) && filesize($destPath) > 0) {
            return 'uploads/about/thumbs/' . $thumbFilename;
        }

        return $sourceRelativePath;
    }
}
