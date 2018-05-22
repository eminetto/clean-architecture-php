<?php

namespace Bookmark\UseCase;

use Bookmark\Entity\Bookmark;

interface RepositoryInterface
{
    public function find(int $id) : Bookmark;

    public function search(string $query);

    public function findAll();

    public function store(Bookmark $bookmark): int;

    public function delete(int $id) : bool;
}
