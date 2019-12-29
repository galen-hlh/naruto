<?php

declare(strict_types=1);

namespace App\Modules\V1\Controller;

use App\Helper\CommonConstHelper;
use App\Helper\ResponseHelper;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;
use Hyperf\Contract\ConfigInterface;

abstract class BaseController
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;


    /**
     * @Inject
     * @var ConfigInterface
     */
    protected $config;
}
