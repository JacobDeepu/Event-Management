<?php

use Src\Controllers\AuthController;
use Src\Controllers\Controller;
use Src\Controllers\CoordinatorController;
use Src\Controllers\EventController;
use Src\Controllers\RegistrationController;
use Src\Controllers\VenueController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$request = Request::createFromGlobals();

$uri = $request->getPathInfo();

if ('/' === $uri) {
    $response = Controller::index();
} elseif ('/login/' === $uri) {
    if ($request->getMethod() === 'POST') {
        $response =  AuthController::login($request);
    } else {
        $response = AuthController::index();
    }
} elseif ('/register/' === $uri) {
    if ($request->getMethod() === 'POST') {
        $response =  AuthController::store($request);
    } else {
        $response = AuthController::register();
    }
} elseif ('/admin/venue/' === $uri) {
    if ($request->getMethod() === 'POST') {
        $response =  VenueController::store($request);
    } else {
        $response = VenueController::create();
    }
} elseif ('/admin/coordinators/' === $uri) {
    if ($request->getMethod() === 'POST') {
        $response =  CoordinatorController::store($request);
    } else {
        $response = CoordinatorController::create();
    }
} elseif ('/admin/events/' === $uri) {
    $response = EventController::index();
} elseif ('/admin/event/create/' === $uri) {
    if ($request->getMethod() === 'POST') {
        $response =  EventController::store($request);
    } else {
        $response = EventController::create();
    }
} elseif ('/admin/event/update/' === $uri) {
    if ($request->getMethod() === 'POST') {
        $response =  EventController::update($request);
    } else {
        $response = EventController::show();
    }
} elseif ('/admin/registrations/' === $uri) {
    $response = RegistrationController::index();
} else {
    $html = '<html><body><h3>404: Page Not Found</h3></body></html>';
    $response = new Response($html, Response::HTTP_NOT_FOUND);
}

$response->send();
