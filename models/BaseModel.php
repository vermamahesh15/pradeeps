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
}
