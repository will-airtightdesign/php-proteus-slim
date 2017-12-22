<?php

use \Proteus\ImageCache;
use \Slim\Views\PhpRenderer;

$container = $app->getContainer();

$container['imgcache'] = function ($container) {

    return new ImageCache([
        'path' => ROOT . DS . 'data' . DS . 'cache'
    ]);

};

// Register component on container
$container['view'] = function ($container) {

    return new PhpRenderer(ROOT . DS . 'src' . DS . 'Views');

};