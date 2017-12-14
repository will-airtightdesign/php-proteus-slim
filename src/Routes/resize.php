<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// resize the image
$app->get('/resize/{image}', function (Request $request, Response $response) {
    
    $imgcache = $this->get('imgcache');

    $cachekey = 'resize-' . sha1($request->getUri()->getPath() . $request->getUri()->getQuery());

    $img = $imgcache->remember($cachekey, function() use ($request) {
        try {
            $img = new Image(IMG_PATH . DS . $request->getAttribute('image'));
            $params = $request->getQueryParams();
            $type = isset($params['type']) ? $params['type'] : 'thumbnail';
            $w = isset($params['w']) ? $params['w'] : 0;
            $h = isset($params['h']) ? $params['h'] : 0;
            $g = isset($params['g']) ? $params['g'] : 'c';

            $img->resize($type, $w, $h, ['gravity' => $g]);
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

})->setName('resize');