<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseModel.php';

class UserModel extends BaseModel
{
    public function find(int $id): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        if (!$this->db) return null;
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function all(int $limit = 100, int $offset = 0): array
    {
        if (!$this->db) return [];
        $stmt = $this->db->prepare('SELECT * FROM users ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create(array $data): int
    {
        if (!$this->db) return 0;
        $stmt = $this->db->prepare('INSERT INTO users (name, email, password, role, status, biography, facebook_link, twitter_link, linkedin_link, profile_photo) 
            VALUES (:name, :email, :password, :role, :status, :biography, :facebook_link, :twitter_link, :linkedin_link, :profile_photo)');
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':role' => $data['role'] ?? 'author',
            ':status' => $data['status'] ?? 'active',
            ':biography' => $data['biography'] ?? null,
            ':facebook_link' => $data['facebook_link'] ?? null,
            ':twitter_link' => $data['twitter_link'] ?? null,
            ':linkedin_link' => $data['linkedin_link'] ?? null,
            ':profile_photo' => $data['profile_photo'] ?? null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        if (!$this->db) return false;
        
        $fields = [
            'name = :name',
            'email = :email',
            'role = :role',
            'status = :status',
            'biography = :biography',
            'facebook_link = :facebook_link',
            'twitter_link = :twitter_link',
            'linkedin_link = :linkedin_link'
        ];
        
        $params = [
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':role' => $data['role'],
            ':status' => $data['status'],
            ':biography' => $data['biography'] ?? null,
            ':facebook_link' => $data['facebook_link'] ?? null,
            ':twitter_link' => $data['twitter_link'] ?? null,
            ':linkedin_link' => $data['linkedin_link'] ?? null,
            ':id' => $id
        ];

        if (!empty($data['password'])) {
            $fields[] = 'password = :password';
            $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        if (array_key_exists('profile_photo', $data)) {
            $fields[] = 'profile_photo = :profile_photo';
            $params[':profile_photo'] = $data['profile_photo'];
        }

        $sql = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function updateLastLogin(int $id): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('UPDATE users SET last_login = NOW() WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function changePassword(int $id, string $newPassword): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('UPDATE users SET password = :password WHERE id = :id');
        return $stmt->execute([
            ':password' => password_hash($newPassword, PASSWORD_DEFAULT),
            ':id' => $id
        ]);
    }

    // Audit Logging
    public function logAudit(int $userId, string $action, ?string $ip, ?string $userAgent): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('INSERT INTO audit_logs (user_id, action, ip_address, user_agent) VALUES (:user_id, :action, :ip, :ua)');
        return $stmt->execute([
            ':user_id' => $userId,
            ':action' => $action,
            ':ip' => $ip,
            ':ua' => $userAgent
        ]);
    }

    public function getAuditLogs(?int $userId = null, int $limit = 50): array
    {
        if (!$this->db) return [];
        $sql = 'SELECT a.*, u.name AS user_name, u.email AS user_email 
                FROM audit_logs a 
                LEFT JOIN users u ON a.user_id = u.id';
        $params = [];
        if ($userId !== null) {
            $sql .= ' WHERE a.user_id = :user_id';
            $params[':user_id'] = $userId;
        }
        $sql .= ' ORDER BY a.created_at DESC LIMIT :limit';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Notifications
    public function addNotification(int $userId, string $title, string $message): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('INSERT INTO notifications (user_id, title, message) VALUES (:user_id, :title, :message)');
        return $stmt->execute([
            ':user_id' => $userId,
            ':title' => $title,
            ':message' => $message
        ]);
    }

    public function getNotifications(int $userId, bool $unreadOnly = false): array
    {
        if (!$this->db) return [];
        $sql = 'SELECT * FROM notifications WHERE user_id = :user_id';
        if ($unreadOnly) {
            $sql .= ' AND is_read = 0';
        }
        $sql .= ' ORDER BY created_at DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function markNotificationsRead(int $userId): bool
    {
        if (!$this->db) return false;
        $stmt = $this->db->prepare('UPDATE notifications SET is_read = 1 WHERE user_id = :user_id');
        return $stmt->execute([':user_id' => $userId]);
    }

    public function getUnreadNotificationsCount(int $userId): int
    {
        if (!$this->db) return 0;
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM notifications WHERE user_id = :user_id AND is_read = 0');
        $stmt->execute([':user_id' => $userId]);
        return (int) $stmt->fetchColumn();
    }
}
