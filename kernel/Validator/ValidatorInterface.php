<?php

namespace App\Kernel\Validator;

interface ValidatorInterface
{
    public function validate(array $date, array $rules): bool;

    public function errors(): array;

}