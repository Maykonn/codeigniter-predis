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
    /**
     * @var Client
     */
    private $clientInstance;

    public function __construct(Array $config)
    {
        $this->clientInstance = new Client($config);
        return;
    }
    public function getClientInstance()
    {
        return $this->clientInstance;
    }
}