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

    /**
     * Validate a field against a specific validation rule.
     *
     * Available validation rules:
     *
     * - `required`: Ensures the field is not empty.
     * - `min`: Ensures the field has a minimum length. Requires an integer value as the second parameter.
     * - `max`: Ensures the field has a maximum length. Requires an integer value as the second parameter.
     * - `email`: Ensures the field contains a valid email address.
     * - `unique`: Ensures the field value is unique in the database. Requires the table name as the second parameter.
     * - `confirmed`: Ensures the field has a matching `{field}_confirmation` field in the data.
     *
     * @param string $key The name of the field to validate.
     * @param string $ruleName The validation rule to apply.
     *     - `required`
     *     - `min`: Requires `$ruleValue` as the minimum length.
     *     - `max`: Requires `$ruleValue` as the maximum length.
     *     - `email`
     *     - `unique`: Requires `$ruleValue` as the database table name.
     *     - `confirmed`: Checks if the field matches `{key}_confirmation`.
     * @param string|null $ruleValue The additional value for the rule (used with `min`, `max`, `unique`).
     * @return false|string Returns `false` if the validation passes, or an error message string if it fails.
     */
    private function validateRule(string $key, string $ruleName, string $ruleValue = null): false|string
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
                if ($this->db->findBy($ruleValue, [$key => $value])) {
                    return "Field $key must be unique in database";
                }
                break;
            case 'confirmed':
                if ($value !== $this->data["{$key}_confirmation"]) {
                    return "Field $key must be confirmed";
                }
                break;
        }

        return false;
    }
}