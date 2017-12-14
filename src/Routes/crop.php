<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// crop the image
$app->get('/crop/{image}', function (Request $request, Response $response) {

    $imgcache = $this->get('imgcache');

    $cachekey = 'crop-' . sha1($request->getUri()->getPath() . $request->getUri()->getQuery());

    $img = $imgcache->remember($cachekey, function() use ($request) {
        try {
            $img = new Image(IMG_PATH . DS . $request->getAttribute('image'));
            $params = $request->getQueryParams();
            $w = isset($params['w']) ? $params['w'] : 0;
            $h = isset($params['h']) ? $params['h'] : 0;
            $x = isset($params['x']) ? $params['x'] : 0;
            $y = isset($params['y']) ? $params['y'] : 0;
            $img->crop($w, $h, $x, $y);
        }
        catch (Exception $e) {
            $img = null;
        }
        
        return $img;    // return the blob that is going to be cached
    });

    if ($img) {
        $response->write($img);
        return $response;
    }
    else {
        $missingImageHandler = $this->get('missingImageHandler');
        return $missingImageHandler($request, $response);
    }

})->setName('crop');
