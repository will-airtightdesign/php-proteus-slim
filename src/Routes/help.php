<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/help', function(Request $request, Response $response) {

    $response = $response->withHeader('Content-type', 'text/html');
    return $this->view->render($response, 'index.html');

})->setName('help');