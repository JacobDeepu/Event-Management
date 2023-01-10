<?php

use Src\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$request = Request::createFromGlobals();

$uri = $request->getPathInfo();

if ('/' === $uri) {
    $response = Controller::index();
} else {
    $html = '<html><body><h3>404: Page Not Found</h3></body></html>';
    $response = new Response($html, Response::HTTP_NOT_FOUND);
}

$response->send();
