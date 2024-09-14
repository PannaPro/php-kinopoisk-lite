<?php

namespace App\Kernel\Validator;

use App\Kernel\Database\DatabaseInterface;

class Validator implements ValidatorInterface
{
    private array $data;
    private array $errors = [];

    public function __construct(private DatabaseInterface $db)
    {
    }

    public function validate(array $date, array $rules): bool
    {
        $this->errors = [];
        $this->data = $date;

        foreach ($rules as $key => $fields) {
            foreach ($fields as $rule) {

                $rule = explode(':', $rule);

                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                $error = $this->validateRule($key, $ruleName, $ruleValue);

                if ($error){
                    $this->errors[$key][] = $error;
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function validateRule(string $key, string $ruleName, string $ruleValue = null): false|string
    {
        $value = $this->data[$key];

        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    return "Field $key is required";
                }
                break;
            case 'min':
                if (strlen($value) < $ruleValue) {
                    return "Field $key must be at least {$ruleValue} characters long";
                }
                break;
            case 'max':
                if (strlen($value) > $ruleValue) {
                    return "Field $key must be at less {$ruleValue} characters long";
                }
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return "Field $key must be type of email";
                }
                break;
            case 'unique':
                if ($this->db->findBy('user', [$key => $this->data[$key]])) {
                    return "Field $key must be unique in database";
                }
                break;
        }

        return false;
    }
}