<?php

declare(strict_types=1);

namespace BookmarkTest\Handler;

use Bookmark\UseCase\SqliteRepository;
use Bookmark\UseCase\SqliteRepositoryFactory;
use Bookmark\UseCase\RepositoryInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class SqliteRepositoryFactoryTest extends TestCase
{
    public function testFactory()
    {
        $config = [
            'db' => [
                'dsn' => 'sqlite:data/bookmark.sqlite3',
            ],
        ];
        $this->container = $this->prophesize(ContainerInterface::class);
        $this->container
            ->get('config')
            ->willReturn($config);

        $factory = new SqliteRepositoryFactory();

        $repo = $factory($this->container->reveal(), null, get_class($this->container->reveal()));

        $this->assertInstanceOf(SqliteRepository::class, $repo);
    }
}
