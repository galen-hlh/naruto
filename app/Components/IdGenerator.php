<?php

declare(strict_types=1);

namespace App\Components;

use Hyperf\Snowflake\IdGeneratorInterface;
use Hyperf\Utils\ApplicationContext;

/**
 * 获取分布式ID
 * Author: Galen
 * Date: 2020/1/12 23:03
 * Class IdGenerator
 * @package App\Components
 */
class IdGenerator
{
    /**
     * 获取分布式ID
     * Author: Galen
     * Date: 2020/1/12 23:03
     * @return int
     */
    public static function getId(){
        $container = ApplicationContext::getContainer();
        $generator = $container->get(IdGeneratorInterface::class);

        return $generator->generate();
    }
}
