<?php

declare(strict_types=1);

namespace App\Handler;

use App\Constants\BusinessErrorCode;
use App\Helper\Helper;
use App\Helper\ResponseHelper;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Hyperf\Validation\ValidationException;
use Throwable;

class ValidateExceptionHandler extends ExceptionHandler
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
        if ($throwable instanceof ValidationException) {
            /** @var \Hyperf\Validation\ValidationException $throwable */
            $msg = $throwable->validator->errors()->first();
            $body = new ResponseHelper(BusinessErrorCode::PARAMS_ERROR, $msg);
            $body->setTrace($this->request, $throwable);

            $stream = Helper::jsonEncode($body->getResponse());

            $this->logger->info(Helper::jsonEncode($body->getResponse(true)));

            return $response->withStatus(400)->withBody(new SwooleStream($stream));
        }
        return $response;
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
