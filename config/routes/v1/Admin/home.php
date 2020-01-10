<?php

declare(strict_types=1);

use Hyperf\HttpServer\Router\Router;

Router::addGroup('/v1/admin', function () {
    Router::get('/index', [\App\Modules\V1\Controller\Admin\IndexController::class, 'index']);
    Router::get('/article/{id}', [\App\Modules\V1\Controller\Admin\ArticleController::class, 'get']);
    Router::get('/article', [\App\Modules\V1\Controller\Admin\ArticleController::class, 'list']);
    Router::post('/article', [\App\Modules\V1\Controller\Admin\ArticleController::class, 'add']);
}, ['middleware' => [\App\Middleware\AuthMiddleware::class]]);

Router::post('/v1/admin/login', [\App\Modules\V1\Controller\Admin\LoginController::class, 'login']);
