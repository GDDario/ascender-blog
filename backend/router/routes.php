<?php

use AscenderBlog\Infrastructure\Http\Controller\TestController;
use AscenderBlog\Infrastructure\Http\Route\RouteRegistry;

$registry = new RouteRegistry();

$registry->get('/index', TestController::class, 'index');
$registry->get('/paginate', TestController::class, 'index');
$registry->get('/paginate/um', TestController::class, 'index');

//$registry->get('/404', TestController::class, 'notFound');

return $registry;