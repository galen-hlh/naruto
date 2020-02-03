<?php

declare(strict_types=1);

namespace App\Modules\V1\Controller\Help;

use App\Components\IdGenerator;
use App\Modules\V1\Controller\BaseController;

class IdController extends BaseController
{
    public function getId()
    {
        return ["id" => IdGenerator::getId()];
    }
}
