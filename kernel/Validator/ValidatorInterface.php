<?php

namespace App\Kernel\Validator;

interface ValidatorInterface
{
    /** Validations
     * @param array $date
     * @param array $rules
     * @return bool
     */
    public function validate(array $date, array $rules): bool;

    public function errors(): array;

}