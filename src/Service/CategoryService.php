<?php

namespace App\Service;

use App\Entity\Category;
use App\Kernel\Database\DatabaseInterface;
class CategoryService
{
    public function __construct(
        private DatabaseInterface $db,
    )
    {
    }

    /**
     * @param string $name
     * @return int
     */
    public function create(string $name): int
    {
        $id = $this->db->insert('categories', [
            'name' => $name,
        ]);

        return $id;
    }

    /**
     * @return Category[]
     */
    public function all(): array
    {
        $categories = $this->db->find('categories');

        $categories = array_map(function ($category) {
            return new Category(
                $category['id'],
                $category['name']
            );
        }, $categories);

        return $categories;
    }

    /**
     * @param string $id
     * @return Category|null
     */
    public function findCategory(string $id): ?Category
    {
        $category = $this->db->findBy('categories', ['id' => $id]);

        if (!empty($category)) {
            return new Category(
                $category['id'],
                $category['name']
            );
        }

        return null;
    }

    public function update(int $id, string $name): void
    {
        $name = mb_convert_case(trim($name), MB_CASE_TITLE, "UTF-8");

        $this->db->update('categories', [
            'name' => $name,
        ], [
            'id' => $id,
        ]
        );
    }


    /**
     * @param int $id
     * @return void
     */
    public function remove(int $id): void
    {
        $this->db->remove('categories', ['id' => $id]);
    }


}