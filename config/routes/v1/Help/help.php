<?php

declare(strict_types=1);

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET'], '/help/id', [App\Modules\V1\Controller\Help\IdController::class, 'getId']);
