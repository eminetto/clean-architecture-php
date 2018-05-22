<?php
namespace Bookmark\UseCase;

use Bookmark\Entity\Bookmark;

class Service implements UseCaseInterface, RepositoryInterface
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function find(int $id) : Bookmark
    {
        return $this->repository->find($id);
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
        return $this->repository->store($bookmark);
    }

    public function delete(int $id) : bool
    {
        $b = $this->find($id);
        if ($b->favorite) {
            return false;
        }
        return $this->repository->delete($id);
    }
}