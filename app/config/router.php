<?php

$router = $di->getRouter();

// Define your routes here
$router->addGet('/:controller', ['controller' => 'users', 'action' => 'get']);
$router->addGet('/:controller/:action/:paramater1', ['controller' => 'users', 'action' => 'getId', 'parameter1' => ':id:']);
$router->addPost('/:controller', ['controller' => 'users', 'action' => 'create']);
$router->addPatch('/:controller/:action/:paramater1', ['controller' => 'users', 'action' => 'update', 'parameter1' => ':id:']);
$router->addDelete('/:controller/:action/:paramater1', ['controller' => 'users', 'action' => 'delete', 'parameter1' => ':id:']);

$router->handle($_SERVER['REQUEST_URI']);
