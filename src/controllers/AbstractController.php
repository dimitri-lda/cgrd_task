<?php

abstract class AbstractController
{
    protected const LOGIN_REDIRECT = 'index.php?controller=login&action=index';

    abstract public function index(): void;

    protected function sendJsonResponse(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
    }
}