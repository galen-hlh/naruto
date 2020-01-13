<?php

declare(strict_types=1);

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET'], '/', 'App\Modules\V1\Controller\Home\IndexController@index');
Router::addRoute(['GET'], '/test', 'App\Modules\V1\Controller\Home\IndexController@test');
