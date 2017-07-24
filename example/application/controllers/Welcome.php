<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
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
