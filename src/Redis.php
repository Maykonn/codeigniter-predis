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

use Predis\Autoloader;

Autoloader::register();

class Redis extends AbstractLibrary
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

    protected function configure(Array $params = null)
    {
        // loads predis as a library
        $this->CI->load->library('vendor/predis');

        // loads $config in config/redis.php file
        $this->CI->load->config('codeigniter-predis');

        // loads the $config['redis']['default'] configs
        $this->configuration = $this->CI->config->item('redis');

        if(empty($this->configuration)) {
            throw new \Exception('codeigniter-predis.php configuration file not found');
        }

        $this->setServer($params);
        return;
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

    /**
     * Call a method from Predis
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->server->getClientInstance()->$name($arguments);
    }

    /**
     * Call a property on Predis
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->server->getClientInstance()->$name;
    }

    /**
     * Set a property on Predis
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->server->getClientInstance()->$name = $value;
    }
}