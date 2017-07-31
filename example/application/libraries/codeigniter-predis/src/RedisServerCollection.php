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

    /**
     * RedisServerCollection constructor.
     * @param array|null $serversList a RedisServer array
     */
    public function __construct(Array $serversList = null)
    {
        $this->list = new \ArrayObject($serversList);
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
     * @return RedisServer
     * @throws \Exception
     */
    public function getServer($serverName)
    {
        if($this->list->offsetExists($serverName)) {
            return $this->list->offsetGet($serverName);
        }
        throw new \Exception('Redis server not found, given: ' . $serverName);
    }
}