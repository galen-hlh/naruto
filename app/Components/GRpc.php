<?php

declare(strict_types=1);

namespace App\Components;

use Google\Protobuf\Internal\Message;
use Hyperf\GrpcClient\BaseClient;

class GRpc extends BaseClient
{
    public function __construct()
    {
        parent::__construct("host.docker.internal:9502");
    }

    public function request($method, $request, $response)
    {
        return $this->simpleRequest($method, $request, [$response, 'decode']);
    }

    public function bidiStreamingCall($method, $response)
    {
        return $this->clientStreamRequest($method, [$response, 'decode']);
    }
}
