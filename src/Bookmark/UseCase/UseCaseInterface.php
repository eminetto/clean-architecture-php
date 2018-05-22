<?php

namespace Bookmark\UseCase;

use Bookmark\Entity\Bookmark;

interface UseCaseInterface
{
    public function __construct(RepositoryInterface $repository);
}