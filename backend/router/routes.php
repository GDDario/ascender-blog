<?php

use AscenderBlog\Infrastructure\Http\Controller\TestController;
use AscenderBlog\Infrastructure\Http\RouteRegistry;

$registry = new RouteRegistry();

$registry->get('/index', TestController::class, 'index');
$registry->get('/paginate', TestController::class, 'index');
$registry->get('/paginate/um', TestController::class, 'index');

return $registry;