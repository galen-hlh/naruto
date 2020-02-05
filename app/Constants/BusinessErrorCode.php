<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class BusinessErrorCode extends AbstractConstants
{
    /**
     * @Message("系统繁忙，请稍后重试")
     */
    const SERVER_ERROR = 10000;

    /**
     * @Message("字段错误")
     */
    const PARAMS_ERROR = 10001;

    /**
     * @Message("用户未登录")
     */
    const USER_NOT_LOGIN = 10002;

    /**
     * @Message("用户名错误")
     */
    const USER_ACCOUNT_ERROR = 10003;

    /**
     * @Message("密码错误")
     */
    const USER_PASSWORD_ERROR = 10004;

    /**
     * @Message("失败次数限制")
     */
    const FAILURES_LIMIT = 10005;


}
