<?php

declare(strict_types=1);

namespace App\Helper;

/**
 * 公共常量
 * Author: Galen
 * Date: 2019/12/15 22:42
 * Class CommonConstHelper
 * @package App\Utils
 */
class CommonConstHelper
{
    // int类型初始值
    const INIT_INT = 0;

    // int类型true值
    const TRUE_INT = 1;

    // 纪元时间
    const EPOCH = 1464948542000;

    // 每天秒数
    const DAY_SECOND = 86400;

    //一天的末秒
    const DAY_FINAL_SECOND_DIFF = 86399;

    // 每小时秒数
    const HOUR_SECOND = 3600;

    // 八小时秒数
    const EIGHT_HOUR_SECOND = 28800;

    //分钟到秒的换算
    const MINUTE_SECOND = 60;

    // 每月天数
    const MONTH_DAY = 30;

    //平年
    const YEAR_DAY = 365;

    // 查询条件，所有类型
    const ALL_TYPE = -1;

    //默认当前页
    const CURRENT_PAGE_DEFAULT = 1;

    //默认每页显示数
    const PAGE_SIZE_DEFAULT = 20;

    //默认每页显示数
    const PAGE_SIZE_MAX = 100;

    //是否需要分页
    const NEED_PAGINATION = 1;

    //成功code
    const CODE_STATUS_SUCCESS = 0;

    //服务器繁忙code
    const CODE_STATUS_EXCEPTION = -1;

    // 404提示信息
    const HTTP_STATUS_PAGE_NOT_FOUND_MSG = 'page not found';

    // 405提示信息
    const HTTP_STATUS_METHOD_NOT_ALLOWED_MSG = 'method not allowed';

    // 500提示信息
    const HTTP_STATUS_METHOD_SERVER_ERROR_MSG = '服务器繁忙';
}