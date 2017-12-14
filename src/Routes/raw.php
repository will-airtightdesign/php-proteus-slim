<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// return the unmodified image
$app->get('/raw/{image}', function (Request $request, Response $response) {
    
    try {
        $img = new Image(IMG_PATH . DS . $request->getAttribute('image'));
    }
    catch (Exception $e) {
        $img = null;
    }

    if ($img) {
        $response->write($img);
        return $response;
    }
    else {
        $missingImageHandler = $this->get('missingImageHandler');
        return $missingImageHandler($request, $response);
    }

})->setName('raw');