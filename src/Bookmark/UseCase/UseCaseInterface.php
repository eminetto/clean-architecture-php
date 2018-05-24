<?php

namespace Bookmark\UseCase;

use Bookmark\Entity\Bookmark;

interface UseCaseInterface extends RepositoryInterface
{
    public function __construct(RepositoryInterface $repository);
}