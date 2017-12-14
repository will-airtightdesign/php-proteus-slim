<?php

use \Proteus\ImageCache;

$container = $app->getContainer();

$container['imgcache'] = function ($container) {

    return new \Proteus\ImageCache([
        'path' => IMG_CACHE_PATH
    ]);

};

// Register component on container
$container['view'] = function ($container) {

    return new \Slim\Views\PhpRenderer(VIEW_PATH);

};