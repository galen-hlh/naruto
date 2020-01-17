<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Helper\CommonConstHelper;
use App\Helper\Helper;
use App\Helper\ResponseHelper;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Throwable;

/**
 * 全局中间件
 * Author: Galen
 * Date: 2019/12/15 23:23
 * Class AppMiddleware
 * @package App\Middleware
 */
class ResponseMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;


    /**
     * @var HttpResponse
     */
    protected $response;


    /**
     * @var RequestInterface
     */
    protected $request;

    public function __construct(ContainerInterface $container, HttpResponse $response, RequestInterface $request, StdoutLoggerInterface $logger)
    {
        $this->container = $container;
        $this->response  = $response;
        $this->request   = $request;
        $this->logger   = $logger;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        //响应对象
        $body = new ResponseHelper(CommonConstHelper::CODE_STATUS_SUCCESS);
        $httpStatusCode = $response->getStatusCode();
        if ($httpStatusCode != 200){
            $body->setCode($response->getStatusCode());
        }

        //设置全局统一的返回格式
        $contents = $response->getBody()->getContents();

        //没有返回的数据默认返回空对象
        if ($contents){
            $body->setData(Helper::jsonDecode($contents));
        }

        //404
        if ($httpStatusCode == 404){
            $body->setMsg(CommonConstHelper::HTTP_STATUS_PAGE_NOT_FOUND_MSG);
        }

        //405
        if ($httpStatusCode == 405){
            $body->setMsg(CommonConstHelper::HTTP_STATUS_METHOD_NOT_ALLOWED_MSG);
        }

        //记录debug信息到日志
        $body->setTrace($request);
        $this->logger->info(Helper::jsonEncode($body->getResponse(true)));

        return $response->withBody(new SwooleStream(Helper::jsonEncode($body->getResponse())));
    }
}