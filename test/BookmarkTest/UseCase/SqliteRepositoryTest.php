<?php

declare(strict_types=1);

namespace BookmarkTest\UseCase;

use Bookmark\UseCase\SqliteRepository;
use PHPUnit\Framework\TestCase;
use Bookmark\UseCase\Service;
use Bookmark\Entity\Bookmark;

class SqliteRepositoryTest extends TestCase
{
    private $conn;
    private $repo;

    public function setup()
    {
        $this->conn = $conn = new \PDO('sqlite::memory:');
        $this->repo = new SqliteRepository($this->conn);
    }
    
    public function testStore()
    {
        $b = new Bookmark;
        $b->name = 'Elton Minetto';
        $b->description = 'Minettos page';
        $b->link = 'http://www.eltonminetto.net';
        $b->tags = ["golang", "php", "linux", "mac"];
        $b->favorite = true;

        $id = $this->repo->store($b);
        $this->assertEquals(1, $id);
    }

    public function testSearchAndFindAll()
    {
        $b = new Bookmark;
        $b->name = 'Elton Minetto';
        $b->description = 'Minettos page';
        $b->link = 'http://www.eltonminetto.net';
        $b->tags = ["golang", "php", "linux", "mac"];
        $b->favorite = true;

        $b2 = new Bookmark;
        $b2->name = 'Google';
        $b2->description = 'Google';
        $b2->link = 'http://google.com';
        $b2->tags = ["search", "engine"];
        $b2->favorite = false;

        $id = $this->repo->store($b);
        $id2 = $this->repo->store($b2);
        
        $s1 = $this->repo->search('Elton Minetto');
        $this->assertEquals(1, $s1[0]->id);
        $all = $this->repo->findAll();
        $this->assertEquals(1, $all[0]->id);
        $this->assertEquals(2, $all[1]->id);
    }

    public function testDelete()
    {
        $b = new Bookmark;
        $b->name = 'Elton Minetto';
        $b->description = 'Minettos page';
        $b->link = 'http://www.eltonminetto.net';
        $b->tags = ["golang", "php", "linux", "mac"];
        $b->favorite = true;

        $b2 = new Bookmark;
        $b2->name = 'Google';
        $b2->description = 'Google';
        $b2->link = 'http://google.com';
        $b2->tags = ["search", "engine"];
        $b2->favorite = false;

        $id = $this->repo->store($b);
        $id2 = $this->repo->store($b2);

        $deleted = $this->repo->delete($id);
        $this->assertEquals(true, $deleted);

        $deleted = $this->repo->delete($id2);
        $this->assertEquals(true, $deleted);
    }
}
