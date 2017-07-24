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

class RedisServerCollection
{
    /**
     * @var \ArrayObject
     */
    private $list;

    public function __construct()
    {
        $this->list = new \ArrayObject();
    }

    /**
     * @param $serverName
     * @return Client
     * @throws \Exception
     */
    public function getServer($serverName)
    {
        if($this->list->offsetExists($serverName)) {
            return $this->list->offsetGet($serverName)->getClientInstance();
        }
        throw new \Exception('Redis server not found, given: ' . $serverName);
    }

    /**
     * @return \ArrayObject
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param $serverName
     * @param RedisServer $redisServer
     * @return void
     */
    public function append($serverName, RedisServer $redisServer)
    {
        $this->list->offsetSet($serverName, $redisServer);
        return;
    }
}