<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Components\Auth;
use App\Components\User;
use App\Constants\BusinessErrorCode;
use App\Exception\BusinessException;
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
            throw new BusinessException(BusinessErrorCode::USER_NOT_LOGIN);
        }

        $auth = Auth::getInstance();
        $token = $auth->validateToken($tokens[0]);
        if (!$token) {
            throw new BusinessException(BusinessErrorCode::USER_NOT_LOGIN);
        }

        //设置协程周期变量
        $claims = $token->getClaims();
        User::setUserId($claims['user_id']);
        User::setUserType($claims['user_type']);

        return $handler->handle($request);
    }
}