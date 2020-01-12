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
        /**请求之前**/
        $response = $handler->handle($request);

        /**请求之后**/
        //响应对象
        $body = new ResponseHelper(CommonConstHelper::CODE_STATUS_SUCCESS);

        //重写404错误
        $statusCode = $response->getStatusCode();
        if ($statusCode == 404){
            $body->setCode(404);
            $body->setMsg(CommonConstHelper::HTTP_STATUS_PAGE_NOT_FOUND_MSG);
            return $response->withStatus(404)->withBody(new SwooleStream(Helper::jsonEncode($body->getResponse())));
        }

        //重写405错误
        $statusCode = $response->getStatusCode();
        if ($statusCode == 405){
            $body->setCode(405);
            $body->setMsg(CommonConstHelper::HTTP_STATUS_METHOD_NOT_ALLOWED_MSG);
            return $response->withStatus(405)->withBody(new SwooleStream(Helper::jsonEncode($body->getResponse())));
        }

        //设置全局统一的返回格式
        $contents = $response->getBody()->getContents();

        //没有返回的数据默认返回空对象
        if ($contents){
            $body->setData(Helper::jsonDecode($contents));
        }

        return $this->response->json($body->getResponse());
    }
}