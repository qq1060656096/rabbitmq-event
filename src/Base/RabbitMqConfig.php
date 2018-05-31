<?php
namespace Zwei\EventRabbitMQ\Base;

use Zwei\Base\Config;

/**
 * 获取配置
 *
 * Class RabbitMqConfig
 * @package Zwei\EventRabbitMQ\Base
 */
class RabbitMqConfig extends Config
{
    /**
     * 获取指定事件配置
     *
     * @param string $name
     * @return mixed
     */
    public static function getEvent($name)
    {
        return parent::get($name, 'event-rabbitmq', 'events.config.yml');
    }

    /**
     * 获取指定队列配置
     * @param string $name
     * @return mixed
     */
    public static function getQueue($name)
    {
        return parent::get($name, 'event-rabbitmq', 'queues.config.yml');
    }

    /**
     * 获取公共配置
     *
     * @param string $name
     * @return mixed
     */
    public static function getCommon($name)
    {
        return parent::get($name, 'event-rabbitmq', 'event-rabbitmq.config.yml');
    }
}