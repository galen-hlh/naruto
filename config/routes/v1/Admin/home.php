<?php

declare(strict_types=1);

use Hyperf\HttpServer\Router\Router;

Router::get('/admin', [\App\Modules\V1\Controller\Admin\IndexController::class, 'index'], ['middleware' => [\App\Middleware\AuthMiddleware::class]]);
