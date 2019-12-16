<?php

declare(strict_types=1);

namespace App\Helper;
use phpDocumentor\Reflection\Types\Object_;
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
    public function setTrace(ServerRequestInterface $request,Throwable $throwable)
    {
        $trace = [
            'request_info'  => [
                'path'      => $request->getUri(),
                'method'    => $request->getMethod(),
                'headers'   => $request->getHeaders(),
                'body'      => $request->getBody(),
            ],
            'error_file'    => $throwable->getFile(),
            'error_line'    => $throwable->getLine(),
            'error_message' => $throwable->getMessage(),
            'error_trace'   => $throwable->getTrace()
        ];
        $this->response['trace'] = $trace;
    }

    /**
     * 获取相应信息
     * Author: Galen
     * Date: 2019/12/15 22:46
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * 设置返回的data字段
     * Author: Galen
     * Date: 2019/12/16 21:16
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->response['data'] = (Object)$data;
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

