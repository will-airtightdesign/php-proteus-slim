<?php
use \Proteus\Image;

$app->add(function($request, $response, $next) {

    $response = $next($request, $response);

    $route = $request->getAttribute('route');

    if ($route && $route->getName() != 'help') {

        // if it was a successful request, set cache headers
        if ($response->getStatusCode() == 200) {
            $response = $response->withHeader('Cache-Control', 'max-age=12345');
        }

        // set appropriate image content-type
        $img = $response->getBody();
        $response = $response->withHeader('Content-type', Image::getContentType($img));
    }

    return $response;

});