<?php
/*
 * This file is part of the CodeIgniter-Predis package.
 *
 * (c) Maykonn Welington Candido <maykonn@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Predis;

class Redis
{
    /**
     * @var array
     * @see config/redis.php
     */
    private $configuration = [];

    private $CI;

    /**
     * Redis constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->CI =& get_instance();

        // loads $config in config/redis.php file
        $this->CI->load->config('redis');

        // loads the $config['redis']['default'] configs
        $this->configuration = $this->CI->config->item('redis');

        if(empty($this->configuration)) {
            throw new Exception('redis.php configuration file not found');
        }

        return new Predis\Client([
            'scheme' => 'tcp',
            'host'   => 'localhost',
            'port'   => 6379,
            'database' => 1, // default is 0, you can put 0-15
        ]);
    }
}