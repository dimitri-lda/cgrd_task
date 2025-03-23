<?php

require_once 'services/AuthServiceInterface.php';
require_once 'AbstractController.php';

class LoginController extends AbstractController {
    private const VIEW_ADMIN = 'views/admin.php';
    private const VIEW_LOGIN = 'views/login.php';

    private const MSG_WRONG_CREDENTIALS = 'Wrong Login Data!';

    public function __construct(
        private readonly AuthServiceInterface $auth
    ) {
    }

    public function index(): void
    {
        include $this->auth->isLoggedIn() ? self::VIEW_ADMIN : self::VIEW_LOGIN;
    }

    public function authenticate(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($this->auth->login($username, $password)) {
            $this->sendJsonResponse(['success' => true]);
        } else {
            $this->sendJsonResponse(['success' => false, 'message' => self::MSG_WRONG_CREDENTIALS], 401);
        }
    }

    public function logout(): void
    {
        $this->auth->logout();
        $this->sendJsonResponse(['success' => true]);
    }
}
