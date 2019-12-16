<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Helper\CommonConstHelper;
use App\Helper\Helper;
use App\Helper\ResponseHelper;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * 全局中间件
 * Author: Galen
 * Date: 2019/12/15 23:23
 * Class AppMiddleware
 * @package App\Middleware
 */
class AppMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var HttpResponse
     */
    protected $response;

    /**
     * @var RequestInterface
     */
    protected $request;

    public function __construct(ContainerInterface $container, HttpResponse $response, RequestInterface $request)
    {
        $this->container = $container;
        $this->response  = $response;
        $this->request   = $request;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        //请求控制器前
        $response = $handler->handle($request);
        //请求之后-设置全局统一的返回格式
        $contents = $response->getBody()->getContents();
        $body = new ResponseHelper(CommonConstHelper::CODE_STATUS_SUCCESS);
        $body->setData(Helper::jsonDecode($contents));
        return $this->response->json($body->getResponse());
    }
}