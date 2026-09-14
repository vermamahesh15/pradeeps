<?php

declare(strict_types=1);

class BaseModel
{
    protected ?PDO $db = null;
    protected array $demo = [];

    public function __construct()
    {
        $this->demo = require __DIR__ . '/../includes/data.php';
        $this->db = $this->connect();
    }

    protected function connect(): ?PDO
    {
        try {
            $db = db_config();
            $dsn = sprintf(
                '%s:host=%s;port=%d;dbname=%s;charset=%s',
                $db['driver'],
                $db['host'],
                $db['port'],
                $db['database'],
                $db['charset']
            );
            return new PDO($dsn, $db['username'], $db['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (Throwable $exception) {
            if (ini_get('display_errors')) {
                echo "<div style='font-family:sans-serif; padding:20px; background:#fef2f2; border:2px solid #ef4444; color:#991b1b; border-radius:12px; margin:20px;'>";
                echo "<h3 style='margin-top:0;'>⚠️ Database Connection Error</h3>";
                echo "<p><strong>Message:</strong> " . htmlspecialchars($exception->getMessage()) . "</p>";
                echo "<p><strong>DB Host:</strong> " . htmlspecialchars($db['host'] ?? '') . "</p>";
                echo "<p><strong>DB Name:</strong> " . htmlspecialchars($db['database'] ?? '') . "</p>";
                echo "<p><strong>DB User:</strong> " . htmlspecialchars($db['username'] ?? '') . "</p>";
                echo "<hr style='border-color:#fca5a5;'>";
                echo "<p style='font-size:13px; color:#7f1d1d;'>Check Hostinger hPanel &rarr; MySQL Databases to verify your Database Name, Username, and Password in <code>config/database.php</code>.</p>";
                echo "</div>";
                exit;
            }
            return null;
        }
    }

    protected function allFromDemo(string $key): array
    {
        return $this->demo[$key] ?? [];
    }

    protected function settingFromDemo(string $key, $default = null)
    {
        return $this->demo['settings'][$key] ?? $default;
    }

    public function getConnection(): ?PDO
    {
        return $this->db;
    }
}
