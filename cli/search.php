<?php

require 'vendor/autoload.php';
$container = require 'config/container.php';
$repo = $container->get(Bookmark\Driver\SqliteRepository::class);
$service = new Bookmark\UseCase\Service($repo);
$result = $service->search($argv[1]);
foreach ($result as $key => $value) {
    printf("ID: %s Name: %s URL: %s \n", $value->id, $value->name, $value->link);
}
