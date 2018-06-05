<?php

declare(strict_types=1);

namespace BookmarkTest\UseCase;

use Bookmark\Driver\InmemRepository;
use PHPUnit\Framework\TestCase;
use Bookmark\UseCase\Service;
use Bookmark\Entity\Bookmark;

class ServiceTest extends TestCase
{
    private $repo;
    private $service;

    public function setup()
    {
        $this->repo = new InmemRepository;
        $this->service = new Service($this->repo);
    }

    public function testStore()
    {
        $b = new Bookmark;
        $b->name = 'Elton Minetto';
        $b->description = 'Minettos page';
        $b->link = 'http://www.eltonminetto.net';
        $b->tags = ["golang", "php", "linux", "mac"];
        $b->favorite = true;

        $id = $this->service->store($b);
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

        $id = $this->service->store($b);
        $this->assertEquals(1, $id);
        $id2 = $this->service->store($b2);
        $this->assertEquals(2, $id2);

        $s1 = $this->service->search('Elton Minetto');
        $this->assertEquals(1, $s1->id);
        $all = $this->service->findAll();
        $this->assertEquals(1, $all[1]->id);
        $this->assertEquals(2, $all[2]->id);
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

        $id = $this->service->store($b);
        $id2 = $this->service->store($b2);

        $deleted = $this->service->delete($id);
        $this->assertEquals(false, $deleted);

        $deleted = $this->service->delete($id2);
        $this->assertEquals(true, $deleted);
    }
}
