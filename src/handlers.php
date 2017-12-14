<?php

$container = $app->getContainer();

//Override the default Not Found Handler
$container['notFoundHandler'] = function ($container) {

    return function ($request, $response) use ($container) {
        return $container['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('Page Not Found');
    };

};

// create a handler for missing images
$container['missingImageHandler'] = function ($container) {

    return function ($request, $response) use ($container) {
        $redirect = $container->get('router')->pathFor('resize', [
            'image' => 'image-not-found.png'
        ]);

        if ($query = $request->getUri()->getQuery()) {
            $redirect .= '?' . $query;
        }

        return $container['response']
            ->withStatus(302)
            ->withHeader(
                'Location', 
                $redirect
            );
    };

};