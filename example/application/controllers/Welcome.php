<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index() {
        require_once APPPATH . 'libraries/codeigniter-predis/src/Redis.php';
        $this->redis = new \CI_Predis\Redis(['serverName' => 'default']);

        echo '<pre>';
        echo 'See application/config/codeigniter-predis.php file <br><br>';
        echo 'PING server default: '  . $this->redis->ping() . '<br>';
        echo 'PING server default again: ' . $this->redis->getServerConnected()->ping() . '<br>';

        // Connect to another server
        $this->redis->connect('another_instance_example');
        echo 'PING server another_instance_example: '  . $this->redis->ping() . '<br>';
        echo 'PING server another_instance_example again: ' . $this->redis->getServersCollection()->getServer('another_instance_example')->ping() . '<br>';
	}
}
