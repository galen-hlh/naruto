<?php

declare(strict_types=1);

namespace App\Exception\Business;

class LoginException extends BusinessException
{
    const USER_NOT_LOGIN = 10000;
    const TOKEN_EXPIRE   = 10001;
    public static $reasons = [
        self::USER_NOT_LOGIN => '用户未登录',
        self::TOKEN_EXPIRE   => 'token已经失效',
    ];
}
