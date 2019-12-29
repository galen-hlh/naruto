<?php

declare(strict_types=1);

namespace App\Modules\V1\Controller\Home;

use App\Modules\V1\Controller\BaseController;

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
