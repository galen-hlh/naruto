<?php

declare(strict_types=1);

namespace App\Exception\Business;

class LoginException extends BusinessException
{
    const USER_NOT_LOGIN = 10000;
    const TOKEN_EXPIRE   = 10001;
    const USER_NOT_EXITS = 10002;
    const USER_PASSWORD_ERROR = 10003;
    public static $reasons = [
        self::USER_NOT_LOGIN => '用户未登录',
        self::TOKEN_EXPIRE   => 'token已经失效',
        self::USER_NOT_EXITS => '账号不存在',
        self::USER_PASSWORD_ERROR => '密码错误'
    ];
}
