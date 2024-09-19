<?php

namespace App\Kernel\Auth;

class User
{
    /**
     * @param int $id
     * @param string $email
     * @param string $password
     */
    public function __construct(
        private readonly int    $id,
        private readonly string $email,
        private readonly string $password,
    )
    {
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }
}