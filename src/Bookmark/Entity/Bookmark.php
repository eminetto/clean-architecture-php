<?php
declare(strict_types=1);

namespace Bookmark\Entity;

class Bookmark
{
    public $id;
    public $name;
    public $description;
    public $link;
    public $tags = [];
    public $favorite;
    public $createdAt;
}