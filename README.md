# Redis for CodeIgniter

## Installation
If you are using composer, type: `composer require maykonn/codeigniter-predis` or if not:

1) Download the code as ZIP in `Clone or download` button
2) Extract the downloaded zip into your `application/libraries/` directory
3) Rename the extracted directory to `application/libraries/codeigniter-predis`
4) In your terminal go to library directory and type: `composer install`
5) The installation will create a `codeigniter-predis.php` file into the `application/config/` folder
6) [**See the example here**](https://github.com/Maykonn/codeigniter-predis/blob/master/example/application/controllers/Welcome.php)

## Using
1) [Install the Redis server, read the Redis documentation](https://redis.io/).

2) Import the `src/Redis.php` file:
```
require_once APPPATH . 'libraries/codeigniter-predis/src/Redis.php';
```

3) Load the library to your CodeIgniter instance:
```
$this->redis = new \CI_Predis\Redis(['serverName' => 'default']);
```

4) Test:
```
echo $this->redis->ping();
```

5) [**See the example here**](https://github.com/Maykonn/codeigniter-predis/blob/master/example/application/controllers/Welcome.php)
