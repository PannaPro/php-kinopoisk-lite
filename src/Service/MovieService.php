<?php

namespace App\Service;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\Request;

class MovieService
{
    public function __construct(
        private DatabaseInterface $db,
    )
    {
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