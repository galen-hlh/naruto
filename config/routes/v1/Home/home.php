<?php

declare(strict_types=1);

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET'], '/', [App\Modules\V1\Controller\Home\IndexController::class, 'index']);
Router::addRoute(['GET'], '/article', [App\Modules\V1\Controller\Home\ArticleController::class, 'getArticleList']);
Router::addRoute(['GET'], '/article/{id}', [App\Modules\V1\Controller\Home\ArticleController::class, 'getArticleInfo']);
