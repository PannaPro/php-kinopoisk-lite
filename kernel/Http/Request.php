<?php

namespace App\Kernel\Http;

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