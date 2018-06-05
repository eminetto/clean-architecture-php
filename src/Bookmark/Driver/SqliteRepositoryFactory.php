<?php

declare(strict_types=1);

namespace Bookmark\Driver;

use Psr\Container\ContainerInterface;
use Bookmark\Driver\RepositoryInterface;

class SqliteRepositoryFactory
{
    public function __invoke(ContainerInterface $container) : RepositoryInterface
    {
        $config = $container->get('config');
        $conn = new \PDO($config['db']['dsn']);
        return new SqliteRepository($conn);
    }
}
