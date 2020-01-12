<?php

declare(strict_types=1);

namespace App\Modules\V1\Services\Admin;

use App\Components\Auth;
use App\Exception\Business\LoginException;
use App\Model\Users;

class LoginService
{
    public static function login(string $username, string $password)
    {
        $userInfo = Users::getUserInfoByUsername($username);

        if (!$userInfo) {
            throw new LoginException(LoginException::USER_NOT_EXITS);
        }

        if ($userInfo['password'] === hash("sha256", $password)) {
            throw new LoginException(LoginException::USER_PASSWORD_ERROR);
        }

        $auth = Auth::getInstance();
        $auth->setPayloads(['user_id' => $userInfo['id'], 'user_type' => $userInfo['account_type']]);

        return $auth->builderToken();
    }
}