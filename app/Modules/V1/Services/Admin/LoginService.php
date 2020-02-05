<?php

declare(strict_types=1);

namespace App\Modules\V1\Services\Admin;

use App\Components\Auth;
use App\Constants\BusinessErrorCode;
use App\Exception\BusinessException;
use App\Model\Administrator;

class LoginService
{
    public static function login(string $username, string $password)
    {
        $userInfo = Administrator::getInfoByAccount($username);

        if (!$userInfo) {
            throw new BusinessException(BusinessErrorCode::USER_ACCOUNT_ERROR);
        }

        if ($userInfo['password'] !== hash("sha256", $password)) {
            throw new BusinessException(BusinessErrorCode::USER_PASSWORD_ERROR);
        }

        $auth = Auth::getInstance();
        $auth->setPayloads(['user_id' => $userInfo['id'], 'user_type' => $userInfo['account_type']]);

        return $auth->builderToken();
    }
}