<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\BusinessErrorCode;
use Hyperf\Server\Exception\ServerException;
use Throwable;

/**
 * 业务异常处理基类控制器
 * Author: Galen
 * Date: 2019/12/16 23:16
 * Class BusinessException
 * @package App\Exception\Business
 */
class BusinessException extends ServerException
{
    public function __construct(int $code = 0, string $message = null, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = BusinessErrorCode::getMessage($code);
        }

        parent::__construct($message, $code, $previous);
    }
}