<?php

namespace App\Kernel\Database;

interface DatabaseInterface
{
    public function insert(string $table, array $data): int|false;

    public function find(string $table, array $conditions = []): array;

    public function findBy(string $table, array $conditions = []): array;

    public function first(string $table, array $conditions = []): ?array;

    public function update(string $table, array $data, array $conditions = []): void;

    public function remove(string $table, array $conditions = []): void;
}