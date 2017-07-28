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
use Predis\Client;

require_once APPPATH . 'libraries/codeigniter-predis/vendor/autoload.php';

class Redis
{
    private $CI;

    /**
     * @var array
     * @see /application/config/codeigniter-predis.php in your codeigniter project
     */
    private $configuration = [];

    /**
     * @var \CI_Predis\RedisServer
     */
    private $serverConnected;

    /**
     * @var RedisServerCollection
     */
    private $serversList;

    /**
     * @return Client
     */
    public function getServerConnected()
    {
        return $this->serverConnected->getClientInstance();
    }

    /**
     * @return RedisServerCollection
     */
    public function getServersCollection()
    {
        return $this->serversList;
    }

    /**
     * Redis constructor.
     * @param array|null $params
     * @throws Exception
     */
    public function __construct(Array $params = null)
    {
        $this->CI =& get_instance();

        // loads $config in config/redis.php file
        $this->CI->load->config('codeigniter-predis');

        // get the $config['redis'] configuration value
        $this->configuration = $this->CI->config->item('redis');

        if(empty($this->configuration)) {
            throw new Exception('The application/config/redis.php configuration file not found');
        }

        Autoloader::register();

        if(empty($params['serverName'])) {
            $params['serverName'] = $this->configuration['default_server'];
        }

        $this->serversList = new RedisServerCollection();
        $this->connect($params['serverName']);

        return;
    }

    /**
     * @param string $serverName Configuration in application/config/codeigniter-predis.php
     * @throws \Exception
     */
    public function connect($serverName)
    {
        if(empty($this->configuration['servers'][$serverName])) {
            throw new \Exception('Configuration for requested Redis Server not found, given: ' . $serverName);
        }

        $this->serverConnected = new RedisServer($this->configuration['servers'][$serverName]);
        $this->serversList->append($serverName, $this->serverConnected);
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
        return call_user_func_array(
            [$this->serverConnected->getClientInstance(), $name],
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
        return $this->serverConnected->getClientInstance()->$name;
    }

    /**
     * Set a property in Predis\Client instance
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->serverConnected->getClientInstance()->$name = $value;
    }
}