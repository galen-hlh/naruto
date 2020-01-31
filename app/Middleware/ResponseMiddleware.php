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
        $this->response = $response;
        $this->request = $request;
        $this->logger = $logger;
    }

    /**
     * Author : helinhan@styd.cn
     * Date   : 2020-01-17 15:30
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        //设置全局的响应对象
        $response = $handler->handle($request);

        //响应对象
        $body = $this->getBody($response->getStatusCode(), $response->getBody()->getContents());

        //记录debug信息到日志
        $body->setTrace($request);
        $this->logger->info(Helper::jsonEncode($body->getResponse(true)));

        return $response->withAddedHeader('x-request-id', $this->request->getHeader('x-request-id'))
            ->withBody(new SwooleStream(Helper::jsonEncode($body->getResponse())));
    }

    /**
     * Author : helinhan@styd.cn
     * Date   : 2020-01-17 15:30
     * @param $httpStatusCode
     * @param $bodyString
     * @return ResponseHelper
     */
    private function getBody($httpStatusCode, $bodyString)
    {
        $body = new ResponseHelper(CommonConstHelper::CODE_STATUS_SUCCESS);
        switch ($httpStatusCode) {
            case 200:
                $body->setMsg(CommonConstHelper::HTTP_STATUS_SUCCESS_MSG);
                $body->setData($bodyString);
                break;
            case 404:
                $body->setCode($httpStatusCode);
                $body->setMsg(CommonConstHelper::HTTP_STATUS_PAGE_NOT_FOUND_MSG);
                break;
            case 405:
                $body->setCode($httpStatusCode);
                $body->setMsg(CommonConstHelper::HTTP_STATUS_METHOD_NOT_ALLOWED_MSG);
                break;
            default:
                break;
        }

        return $body;
    }
}