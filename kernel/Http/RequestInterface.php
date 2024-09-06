<?php

namespace App\Kernel\Http;

use App\Kernel\Validator\ValidatorInterface;

interface RequestInterface
{
    public static function createFromGlobal(): static;

    public function uri(): string;

    public function method(): string;

    public function input(string $key, $default = null);

    public function setValidator(ValidatorInterface $validator): void;

    public function validate(array $rules): bool;

    public function errors(): array;

}