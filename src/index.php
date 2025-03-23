<?php

require_once 'models/Database.php';

session_start();

$controller = $_GET['controller'] ?? 'login';
$action = $_GET['action'] ?? 'index';

try {
    $ctrl = getControllerInstance($controller);

    if (!method_exists($ctrl, $action)) {
        throw new BadMethodCallException("Action not found");
    }

    $ctrl->{$action}();
} catch (Exception $e) {
    die($e->getMessage());
}

/**
 * @throws InvalidArgumentException
 */
function getControllerInstance(string $controller)
{
    return match ($controller) {
        'login' => createLoginController(),
        'admin' => createAdminController(),
        default => throw new InvalidArgumentException("Controller not found"),
    };
}

function createLoginController(): LoginController
{
    require_once 'controllers/LoginController.php';
    require_once 'services/AuthService.php';

    return new LoginController(new AuthService());
}

function createAdminController(): AdminController
{
    require_once 'controllers/AdminController.php';
    require_once 'models/News.php';
    require_once 'services/AuthService.php';

    return new AdminController(
        new News(Database::getInstance()->getConnection()),
        new AuthService()
    );
}
