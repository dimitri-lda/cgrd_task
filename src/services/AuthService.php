<?php

require_once 'AuthServiceInterface.php';

class AuthService implements AuthServiceInterface {
    private const VALID_USERNAME = 'admin';
    private const VALID_PASSWORD = 'test';

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public function login(string $username, string $password): bool
    {
        if ($username === self::VALID_USERNAME && $password === self::VALID_PASSWORD) {
            $_SESSION['logged_in'] = true;
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        session_destroy();
    }
}
