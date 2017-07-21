<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['redis'] = [];

switch (ENVIRONMENT) {
    case 'development':
    case 'testing':
        $config['redis'] = [
            'default' => [
                'host' => 'localhost',
                'port' => 6379,
                'password' => '',
            ],
            'another_instance_example' => [
                'host' => '127.0.0.1',
                'port' => 6379,
                'password' => '',
            ],
        ];
        break;
    case 'homologation':
        break;
    case 'production':
        break;
    default:
        throw new Exception('The application environment is not set correctly.');
}