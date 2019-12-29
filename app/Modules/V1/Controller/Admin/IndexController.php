<?php

declare(strict_types=1);

namespace App\Modules\V1\Controller\Admin;

use App\Modules\V1\Controller\BaseController;
use Hyperf\Utils\Context;

class IndexController extends BaseController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'info' => [
                'method' => $method,
                'message' => "Hello {$user}.",
            ]
        ];
    }
}
