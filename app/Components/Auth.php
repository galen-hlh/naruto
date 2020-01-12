<?php

declare(strict_types=1);

namespace App\Components;

use Lcobucci\JWT\Token;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

/**
 * JWT单例
 * Author: Galen
 * Date: 2020/1/12 16:05
 * Class Auth
 * @package App\Components
 */
class Auth
{

    static private $instance;
    
    private $key = '';

    private $expTime = 0;

    private $payloads = [];

    private function __construct(string $key, int $expTime)
    {
        $this->key = $key;
        $this->expTime = $expTime;
    }

    private function __clone(){}

    /**
     * 获取实例
     * Author: Galen
     * Date: 2020/1/12 16:04
     * @return Auth
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $jwtConfig = config('jwt');
            $key = $jwtConfig['key'];
            $expTime = $jwtConfig['expire'];
            self::$instance = new Auth($key, $expTime);
        }
        return self::$instance;
    }

    /**
     * 设置 payloads
     * Author: Galen
     * Date: 2020/1/12 16:33
     * @param array $payloads
     * @return Auth
     */
    public function setPayloads(array $payloads)
    {
        $this->payloads = $payloads;
        return self::getInstance();
    }

    /**
     * 生成token
     * Author: Galen
     * Date: 2020/1/12 16:04
     * @return string
     */
    public function builderToken()
    {
        $signer = new Sha256();
        $time = time();

        $builder = (new Builder())
            ->issuedAt($this->expTime)
            ->expiresAt($time + $this->expTime);

        foreach ($this->payloads as $name => $val) {
            $builder->withClaim($name, $val);
        }

        $token = $builder->getToken($signer, new Key($this->key));
        return (string)$token;
    }

    /**
     * 验证token
     * Author: Galen
     * Date: 2020/1/12 22:48
     * @param $token
     * @return bool|Token
     */
    public function validateToken($token)
    {
        $signer = new Sha256();
        $tokenInstance = (new Parser())->parse((string)$token);
        
        if (!$tokenInstance->verify($signer, $this->key)) {
            return false;
        }
        if ($tokenInstance->isExpired()) {
            return false;
        }

        return $tokenInstance;
    }
}
