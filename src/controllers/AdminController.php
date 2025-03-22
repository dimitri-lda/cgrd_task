<?php

require_once 'models/Database.php';
require_once 'models/NewsRepositoryInterface.php';
require_once 'services/AuthServiceInterface.php';
require_once 'AbstractController.php';

class AdminController extends AbstractController
{
    private const MSG_FILL_ALL_FIELDS = 'Please fill in all fields.';
    private const MSG_UNAUTHORIZED = 'Unauthorized';
    private const MSG_INVALID_NEWS_ID = 'Invalid News ID!';

    public function __construct(
        private readonly NewsRepositoryInterface $newsRepository,
        private readonly AuthServiceInterface $auth
    ) {
    }

    public function index(): void
    {
        if (!$this->auth->isLoggedIn()) {
            $this->redirect(self::LOGIN_REDIRECT);
        }
        include 'views/admin.php';
    }

    public function list(): void
    {
        $this->authorize();

        $newsList = $this->newsRepository->getAll();
        $this->sendJsonResponse(['newsList' => $newsList, 'success' => true]);
    }

    public function create(): void
    {
        $this->authorize();

        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if (empty($title) || empty($content)) {
            $this->sendJsonResponse(['message' => self::MSG_FILL_ALL_FIELDS, 'success' => false], 400);
        }

        $msg = $this->newsRepository->create($title, $content);
        $this->sendJsonResponse(['message' => $msg, 'success' => true]);
    }

    public function update(): void
    {
        $this->authorize();

        $id = $_POST['id'] ?? '';
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if (empty($id) || empty($title) || empty($content)) {
            $this->sendJsonResponse(['message' => self::MSG_FILL_ALL_FIELDS, 'success' => false], 400);
        }

        $msg = $this->newsRepository->update($id, $title, $content);
        $this->sendJsonResponse(['message' => $msg, 'success' => true]);
    }

    public function delete(): void
    {
        $this->authorize();

        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            $this->sendJsonResponse(['message' => self::MSG_INVALID_NEWS_ID], 400);
        }

        $msg = $this->newsRepository->delete($id);
        $this->sendJsonResponse(['message' => $msg, 'success' => true]);
    }

    private function authorize(): void
    {
        if (!$this->auth->isLoggedIn()) {
            $this->sendJsonResponse(['message' => self::MSG_UNAUTHORIZED, 'success' => false], 401);
        }
    }
}
