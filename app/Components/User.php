<?php

declare(strict_types=1);

namespace App\Components;

use Hyperf\Utils\Context;

class User
{
    /**
     * @param $userId
     */
    public static function setUserId($userId)
    {
        Context::set('user_id', $userId);
    }

    /**
     * @return int
     */
    public static function getUserId()
    {
        return Context::get('user_id');
    }

    /**
     * @param $userType
     */
    public static function setUserType($userType)
    {
        Context::set('user_type', $userType);
    }

    /**
     * @return int
     */
    public static function getUserType()
    {
        return Context::get('user_type');
    }
}
