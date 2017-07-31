<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index() {
		require_once APPPATH . 'libraries/codeigniter-predis/src/Redis.php';

        echo '<pre>';

        echo 'See application/config/codeigniter-predis.php file <br><br>';

        // Using the default_server configuration
        $this->redis = new \CI_Predis\Redis();
        echo 'PING server setted to default_server config param: ';
        echo $this->redis->ping() . '<br><br>';
        echo 'PING server setted to default_server config param, another way: ';
        echo $this->redis->getServerConnected()->ping() . '<br><br>';


        // Specifying hosts
		$this->redis = new \CI_Predis\Redis(['serverName' => 'localhost']);

		// Ping the localhost server
		echo 'PING localhost server: ';
		echo $this->redis->ping() . '<br><br>';
		echo 'PING localhost server again, another way: ';
		echo $this->redis->getServerConnected()->ping() . '<br><br>';


		// Connect to another server(not instantiated before and is not the default server too)
		//$this->redis->connect('another_instance_example');
		//echo 'PING server another_instance_example: ';
		//echo $this->redis->ping() . '<br><br>';
		echo 'PING server another_instance_example again(auto connect): ';
		echo $this->redis->getServersCollection()->getServer('another_instance_example')->ping() . '<br><br>';


		// Calling a command in a not connected server
        echo 'PING a not accessible server: ';
        try {
            $this->redis->getServersCollection()->getServer('not_accessible_server')->ping() . '<br>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
	}
}
