<?php

namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;

class Database implements DatabaseInterface
{
    /**
     * @var \PDO
     */
    private \PDO $pdo;

    /**
     * @param ConfigInterface $config
     */
    public function __construct(private ConfigInterface $config)
    {
        $this->connect();
    }

    public function insert(string $table, array $data): int|false
    {
        $fields = array_keys($data);

        $columns = implode(',', $fields);
        $binds = implode(',', array_map(fn ($field) => ":$field", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            return false;
        }

        return $this->pdo->lastInsertId();
    }

    /** внедрить расширенный поиск по нескольким полям */
    public function findBy(string $table, array $data): bool
    {
        if (count($data) !== 1) {
            throw new \InvalidArgumentException("Data array must contain exactly one key-value pair.");
        }

        $column = key($data);
        $value = reset($data);

        $sql = "SELECT $column FROM $table WHERE $column = :value";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(['value' => $value]);

        return (bool)$stmt->fetch();
    }

    private function connect(): void
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');

        try {
            $this->pdo = new \PDO(
                "$driver:host=$host;port=$port;dbname=$database;charset=$charset",
                $username,
                $password
            );
        } catch (\PDOException $exception) {
            exit("Database connection failed: {$exception->getMessage()}");
        }
    }
}