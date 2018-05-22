<?php

declare(strict_types=1);

namespace BookmarkTest\UseCase;

use Bookmark\UseCase\InmemRepository;
use PHPUnit\Framework\TestCase;
use Bookmark\UseCase\Service;
use Bookmark\Entity\Bookmark;

class ServiceTest extends TestCase
{
    public function testStore()
    {
        $repo = new InmemRepository;
        $service = new Service($repo);
        $b = new Bookmark;
        $b->name = 'Elton Minetto';
        $b->description = 'Minettos page';
        $b->link = 'http://www.eltonminetto.net';
        $b->tags = ["golang", "php", "linux", "mac"];
        $b->favorite = true;

        $id = $service->store($b);
        $this->assertEquals(1, $id);
    }

    public function testSearchAndFindAll()
    {
        $repo = new InmemRepository;
        $service = new Service($repo);
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

        $id = $service->store($b);
        $this->assertEquals(1, $id);
        $id2 = $service->store($b2);
        $this->assertEquals(2, $id2);

        $s1 = $service->search('Elton Minetto');
        $this->assertEquals(1, $s1->id);
        $all = $service->findAll();
        $this->assertEquals(1, $all[1]->id);
        $this->assertEquals(2, $all[2]->id);
    }

    public function testDelete()
    {
        $repo = new InmemRepository;
        $service = new Service($repo);
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

        $id = $service->store($b);
        $id2 = $service->store($b2);

        $deleted = $service->delete($id);
        $this->assertEquals(false, $deleted);

        $deleted = $service->delete($id2);
        $this->assertEquals(true, $deleted);

    }
}
