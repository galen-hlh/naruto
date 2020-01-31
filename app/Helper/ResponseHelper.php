<?php

declare(strict_types=1);

namespace App\Helper;

use Psr\Http\Message\ServerRequestInterface;
use Throwable;

/**
 * 响应定义
 * Author: Galen
 * Date: 2019/12/15 22:43
 * Class ResponseHelper
 * @package App\Utils
 */
class ResponseHelper
{
    protected $response = [];

    public function __construct(int $code, string $msg = '', array $data = [])
    {
        $this->response = [
            'code' => $code,
            'msg'  => $msg,
            'data' => (object)$data
        ];
    }

    /**
     * 获取调试信息
     * Author: Galen
     * Date: 2019/12/15 22:45
     * @param ServerRequestInterface $request
     * @param Throwable $throwable
     */
    public function setTrace(ServerRequestInterface $request,Throwable $throwable = null)
    {
        $trace = [
            'request_info'  => [
                'path'      => $request->getRequestTarget(),
                'method'    => $request->getMethod(),
                'headers'   => $request->getHeaders(),
                'body'      => $request->getBody(),
            ]
        ];

        if ($throwable){
            $trace['error_info'] = [
                'error_file'    => $throwable->getFile(),
                'error_line'    => $throwable->getLine(),
                'error_message' => $throwable->getMessage(),
                'error_trace'   => $throwable->getTrace()
            ];
        }
        $this->response['trace'] = $trace;
    }

    /**
     * 获取响应信息
     * Author: Galen
     * Date: 2019/12/15 22:46
     * @param $getTrace
     * @return array
     */
    public function getResponse($getTrace=false)
    {
        $response = $this->response;
        if (!$getTrace && isset($response['trace'])){
            unset($response['trace']);
        }
        return $response;
    }

    /**
     * 设置返回的data字段
     * Author: Galen
     * Date: 2019/12/16 21:16
     * @param $data
     */
    public function setData($data)
    {
        $d = [];
        if (is_string($data)){
            $d = Helper::jsonDecode($data);
        }

        if (is_array($data)){
            $d = $data;
        }

        $this->response['data'] = (Object)$d;
    }

    /**
     * 设置返回的msg字段
     * Author: Galen
     * Date: 2019/12/16 23:24
     * @param string $msg
     */
    public function setMsg(string $msg)
    {
        $this->response['msg'] = $msg;
    }

    /**
     * 设置返回的code字段
     * Author: Galen
     * Date: 2019/12/16 23:26
     * @param int $code
     */
    public function setCode(int $code)
    {
        $this->response['code'] = $code;
    }
}

