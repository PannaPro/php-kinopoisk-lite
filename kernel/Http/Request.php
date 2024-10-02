<?php

namespace App\Kernel\Http;

use App\Kernel\Upload\UploadedFile;
use App\Kernel\Upload\UploadedFileInterface;
use App\Kernel\Validator\ValidatorInterface;

class Request implements RequestInterface
{
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    public function __construct(
        public readonly array $get,
        public readonly array $post,
        public readonly array $server,
        public readonly array $files,
        public readonly array $cookies
    )
    {
    }

    /**
     * @return static
     */
    public static function createFromGlobal(): static
    {
        return new static($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE);
    }

    public static function post(): array
    {
        return $_POST;
    }

    /**
     * @return string
     */
    public function uri(): string
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    /**
     * @return string
     */
    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    /**
     * @param string $key
     * @param $default
     * @return mixed|null
     */
    public function input(string $key, $default = null)
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function getContent(): array
    {
        return array_filter($this->post ?? [], function ($value) {
            return !(is_string($value) && trim($value) === '');
        });
    }

    /**
     * Retrieves and filters the content of an uploaded file by the specified key.
     *
     * This method checks if a file exists under the provided key in the files array.
     * If found, it returns the file's data, filtering out empty or whitespace-only values.
     * If the key does not exist, an empty array is returned.
     *
     * @param string $key The key identifying the uploaded file in the files array.
     * @return array The filtered data of the uploaded file, or an empty array if the file doesn't exist.
     */
    public function getFileContent(string $key): array
    {
        if (!isset($this->files[$key])) {
            return [];
        }

        return array_filter($this->files[$key], function ($value) {
            return !(is_string($value) && trim($value) === '');
        });
    }


    /**
     * @param string $key
     * @return UploadedFileInterface|null
     */
    public function file(string $key): ?UploadedFileInterface
    {
        if (!isset($this->files[$key])) {
            return null;
        }

        return new UploadedFile(
            $this->files[$key]['name'],
            $this->files[$key]['type'],
            $this->files[$key]['tmp_name'],
            $this->files[$key]['error'],
            $this->files[$key]['size'],
        );
    }

    /**
     * @param ValidatorInterface $validator
     * @return void
     */
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    /**
     * @param array $rules
     * @return bool
     */
    public function validate(array $rules): bool
    {
        $data = [];

        foreach ($rules as $field => $rule) {
            $data[$field] = $this->input($field);
        }

        return $this->validator->validate($data, $rules);
    }

    /**
     * @return array
     */
    public function errors(): array
    {
        return  $this->validator->errors();
    }
}