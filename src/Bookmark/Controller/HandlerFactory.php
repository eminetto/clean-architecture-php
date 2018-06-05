<?php

declare(strict_types=1);

namespace Bookmark\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Bookmark\Driver\SqliteRepository;
use Bookmark\UseCase\Service;

class HandlerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName) : RequestHandlerInterface
    {
        $repo   = $container->get(SqliteRepository::class);
        $service = new Service($repo);
        
        return new $requestedName($service);
    }
}
