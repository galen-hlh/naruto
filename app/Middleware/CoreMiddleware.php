<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Helper\CommonConstHelper;
use App\Helper\Helper;
use App\Helper\ResponseHelper;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Contracts\Arrayable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * 重写原404和405判断
 * Author: Galen
 * Date: 2019/12/15 23:42
 * Class CoreMiddleware
 * @package App\Middleware
 */
class CoreMiddleware extends \Hyperf\HttpServer\CoreMiddleware
{
    /**
     * 重写404
     * Author: Galen
     * Date: 2019/12/15 23:42
     * @param ServerRequestInterface $request
     * @return array|Arrayable|mixed|ResponseInterface|string
     */
    protected function handleNotFound(ServerRequestInterface $request)
    {
        $body = new ResponseHelper(404,CommonConstHelper::HTTP_STATUS_PAGE_NOT_FOUND_MSG);
        return $this->response()->withStatus(404)->withBody(new SwooleStream(Helper::jsonEncode($body->getResponse())));
    }

    /**
     * 重写405
     * Author: Galen
     * Date: 2019/12/15 23:42
     * @param array $methods
     * @param ServerRequestInterface $request
     * @return array|Arrayable|mixed|ResponseInterface|string
     */
    protected function handleMethodNotAllowed(array $methods, ServerRequestInterface $request)
    {
        $body = new ResponseHelper(405,CommonConstHelper::HTTP_STATUS_METHOD_NOT_ALLOWED_MSG);
        return $this->response()->withStatus(405)->withBody(new SwooleStream(Helper::jsonEncode($body->getResponse())));
    }
}