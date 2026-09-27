<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/BaseModel.php';

class VideoModel extends BaseModel
{
    public function allActive(int $limit = 12, int $offset = 0, ?string $category = null, string $search = ''): array
    {
        if (!$this->db) {
            return array_slice($this->allFromDemo('videos'), $offset, $limit);
        }

        $sql = 'SELECT * FROM videos WHERE status = \'active\'';
        $params = [];

        if ($category !== null && $category !== 'all' && $category !== '') {
            $sql .= ' AND category = :category';
            $params[':category'] = $category;
        }

        if ($search !== '') {
            $sql .= ' AND (title LIKE :search OR description LIKE :search2)';
            $params[':search'] = '%' . $search . '%';
            $params[':search2'] = '%' . $search . '%';
        }

        // Check if DB is empty and sync if needed
        $checkStmt = $this->db->query("SELECT COUNT(*) FROM videos WHERE status = 'active'");
        if ((int)$checkStmt->fetchColumn() === 0 && ($category === null || $category === 'all' || $category === '') && $search === '') {
            $this->syncFromChannel();
        }

        $sql .= ' ORDER BY is_featured DESC, created_at DESC LIMIT :limit OFFSET :offset';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTotalActiveCount(?string $category = null, string $search = ''): int
    {
        if (!$this->db) {
            return count($this->allFromDemo('videos'));
        }

        $sql = 'SELECT COUNT(*) FROM videos WHERE status = \'active\'';
        $params = [];

        if ($category !== null && $category !== 'all' && $category !== '') {
            $sql .= ' AND category = :category';
            $params[':category'] = $category;
        }

        if ($search !== '') {
            $sql .= ' AND (title LIKE :search OR description LIKE :search2)';
            $params[':search'] = '%' . $search . '%';
            $params[':search2'] = '%' . $search . '%';
        }

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function all(int $limit = 100): array
    {
        if (!$this->db) {
            return $this->allFromDemo('videos');
        }
        $stmt = $this->db->prepare('SELECT * FROM videos ORDER BY created_at DESC LIMIT :limit');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare('SELECT * FROM videos WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public static function extractYoutubeId(string $url): string
    {
        $url = trim($url);
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $url, $matches)) {
            return $matches[1];
        }
        return strlen($url) === 11 ? $url : 'dQw4w9WgXcQ';
    }

    public function create(array $data): int
    {
        if (!$this->db) return 0;
        $youtubeId = self::extractYoutubeId($data['youtube_url'] ?? '');
        $thumbnail = !empty($data['thumbnail']) ? $data['thumbnail'] : "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";

        $stmt = $this->db->prepare('INSERT INTO videos (title, youtube_url, youtube_id, category, description, duration, thumbnail, views_count, is_featured, status) 
            VALUES (:title, :youtube_url, :youtube_id, :category, :description, :duration, :thumbnail, :views_count, :is_featured, :status)');
        
        $stmt->execute([
            ':title' => ps_decode_entities($data['title'] ?? ''),
            ':youtube_url' => trim($data['youtube_url'] ?? ''),
            ':youtube_id' => $youtubeId,
            ':category' => trim($data['category'] ?? 'General'),
            ':description' => ps_decode_entities($data['description'] ?? ''),
            ':duration' => trim($data['duration'] ?? '05:00'),
            ':thumbnail' => $thumbnail,
            ':views_count' => (int)($data['views_count'] ?? 100),
            ':is_featured' => !empty($data['is_featured']) ? 1 : 0,
            ':status' => $data['status'] ?? 'active',
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        if (!$this->db) return false;
        $youtubeId = self::extractYoutubeId($data['youtube_url'] ?? '');
        $thumbnail = !empty($data['thumbnail']) ? $data['thumbnail'] : "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";

        $stmt = $this->db->prepare('UPDATE videos SET title = :title, youtube_url = :youtube_url, youtube_id = :youtube_id, category = :category, description = :description, duration = :duration, thumbnail = :thumbnail, is_featured = :is_featured, status = :status WHERE id = :id');
        
        return $stmt->execute([
            ':title' => ps_decode_entities($data['title'] ?? ''),
            ':youtube_url' => trim($data['youtube_url'] ?? ''),
            ':youtube_id' => $youtubeId,
            ':category' => trim($data['category'] ?? 'General'),
            ':description' => ps_decode_entities($data['description'] ?? ''),
            ':duration' => trim($data['duration'] ?? '05:00'),
            ':thumbnail' => $thumbnail,
            ':is_featured' => !empty($data['is_featured']) ? 1 : 0,
            ':status' => $data['status'] ?? 'active',
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('DELETE FROM videos WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function syncFromChannel(?string $channelUrl = null): bool
    {
        if (!$this->db) return false;

        $channelId = 'UCmg3GmAt6xN7S2-BpAoXrmw';
        $feedUrl = "https://www.youtube.com/feeds/videos.xml?channel_id={$channelId}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $feedUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $xmlContent = curl_exec($ch);

        if (empty($xmlContent)) return false;

        $xml = @simplexml_load_string($xmlContent);
        if (!$xml || !isset($xml->entry)) return false;

        $this->db->exec("TRUNCATE TABLE videos;");
        $stmt = $this->db->prepare("INSERT INTO videos (title, youtube_url, youtube_id, category, description, duration, thumbnail, views_count, is_featured, status) VALUES (:title, :youtube_url, :youtube_id, :category, :description, :duration, :thumbnail, :views_count, :is_featured, 'active')");

        $count = 0;
        foreach ($xml->entry as $entry) {
            $ytId = (string) $entry->children('yt', true)->videoId;
            $title = trim((string) $entry->title);
            $media = $entry->children('media', true)->group;
            $desc = trim((string) ($media->description ?? ''));

            $thumb = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
            $ytUrl = "https://www.youtube.com/watch?v={$ytId}";

            $category = 'जन-चौपाल';
            if (preg_match('/कविता|काव्य|सम्मेलन|साहित्य|अवधी|गीत/iu', $title)) {
                $category = 'अवधी साहित्य';
            } elseif (preg_match('/वृक्ष|पौधा|हरियाली|ग्रीन|पर्यावरण/iu', $title)) {
                $category = 'पर्यावरण चेतना';
            } elseif (preg_match('/पक्षीयों|परिंदा|जलपात्र|वन्यजीव/iu', $title)) {
                $category = 'वन्यजीव संरक्षण';
            } elseif (preg_match('/साक्षात्कार|इंटरव्यू|न्यूज़|मीडिया|दूरदर्शन/iu', $title)) {
                $category = 'मीडिया साक्षात्कार';
            }

            try {
                $stmt->execute([
                    ':title' => ps_decode_entities($title),
                    ':youtube_url' => $ytUrl,
                    ':youtube_id' => $ytId,
                    ':category' => $category,
                    ':description' => ps_decode_entities($desc),
                    ':duration' => '05:30',
                    ':thumbnail' => $thumb,
                    ':views_count' => rand(150, 850),
                    ':is_featured' => ($count < 2) ? 1 : 0,
                ]);
                $count++;
            } catch (Throwable $e) {
                // ignore single row error
            }
        }
        return $count > 0;
    }
}
