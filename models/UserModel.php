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

    private function ensureExtraColumns(): void
    {
        if (!$this->db) return;
        static $checked = false;
        if ($checked) return;
        $checked = true;

        $columns = [
            'designation' => 'VARCHAR(255) NULL',
            'location' => 'VARCHAR(255) NULL',
            'section_badge' => 'VARCHAR(255) NULL',
            'inspiring_quote' => 'TEXT NULL',
            'stat_badges' => 'VARCHAR(255) NULL',
            'whatsapp_link' => 'VARCHAR(255) NULL',
            'youtube_link' => 'VARCHAR(255) NULL',
            'instagram_link' => 'VARCHAR(255) NULL',
        ];

        foreach ($columns as $col => $type) {
            try {
                $this->db->exec("ALTER TABLE users ADD COLUMN {$col} {$type}");
            } catch (\Throwable $e) {
                // Column exists
            }
        }
    }

    public function create(array $data): int
    {
        if (!$this->db) return 0;
        $this->ensureExtraColumns();

        $stmt = $this->db->prepare('INSERT INTO users (name, email, password, role, status, biography, designation, location, section_badge, inspiring_quote, stat_badges, facebook_link, twitter_link, linkedin_link, whatsapp_link, youtube_link, instagram_link, profile_photo) 
            VALUES (:name, :email, :password, :role, :status, :biography, :designation, :location, :section_badge, :inspiring_quote, :stat_badges, :facebook_link, :twitter_link, :linkedin_link, :whatsapp_link, :youtube_link, :instagram_link, :profile_photo)');
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':role' => $data['role'] ?? 'author',
            ':status' => $data['status'] ?? 'active',
            ':biography' => $data['biography'] ?? null,
            ':designation' => $data['designation'] ?? null,
            ':location' => $data['location'] ?? null,
            ':section_badge' => $data['section_badge'] ?? null,
            ':inspiring_quote' => $data['inspiring_quote'] ?? null,
            ':stat_badges' => $data['stat_badges'] ?? null,
            ':facebook_link' => $data['facebook_link'] ?? null,
            ':twitter_link' => $data['twitter_link'] ?? null,
            ':linkedin_link' => $data['linkedin_link'] ?? null,
            ':whatsapp_link' => $data['whatsapp_link'] ?? null,
            ':youtube_link' => $data['youtube_link'] ?? null,
            ':instagram_link' => $data['instagram_link'] ?? null,
            ':profile_photo' => $data['profile_photo'] ?? null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        if (!$this->db) return false;
        $this->ensureExtraColumns();
        
        $fields = [
            'name = :name',
            'email = :email',
            'role = :role',
            'status = :status',
            'biography = :biography',
            'designation = :designation',
            'location = :location',
            'section_badge = :section_badge',
            'inspiring_quote = :inspiring_quote',
            'stat_badges = :stat_badges',
            'facebook_link = :facebook_link',
            'twitter_link = :twitter_link',
            'linkedin_link = :linkedin_link',
            'whatsapp_link = :whatsapp_link',
            'youtube_link = :youtube_link',
            'instagram_link = :instagram_link'
        ];
        
        $params = [
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':role' => $data['role'],
            ':status' => $data['status'],
            ':biography' => $data['biography'] ?? null,
            ':designation' => $data['designation'] ?? null,
            ':location' => $data['location'] ?? null,
            ':section_badge' => $data['section_badge'] ?? null,
            ':inspiring_quote' => $data['inspiring_quote'] ?? null,
            ':stat_badges' => $data['stat_badges'] ?? null,
            ':facebook_link' => $data['facebook_link'] ?? null,
            ':twitter_link' => $data['twitter_link'] ?? null,
            ':linkedin_link' => $data['linkedin_link'] ?? null,
            ':whatsapp_link' => $data['whatsapp_link'] ?? null,
            ':youtube_link' => $data['youtube_link'] ?? null,
            ':instagram_link' => $data['instagram_link'] ?? null,
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

    public function getPublicAuthors(?string $role = null, int $limit = 6, int $offset = 0, string $search = ''): array
    {
        $authors = [];
        if ($this->db) {
            try {
                $sql = "SELECT id, name, email, role, status, biography, profile_photo, facebook_link, twitter_link, linkedin_link, created_at FROM users WHERE status = 'active'";
                $params = [];
                if ($role !== null && $role !== '' && $role !== 'all') {
                    $sql .= " AND role = :role";
                    $params[':role'] = $role;
                }
                if ($search !== '') {
                    $sql .= " AND (name LIKE :search OR biography LIKE :search)";
                    $params[':search'] = '%' . $search . '%';
                }
                $sql .= " ORDER BY id ASC LIMIT :limit OFFSET :offset";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                foreach ($params as $k => $v) {
                    $stmt->bindValue($k, $v);
                }
                $stmt->execute();
                $authors = $stmt->fetchAll();
            } catch (Throwable $e) {}
        }

        if (empty($authors)) {
            $demo = $this->allFromDemo('authors');
            if (empty($demo)) {
                $demo = $this->allFromDemo('team');
            }
            if ($role !== null && $role !== '' && $role !== 'all') {
                $demo = array_values(array_filter($demo, fn($item) => ($item['role'] ?? '') === $role));
            }
            if ($search !== '') {
                $demo = array_values(array_filter($demo, fn($item) => mb_stripos($item['name'] ?? '', $search) !== false || mb_stripos($item['biography'] ?? $item['role_title'] ?? '', $search) !== false));
            }
            $authors = array_slice($demo, $offset, $limit);
        }

        return $authors;
    }

    public function getTotalPublicAuthorsCount(?string $role = null, string $search = ''): int
    {
        if ($this->db) {
            try {
                $sql = "SELECT COUNT(*) FROM users WHERE status = 'active'";
                $params = [];
                if ($role !== null && $role !== '' && $role !== 'all') {
                    $sql .= " AND role = :role";
                    $params[':role'] = $role;
                }
                if ($search !== '') {
                    $sql .= " AND (name LIKE :search OR biography LIKE :search)";
                    $params[':search'] = '%' . $search . '%';
                }
                $stmt = $this->db->prepare($sql);
                foreach ($params as $k => $v) {
                    $stmt->bindValue($k, $v);
                }
                $stmt->execute();
                $count = (int)$stmt->fetchColumn();
                if ($count > 0) return $count;
            } catch (Throwable $e) {}
        }
        $demo = $this->allFromDemo('authors');
        if ($role !== null && $role !== '' && $role !== 'all') {
            $demo = array_values(array_filter($demo, fn($item) => ($item['role'] ?? '') === $role));
        }
        if ($search !== '') {
            $demo = array_values(array_filter($demo, fn($item) => mb_stripos($item['name'] ?? '', $search) !== false || mb_stripos($item['biography'] ?? '', $search) !== false));
        }
        return count($demo);
    }

    public function getAdminUsersFiltered(string $roleFilter = '', string $statusFilter = '', string $search = '', int $limit = 10, int $offset = 0): array
    {
        $hideSuperAdmin = (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'super_admin');
        if ($this->db) {
            try {
                $sql = "SELECT * FROM users WHERE 1=1";
                $params = [];
                if ($hideSuperAdmin) {
                    $sql .= " AND role != 'super_admin'";
                }
                if ($roleFilter !== '' && $roleFilter !== 'all') {
                    $sql .= " AND role = :role";
                    $params[':role'] = $roleFilter;
                }
                if ($statusFilter !== '' && $statusFilter !== 'all') {
                    $sql .= " AND status = :status";
                    $params[':status'] = $statusFilter;
                }
                if ($search !== '') {
                    $sql .= " AND (name LIKE :search OR email LIKE :search OR biography LIKE :search)";
                    $params[':search'] = '%' . $search . '%';
                }
                $sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
                $stmt = $this->db->prepare($sql);
                foreach ($params as $k => $v) {
                    $stmt->bindValue($k, $v);
                }
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $dbUsers = $stmt->fetchAll();
                if ($dbUsers !== false) return $dbUsers;
            } catch (Throwable $e) {}
        }

        // Demo data fallback for admin listing
        $demo = [
            ['id' => 1, 'name' => 'Super Admin', 'email' => 'admin@example.com', 'role' => 'super_admin', 'status' => 'active', 'biography' => 'Chief Content Director and Platform Administrator', 'last_login' => '2026-09-06 09:00:00', 'profile_photo' => null],
            ['id' => 2, 'name' => 'Admin User', 'email' => 'admin2@example.com', 'role' => 'admin', 'status' => 'active', 'biography' => 'Content Manager & Event Coordinator', 'last_login' => null, 'profile_photo' => null],
            ['id' => 3, 'name' => 'Author User', 'email' => 'author@example.com', 'role' => 'author', 'status' => 'active', 'biography' => 'Awadhi Literature & Environment Columnist', 'last_login' => null, 'profile_photo' => null],
            ['id' => 4, 'name' => 'Pradeep Sarang', 'email' => 'pradeep@sarang.org', 'role' => 'author', 'status' => 'active', 'biography' => 'Social Reformer, Environmentalist, Awadhi Writer', 'last_login' => '2026-09-05 18:30:00', 'profile_photo' => null],
            ['id' => 5, 'name' => 'Dr. Ramsevak Tripathi', 'email' => 'ramsevak@awadh.org', 'role' => 'author', 'status' => 'active', 'biography' => 'Retired Professor of Hindi & Awadhi Literature', 'last_login' => null, 'profile_photo' => null],
            ['id' => 6, 'name' => 'Smt. Sunita Verma', 'email' => 'sunita@greengang.org', 'role' => 'author', 'status' => 'active', 'biography' => 'Environment Campaign Leader & Social Worker', 'last_login' => null, 'profile_photo' => null],
            ['id' => 7, 'name' => 'Acharya Devashish', 'email' => 'devashish@culture.in', 'role' => 'author', 'status' => 'active', 'biography' => 'Spiritual Scholar & Awadhi Culture Researcher', 'last_login' => null, 'profile_photo' => null],
        ];

        if ($hideSuperAdmin) {
            $demo = array_values(array_filter($demo, fn($u) => ($u['role'] ?? '') !== 'super_admin'));
        }
        if ($roleFilter !== '' && $roleFilter !== 'all') {
            $demo = array_values(array_filter($demo, fn($u) => $u['role'] === $roleFilter));
        }
        if ($statusFilter !== '' && $statusFilter !== 'all') {
            $demo = array_values(array_filter($demo, fn($u) => $u['status'] === $statusFilter));
        }
        if ($search !== '') {
            $demo = array_values(array_filter($demo, fn($u) => mb_stripos($u['name'] . ' ' . $u['email'] . ' ' . $u['biography'], $search) !== false));
        }
        return array_slice($demo, $offset, $limit);
    }

    public function getAdminUsersFilteredCount(string $roleFilter = '', string $statusFilter = '', string $search = ''): int
    {
        $hideSuperAdmin = (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'super_admin');
        if ($this->db) {
            try {
                $sql = "SELECT COUNT(*) FROM users WHERE 1=1";
                $params = [];
                if ($hideSuperAdmin) {
                    $sql .= " AND role != 'super_admin'";
                }
                if ($roleFilter !== '' && $roleFilter !== 'all') {
                    $sql .= " AND role = :role";
                    $params[':role'] = $roleFilter;
                }
                if ($statusFilter !== '' && $statusFilter !== 'all') {
                    $sql .= " AND status = :status";
                    $params[':status'] = $statusFilter;
                }
                if ($search !== '') {
                    $sql .= " AND (name LIKE :search OR email LIKE :search OR biography LIKE :search)";
                    $params[':search'] = '%' . $search . '%';
                }
                $stmt = $this->db->prepare($sql);
                foreach ($params as $k => $v) {
                    $stmt->bindValue($k, $v);
                }
                $stmt->execute();
                return (int)$stmt->fetchColumn();
            } catch (Throwable $e) {}
        }

        $list = $this->getAdminUsersFiltered($roleFilter, $statusFilter, $search, 1000, 0);
        return count($list);
    }

    public function getRolePermissions(): array
    {
        $defaults = [
            'super_admin' => ['dashboard', 'authors', 'timeline', 'blogs', 'categories', 'events', 'campaigns', 'donations', 'donation_settings', 'gallery', 'newspaper', 'volunteers', 'role_access', 'settings', 'audit_logs'],
            'admin'       => ['dashboard', 'authors', 'timeline', 'blogs', 'categories', 'events', 'campaigns', 'donations', 'donation_settings', 'gallery', 'newspaper', 'volunteers'],
            'author'      => ['dashboard', 'blogs', 'categories', 'profile', 'change_password'],
        ];

        require_once __DIR__ . '/ContentModel.php';
        $content = new ContentModel();
        $saved = $content->getSettings()['role_module_permissions'] ?? null;
        if ($saved) {
            $decoded = json_decode($saved, true);
            if (is_array($decoded)) {
                return array_merge($defaults, $decoded);
            }
        }
        return $defaults;
    }

    public function updateRolePermissions(array $permissions): bool
    {
        require_once __DIR__ . '/ContentModel.php';
        $content = new ContentModel();
        return $content->updateSettings([
            'role_module_permissions' => json_encode($permissions, JSON_UNESCAPED_UNICODE)
        ]);
    }

    public function isModuleAllowed(string $role, string $module): bool
    {
        if ($role === 'super_admin') return true;
        $perms = $this->getRolePermissions();
        $allowed = $perms[$role] ?? [];
        return in_array($module, $allowed, true);
    }
}
