<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \Proteus\Image;
use \Proteus\ImageCache;

define('DS', '/');
define('ROOT_PATH', dirname(dirname(__FILE__)));
define('SRC_PATH', ROOT_PATH . DS . 'src');
define('DATA_PATH', ROOT_PATH . DS . 'data');
define('IMG_PATH', DATA_PATH . DS . 'img');
define('IMG_CACHE_PATH', DATA_PATH . DS . 'cache');
define('VIEW_PATH', SRC_PATH . DS . 'Views');

require ROOT_PATH . DS . 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails'               => true,
        'determineRouteBeforeAppMiddleware' => true
    ]
]);

require SRC_PATH . DS . "dependencies.php";
require SRC_PATH . DS . "handlers.php";
require SRC_PATH . DS . "middleware.php";

require SRC_PATH . DS . 'Routes' . DS . 'resize.php';
require SRC_PATH . DS . 'Routes' . DS . 'crop.php';
require SRC_PATH . DS . 'Routes' . DS . 'raw.php';
require SRC_PATH . DS . 'Routes' . DS . 'help.php';

$app->run();