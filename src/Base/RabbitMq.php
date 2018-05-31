<?php
namespace Zwei\EventRabbitMQ\Base;

use Zwei\EventRabbitMQ\Exception\EventMqRuntimeException;

/**
 * Class RabbitMq
 * @package Zwei\EventRabbitMQ\Base
 */
class RabbitMq
{
    /**
     * @var \AMQPConnection
     */
    private $connection = null;

    /**
     * @var \AMQPChanne
     */
    private $channel = null;

    /**
     * 构造方法初始化
     * RabbitMq constructor.
     * @param string $exchangeName 交换器名
     * @param string $exchangeType 交换器类型
     * @throws EventMqRuntimeException
     */
    public function __construct($exchangeName, $exchangeType = AMQP_EX_TYPE_TOPIC)
    {
        $this->connection = new \AMQPConnection();

        if (!$this->connection) {
            throw new EventMqRuntimeException("Cannot connect to rabbit server.");
        }

        // 创建通道
        $this->channel = new \AMQPChannel();
        $this->channel->qos(0, 1);

        $this->exhange = new \AMQPExchange($this->channel);
        $this->exhange->setName($exchangeName);
        $this->exhange->setType($exchangeType);
        $this->exhange->setFlags(AMQP_DURABLE);// 设置持久化
        $this->exhange->declareExchange();

    }

    /**
     * 关闭连接
     */
    public function disconnection()
    {
        $this->_connection->disconnect();
    }

    /**
     * @return \AMQPChanne|\AMQPChannel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @return \AMQPExchange
     */
    public function getExchange()
    {
        return $this->exhange;
    }


    public function send($message, $routeKey)
    {

    }
}