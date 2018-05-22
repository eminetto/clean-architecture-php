<?php

namespace Bookmark\UseCase;

use Bookmark\Entity\Bookmark;

class InmemRepository implements RepositoryInterface
{
    private $ids;
    private $bookmarks;

    public function find(int $id) : Bookmark
    {
        return $this->bookmarks[$id];
    }

    //@todo implement exception
    public function search(string $query)
    {
        foreach ($this->bookmarks as $key => $value) {
            if ($value->name == $query) {
                return $value;
            }
        }
    }

    public function findAll()
    {
        return $this->bookmarks;
    }

    public function store(Bookmark $bookmark): int
    {
        $this->ids++;
        $bookmark->id = $this->ids;
        $this->bookmarks[$this->ids] = $bookmark;
        return $this->ids;
    }

    public function delete(int $id) : bool
    {
        unset($this->bookmarks[$id]);
        return true;
    }
}