<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Exception;

use App\Exception\Business\BusinessException;
use App\Helper\CommonConstHelper;
use App\Helper\Helper;
use App\Helper\ResponseHelper;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class ServerErrorException extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    /**
     * @var ServerRequestInterface
     */
    protected $request;

    public function __construct(StdoutLoggerInterface $logger, ServerRequestInterface $request)
    {
        $this->logger = $logger;
        $this->request = $request;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        //设置异常响应
        $body = new ResponseHelper(CommonConstHelper::CODE_STATUS_EXCEPTION, CommonConstHelper::HTTP_STATUS_METHOD_SERVER_ERROR_MSG);
        $body->setTrace($this->request, $throwable);

        if (in_array(env("APP_ENV"), ["prod", "pre"])) {
            $stream = Helper::jsonEncode($body->getResponse());
        } else {
            $stream = Helper::jsonEncode($body->getResponse(true));
        }

        //如果是代码错误记录日志
        if (!$throwable instanceof BusinessException) {
            $this->logger->error(Helper::jsonEncode($body->getResponse(true)));
        }

        return $response->withStatus(500)->withAddedHeader('x-request-id', $this->request->getHeader('x-request-id'))
            ->withBody(new SwooleStream($stream));
    }

    public function isValid(Throwable $throwable): bool
    {
        if (!$throwable instanceof BusinessException) {
            return true;
        }

        if (!$throwable instanceof ValidationException) {
            return true;
        }

        return false;
    }
}
