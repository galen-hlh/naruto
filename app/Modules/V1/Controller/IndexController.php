<?php

declare(strict_types=1);

namespace App\Modules\V1\Controller;

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
