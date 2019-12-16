<?php

declare(strict_types=1);

namespace App\Exception\Business;

class LoginException extends BusinessException
{
    public $code;
    public $message;
    const SYSTEM_ERR        = 10000;
    public static $reasons  = [
        self::SYSTEM_ERR => '系统繁忙，请稍后重试',
    ];
}
