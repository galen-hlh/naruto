<?php

declare(strict_types=1);

namespace App\Modules\V1\Controller\Help;

use App\Components\GRpc;
use App\Components\IdGenerator;
use App\Modules\V1\Controller\BaseController;
use MicroProto\Helper\HelperClient;
use MicroProto\Helper\IdRequest;
use MicroProto\Helper\IdResponse;

class IdController extends BaseController
{
    public function getId()
    {
//        $grpc = new GRpc();
//
//        $request = new IdRequest();
//        /** @var IdResponse $response */
//        list($response,) = $grpc->request("/helper.Helper/GetDistributeId", $request, IdResponse::class);
//
//        return ["id" => $response->getResult()];
        return ["id" => IdGenerator::getId()];
    }
}
