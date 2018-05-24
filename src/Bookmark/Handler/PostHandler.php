<?php

declare(strict_types=1);

namespace Bookmark\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Bookmark\UseCase\UseCaseInterface;
use Bookmark\Entity\Bookmark;

class PostHandler implements RequestHandlerInterface
{
    private $service;

    public function __construct(UseCaseInterface $service)
    {
        $this->service = $service;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $data = $request->getParsedBody();
        //@todo add a filter to data, as a middleware or an method inside service
        $b = new Bookmark;
        $b->name = $data['name'];
        $b->description = $data['description'];
        $b->link = $data['link'];
        $b->tags = $data['tags'];
        $b->favorite = $data['favorite'];

        $b->id = $this->service->store($b);
        return new JsonResponse($b);
    }
}
