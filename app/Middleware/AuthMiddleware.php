<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Components\Jwt;
use App\Components\User;
use App\Exception\Business\LoginException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // 验证token是否存在
        $tokens = $request->getHeader('token');
        if (empty($tokens)) {
            throw new LoginException(LoginException::USER_NOT_LOGIN);
        }

        $jwtConfig = config('jwt');
        $jwt = new Jwt($jwtConfig['key']);
        $jwt->setToken($tokens[0]);

        if (!$jwt->validateToken()) {
            throw new LoginException(LoginException::TOKEN_EXPIRE);
        }

        //设置协程周期变量
        $claims = $jwt->getToken()->getClaims();
        User::setUserId($claims['user_id']);
        User::setUserType($claims['user_type']);

        return $handler->handle($request);
    }
}