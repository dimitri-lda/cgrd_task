<?php

require_once 'NewsRepositoryInterface.php';

class News implements NewsRepositoryInterface
{
    private const QUERY_GET_ALL = "SELECT * FROM news ORDER BY created_at DESC";
    private const QUERY_INSERT = "INSERT INTO news (title, content) VALUES (?, ?)";
    private const QUERY_UPDATE = "UPDATE news SET title = ?, content = ? WHERE id = ?";
    private const QUERY_DELETE = "DELETE FROM news WHERE id = ?";

    private const MSG_CREATE_SUCCESS = "News was successfully created!";
    private const MSG_CREATE_ERROR = "Error: News was not created!";
    private const MSG_UPDATE_SUCCESS = "News was successfully updated!";
    private const MSG_UPDATE_ERROR = "Error: News was not updated!";
    private const MSG_DELETE_SUCCESS = "News was deleted!";
    private const MSG_DELETE_ERROR = "Error: News was not deleted!";

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query(self::QUERY_GET_ALL);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($title, $content): string
    {
        $stmt = $this->pdo->prepare(self::QUERY_INSERT);
        return $stmt->execute([$title, $content]) ? self::MSG_CREATE_SUCCESS : self::MSG_CREATE_ERROR;
    }

    public function update($id, $title, $content): string
    {
        $stmt = $this->pdo->prepare(self::QUERY_UPDATE);
        return $stmt->execute([$title, $content, $id]) ? self::MSG_UPDATE_SUCCESS : self::MSG_UPDATE_ERROR;
    }

    public function delete($id): string
    {
        $stmt = $this->pdo->prepare(self::QUERY_DELETE);
        return $stmt->execute([$id]) ? self::MSG_DELETE_SUCCESS : self::MSG_DELETE_ERROR;
    }
}
