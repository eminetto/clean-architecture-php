<?php

declare(strict_types=1);

namespace BookmarkTest\Handler;

use Bookmark\Handler\IndexHandler;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Bookmark\UseCase\UseCaseInterface;

class IndexHandlerTest extends TestCase
{
    public function testReturnsJsonResponse()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $container
            ->get(SqliteRepository::class)
            ->willReturn($this->prophesize(RepositoryInterface::class));
        $service = $this->prophesize(UseCaseInterface::class);
        $service->findAll()->willReturn([]);
        $indexPage = new IndexHandler($service->reveal());
        $response = $indexPage->handle(
            $this->prophesize(ServerRequestInterface::class)->reveal()
        );

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
