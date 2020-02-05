<?php

declare(strict_types=1);

namespace App\Handler;

use App\Exception\BusinessException;
use App\Helper\CommonConstHelper;
use App\Helper\Helper;
use App\Helper\ResponseHelper;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class ServerErrorExceptionHandler extends ExceptionHandler
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

        //记录错误日志
        $this->logger->error(Helper::jsonEncode($body->getResponse(true)));

        return $response->withStatus(500)->withBody(new SwooleStream($stream));

    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
