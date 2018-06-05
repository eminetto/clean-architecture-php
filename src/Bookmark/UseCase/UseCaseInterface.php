<?php

namespace Bookmark\UseCase;

use Bookmark\Entity\Bookmark;
use Bookmark\Driver\RepositoryInterface;

interface UseCaseInterface
{
    public function __construct(RepositoryInterface $repository);

    public function search(string $query);

    public function findAll();

    public function store(Bookmark $bookmark): int;

    public function delete(int $id) : bool;
}