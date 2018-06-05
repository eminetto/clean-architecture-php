<?php
namespace Bookmark\UseCase;

use Bookmark\Entity\Bookmark;
use Bookmark\Driver\RepositoryInterface;

class Service implements UseCaseInterface
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function search(string $query)
    {
        return $this->repository->search($query);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function store(Bookmark $bookmark): int
    {
        $bookmark->createdAt = new \Datetime();
        return $this->repository->store($bookmark);
    }

    public function delete(int $id) : bool
    {
        $b = $this->repository->find($id);
        if ($b->favorite) {
            return false;
        }
        return $this->repository->delete($id);
    }
}