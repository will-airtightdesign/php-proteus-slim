<?php
use \Proteus\Image;
use \Proteus\ImageCache;

define('DS', '/');
define('ROOT', dirname(dirname(__FILE__)));

require ROOT . DS . 'vendor/autoload.php';

// uncomment to FORCE gd over imagick
// Image::$gd = 1;

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails'               => true,
        'determineRouteBeforeAppMiddleware' => true
    ]
]);


require ROOT . DS . 'src' . DS . "dependencies.php";
require ROOT . DS . 'src' . DS . "handlers.php";
require ROOT . DS . 'src' . DS . "middleware.php";

// uncomment to test with caching off
$app->getContainer()->get('imgcache')->off();

require ROOT . DS . 'src' . DS . 'Routes' . DS . 'resize.php';
require ROOT . DS . 'src' . DS . 'Routes' . DS . 'crop.php';
require ROOT . DS . 'src' . DS . 'Routes' . DS . 'raw.php';
require ROOT . DS . 'src' . DS . 'Routes' . DS . 'help.php';

$app->run();