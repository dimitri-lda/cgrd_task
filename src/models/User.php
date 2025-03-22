<?php
class User {
    private const ADMIN_USERNAME = 'admin';
    private const ADMIN_PASSWORD = 'test';

    private string $username;
    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate(): bool
    {
        return $this->username === self::ADMIN_USERNAME && $this->password === self::ADMIN_PASSWORD;
    }
}
