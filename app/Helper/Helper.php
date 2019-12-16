<?php

declare(strict_types=1);

namespace App\Helper;

use function Composer\Autoload\includeFile;

/**
 * 助手类
 * Author: Galen
 * Date: 2019/12/15 22:43
 * Class Helper
 * @package App\Utils
 */
class Helper
{
    /**
     * 数组转json
     * Author: Galen
     * Date: 2019/12/15 22:43
     * @param array $params
     * @return false|string
     */
    public static function jsonEncode(array $params)
    {
        try {
            return json_encode($params);
        } catch (\Exception $e) {
            return "";
        }
    }

    /**
     * json转数组
     * Author: Galen
     * Date: 2019/12/16 21:17
     * @param string $params
     * @return array|mixed
     */
    public static function jsonDecode(string $params)
    {
        try {
            return json_decode($params, true);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * 自动加载目录下的文件
     * Author: Galen
     * Date: 2019/12/15 22:43
     * @param $path
     */
    public static function autoloadFiles($path)
    {
        $dirs = scandir($path);
        foreach ($dirs as $file) {
            $filePath = $path . '/' . $file;
            if (is_dir($filePath)) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                self::autoloadFiles($filePath);
            } else {
                includeFile($filePath);
            }
        }
    }
}

