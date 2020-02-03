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

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

abstract class BaseModel extends Model
{
    /**
     * 开启自动插入时间戳
     */
    public $timestamps = true;

    /**
     * 关闭自增主键
     */
    public $incrementing = false;

    /**
     * 设置时间戳字段
     */
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';

    /**
     * 重写时间戳格式
     * Author: Galen
     * Date: 2020/1/12 23:14
     * @param mixed $value
     * @return int|string|null
     */
    public function fromDateTime($value)
    {
        return time();
    }
}
