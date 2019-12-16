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

namespace App\Exception\Business;

use Hyperf\Server\Exception\ServerException;

/**
 * 业务异常处理基类控制器
 * Author: Galen
 * Date: 2019/12/16 23:16
 * Class BusinessException
 * @package App\Exception\Business
 */
class BusinessException extends ServerException
{
    const SYSTEM_ERR        = 10000;
    public static $reasons  = [
        self::SYSTEM_ERR => '系统繁忙，请稍后重试',
    ];

    public function __construct($code=0, $message='')
    {
        $this->code    = $code;
        $this->message = $message ? $message : self::getReason($code);
        parent::__construct($this->message, $this->code);
    }

    public static function getReason($code)
    {
        return isset(static::$reasons[$code]) ? static::$reasons[$code] : self::$reasons[self::SYSTEM_ERR];
    }
}
