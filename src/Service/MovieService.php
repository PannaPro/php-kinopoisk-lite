<?php

namespace App\Service;

use App\Entity\Movie;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\Request;

class MovieService
{
    public function __construct(
        private DatabaseInterface $db,
    )
    {
    }

    /**
     * @return Movie[]
     */
    public function all(): array
    {
        $movies = $this->db->find('movies');

        $movies = array_map(function ($movie) {
            if ($movie['category_id']) {
               $category = $this->db->findBy('categories', ['id' => $movie['category_id']]);
            }

            if ($movie['image_file_id']) {
                $file = $this->db->findBy('files', ['id' => $movie['image_file_id']]);
            }

            return new Movie(
                $movie['id'],
                $movie['name'],
                $movie['description'],
                $movie['director'],
                $movie['duration'],
                $category ?? null,
                $file['url'] ?? null,
            );
        }, $movies);

        return $movies;
    }

    public function create(Request $request, string $filePath): void
    {
        $file = $request->getFileContent('image');

        if (isset($file['name'])) {
            $fileId = $this->db->insert('files', [
                'name' => $file['name'],
                'url' => $filePath,
                'mime' => $file['type'] ?? null,
                'size' => $file['size'] ?? null,
            ]);
        }

        $data = $request->getContent();

        $id = $this->db->insert('movies', [
            'name' => $data['name'],
            'description' => $data['description'],
            'category_id' => $data['category'] ?? null,
            'director' => $data['director'] ?? null,
            'duration' => isset($data['duration']) ? intval($data['duration']) : null,
            'image_file_id' => $fileId ?? null,
        ]);
    }
}