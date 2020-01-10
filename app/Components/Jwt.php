<?php

declare(strict_types=1);

namespace App\Components;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token;


class Jwt
{
    private $key = '';

    private $expTime = 3600 * 24 * 7;

    private $privatePayloads = [];

    /**
     * @var Token
     */
    private $token;


    function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @param int $expTime
     */
    public function setExpireTime(int $expTime){
        $this->expTime = $expTime;
    }

    /**
     * @param array $privatePayloads
     */
    public function setPayloads(array $privatePayloads)
    {
        $this->privatePayloads = $privatePayloads;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token){
        $this->token = (new Parser())->parse((string)$token);
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function builderToken()
    {
        $signer = new Sha256();
        $time = time();

        $builder = (new Builder())
            ->issuedAt($this->expTime)
            ->expiresAt($time + $this->expTime);

        foreach ($this->privatePayloads as $name => $val) {
            $builder->withClaim($name, $val);
        }

        $token = $builder->getToken($signer, new Key($this->key));
        return (string)$token;
    }

    /**
     * @return bool
     */
    public function validateToken()
    {
        $signer = new Sha256();

        if (!$this->token->verify($signer, $this->key)) {
            return false;
        }
        if ($this->token->isExpired()) {
            return false;
        }

        return true;
    }
}
