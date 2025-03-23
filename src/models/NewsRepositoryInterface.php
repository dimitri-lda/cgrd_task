<?php

interface NewsRepositoryInterface {
    public function getAll(): array;
    public function create(string $title, string $content): string;
    public function update(int $id, string $title, string $content): string;
    public function delete(int $id): string;
}
