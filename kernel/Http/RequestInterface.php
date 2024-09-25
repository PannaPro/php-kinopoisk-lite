<?php

namespace App\Kernel\Http;

use App\Kernel\Upload\UploadedFileInterface;
use App\Kernel\Validator\ValidatorInterface;

interface RequestInterface
{
    public static function createFromGlobal(): static;

    public function uri(): string;

    public function method(): string;

    public function input(string $key, $default = null);

    public function file(string $key): ?UploadedFileInterface;

    public function setValidator(ValidatorInterface $validator): void;

    /**
     * Validate multiple fields against an array of validation rules.
     *
     * The `$rules` array should have the following structure:
     *
     * ```php
     * [
     *     'field_name' => ['rule1', 'rule2:parameter', ...],
     *     'email' => ['required', 'email'],
     *     'password' => ['required', 'min:8', 'confirmed'],
     *     'username' => ['required', 'unique:users', 'min:3', 'max:20'],
     * ]
     * ```
     *
     * Available validation rules:
     * - `required`: Ensures the field is not empty.
     * - `min:value`: Ensures the field has a minimum length or value.
     * - `max:value`: Ensures the field has a maximum length or value.
     * - `email`: Ensures the field contains a valid email address.
     * - `unique:table`: Ensures the field value is unique in the specified database table.
     * - `confirmed`: Ensures the field has a matching `{field}_confirmation` field.
     *
     * @param array $rules An array of validation rules where the key is the field name and the value is an array of rules.
     * @return bool Returns `true` if all fields pass validation, `false` otherwise.
     */
    public function validate(array $rules): bool;

    public function errors(): array;

}