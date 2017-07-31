<?php
/*
 * This file is part of the CodeIgniter-Predis package.
 *
 * (c) Maykonn Welington Candido <maykonn@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CI_Predis;

use Predis\Client;

class RedisServer
{
    const STATUS_CONNECTED = 'CONNECTED';
    const STATUS_DISCONNECTED = 'DISCONNECTED';

    private $name;

    private $status = self::STATUS_DISCONNECTED;

    /**
     * @var RedisServerConfiguration
     */
    private $configuration;

    /**
     * @var Client
     */
    private $clientInstance;

    /**
     * @return RedisServerConfiguration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function __construct($serverName, Array $config)
    {
        $this->name = $serverName;
        $this->configuration = new RedisServerConfiguration($config);
    }

    public function getClientInstance()
    {
        return $this->clientInstance;
    }

    public function connect()
    {
        if(empty($this->configuration)) {
            throw new \Exception('Configuration for requested Redis Server not found, given: ' . $this->name);
        }

        if($this->status == self::STATUS_DISCONNECTED) {
            $this->clientInstance = new Client($this->configuration->toArray());
            $this->status = self::STATUS_CONNECTED;
        }

        return;
    }

    /**
     * Call a method in Predis\Client instance
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $this->connect();
        return call_user_func_array(
            [$this->getClientInstance(), $name],
            $arguments
        );
    }

    /**
     * Call a property in Predis\Client instance
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $this->connect();
        return $this->getClientInstance()->$name;
    }

    /**
     * Set a property in Predis\Client instance
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        $this->connect();
        return $this->getClientInstance()->$name = $value;
    }
}