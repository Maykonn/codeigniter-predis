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

require 'Predis/Autoloader.php';
use Predis\Autoloader;

Autoloader::register();

class Redis
{
    /**
     * @var array
     * @see /application/config/codeigniter-predis.php in your codeigniter project
     */
    private $configuration = [];

    /**
     * @var RedisServer
     */
    private $server;

    private $CI;

    /**
     * Redis constructor.
     * @throws \Exception
     */
    public function __construct(Array $params = null)
    {
        $this->CI =& get_instance();

        // loads $config in config/redis.php file
        $this->CI->load->config('codeigniter-predis');

        // loads the $config['redis']['default'] configs
        $this->configuration = $this->CI->config->item('redis');

        if(empty($this->configuration)) {
            throw new \Exception('redis.php configuration file not found');
        }

        $this->setServer($params);
        return $this->server;
    }

    /**
     * @param array $params
     * @return RedisServer
     * @throws \Exception
     */
    public function setServer(Array $params)
    {
        $server = 'default';
        if(!empty($params['server'])) {
            $server = $params['server'];
        }

        if(empty($this->configuration[$server])) {
            throw new \Exception('Configuration for requested Redis Server not found.');
        }

        $this->server = new RedisServer($this->configuration[$server]);
        return;
    }
}