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

use App\Helper\CommonConstHelper;
use App\Helper\Helper;
use App\Helper\ResponseHelper;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Hyperf\Validation\ValidationException;
use Throwable;

class ValidateException extends ExceptionHandler
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
        $httpStatus = 422;
        /** @var \Hyperf\Validation\ValidationException $throwable */
        $msg = $throwable->validator->errors()->first();
        $body = new ResponseHelper(CommonConstHelper::CODE_STATUS_EXCEPTION, $msg);
        $body->setTrace($this->request, $throwable);

        $stream = Helper::jsonEncode($body->getResponse());

        $this->logger->info(Helper::jsonEncode($body->getResponse(true)));

        return $response->withAddedHeader('x-request-id', $this->request->getHeader('x-request-id'))
            ->withStatus($httpStatus)->withBody(new SwooleStream($stream));
    }

    public function isValid(Throwable $throwable): bool
    {
        if ($throwable instanceof ValidationException) {
            return true;
        }

        return false;
    }
}
