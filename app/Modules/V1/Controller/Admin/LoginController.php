<?php

declare(strict_types=1);

namespace App\Modules\V1\Controller\Admin;

use App\Modules\V1\Controller\BaseController;
use App\Modules\V1\Services\Admin\LoginService;
use Hyperf\HttpServer\Contract\RequestInterface;

class LoginController extends BaseController
{
    /**
     * 用户登录
     * Author: Galen
     * Date: 2020/1/10 22:30
     * @param RequestInterface $request
     * @return array
     */
    public function login(RequestInterface $request)
    {
        $username = $request->input('username', '');
        $password = $request->input('password', '');

        $token = LoginService::login($username, $password);
        return ['token' => $token];
    }
}