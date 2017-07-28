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

/**
 * From Predis:
 *
 * Interface defining a client able to execute commands against Redis.
 *
 * All the commands exposed by the client generally have the same signature as
 * described by the Redis documentation, but some of them offer an additional
 * and more friendly interface to ease programming which is described in the
 * following list of methods:
 *
 * @method int    del(array|string $keys)
 * @method string dump($key)
 * @method int    exists($key)
 * @method int    expire($key, $seconds)
 * @method int    expireat($key, $timestamp)
 * @method array  keys($pattern)
 * @method int    move($key, $db)
 * @method mixed  object($subcommand, $key)
 * @method int    persist($key)
 * @method int    pexpire($key, $milliseconds)
 * @method int    pexpireat($key, $timestamp)
 * @method int    pttl($key)
 * @method string randomkey()
 * @method mixed  rename($key, $target)
 * @method int    renamenx($key, $target)
 * @method array  scan($cursor, array $options = null)
 * @method array  sort($key, array $options = null)
 * @method int    ttl($key)
 * @method mixed  type($key)
 * @method int    append($key, $value)
 * @method int    bitcount($key, $start = null, $end = null)
 * @method int    bitop($operation, $destkey, $key)
 * @method array  bitfield($key, $subcommand, ...$subcommandArg)
 * @method int    decr($key)
 * @method int    decrby($key, $decrement)
 * @method string get($key)
 * @method int    getbit($key, $offset)
 * @method string getrange($key, $start, $end)
 * @method string getset($key, $value)
 * @method int    incr($key)
 * @method int    incrby($key, $increment)
 * @method string incrbyfloat($key, $increment)
 * @method array  mget(array $keys)
 * @method mixed  mset(array $dictionary)
 * @method int    msetnx(array $dictionary)
 * @method mixed  psetex($key, $milliseconds, $value)
 * @method mixed  set($key, $value, $expireResolution = null, $expireTTL = null, $flag = null)
 * @method int    setbit($key, $offset, $value)
 * @method int    setex($key, $seconds, $value)
 * @method int    setnx($key, $value)
 * @method int    setrange($key, $offset, $value)
 * @method int    strlen($key)
 * @method int    hdel($key, array $fields)
 * @method int    hexists($key, $field)
 * @method string hget($key, $field)
 * @method array  hgetall($key)
 * @method int    hincrby($key, $field, $increment)
 * @method string hincrbyfloat($key, $field, $increment)
 * @method array  hkeys($key)
 * @method int    hlen($key)
 * @method array  hmget($key, array $fields)
 * @method mixed  hmset($key, array $dictionary)
 * @method array  hscan($key, $cursor, array $options = null)
 * @method int    hset($key, $field, $value)
 * @method int    hsetnx($key, $field, $value)
 * @method array  hvals($key)
 * @method int    hstrlen($key, $field)
 * @method array  blpop(array|string $keys, $timeout)
 * @method array  brpop(array|string $keys, $timeout)
 * @method array  brpoplpush($source, $destination, $timeout)
 * @method string lindex($key, $index)
 * @method int    linsert($key, $whence, $pivot, $value)
 * @method int    llen($key)
 * @method string lpop($key)
 * @method int    lpush($key, array $values)
 * @method int    lpushx($key, $value)
 * @method array  lrange($key, $start, $stop)
 * @method int    lrem($key, $count, $value)
 * @method mixed  lset($key, $index, $value)
 * @method mixed  ltrim($key, $start, $stop)
 * @method string rpop($key)
 * @method string rpoplpush($source, $destination)
 * @method int    rpush($key, array $values)
 * @method int    rpushx($key, $value)
 * @method int    sadd($key, array $members)
 * @method int    scard($key)
 * @method array  sdiff(array|string $keys)
 * @method int    sdiffstore($destination, array|string $keys)
 * @method array  sinter(array|string $keys)
 * @method int    sinterstore($destination, array|string $keys)
 * @method int    sismember($key, $member)
 * @method array  smembers($key)
 * @method int    smove($source, $destination, $member)
 * @method string spop($key, $count = null)
 * @method string srandmember($key, $count = null)
 * @method int    srem($key, $member)
 * @method array  sscan($key, $cursor, array $options = null)
 * @method array  sunion(array|string $keys)
 * @method int    sunionstore($destination, array|string $keys)
 * @method int    zadd($key, array $membersAndScoresDictionary)
 * @method int    zcard($key)
 * @method string zcount($key, $min, $max)
 * @method string zincrby($key, $increment, $member)
 * @method int    zinterstore($destination, array|string $keys, array $options = null)
 * @method array  zrange($key, $start, $stop, array $options = null)
 * @method array  zrangebyscore($key, $min, $max, array $options = null)
 * @method int    zrank($key, $member)
 * @method int    zrem($key, $member)
 * @method int    zremrangebyrank($key, $start, $stop)
 * @method int    zremrangebyscore($key, $min, $max)
 * @method array  zrevrange($key, $start, $stop, array $options = null)
 * @method array  zrevrangebyscore($key, $max, $min, array $options = null)
 * @method int    zrevrank($key, $member)
 * @method int    zunionstore($destination, array|string $keys, array $options = null)
 * @method string zscore($key, $member)
 * @method array  zscan($key, $cursor, array $options = null)
 * @method array  zrangebylex($key, $start, $stop, array $options = null)
 * @method array  zrevrangebylex($key, $start, $stop, array $options = null)
 * @method int    zremrangebylex($key, $min, $max)
 * @method int    zlexcount($key, $min, $max)
 * @method int    pfadd($key, array $elements)
 * @method mixed  pfmerge($destinationKey, array|string $sourceKeys)
 * @method int    pfcount(array|string $keys)
 * @method mixed  pubsub($subcommand, $argument)
 * @method int    publish($channel, $message)
 * @method mixed  discard()
 * @method array  exec()
 * @method mixed  multi()
 * @method mixed  unwatch()
 * @method mixed  watch($key)
 * @method mixed  eval($script, $numkeys, $keyOrArg1 = null, $keyOrArgN = null)
 * @method mixed  evalsha($script, $numkeys, $keyOrArg1 = null, $keyOrArgN = null)
 * @method mixed  script($subcommand, $argument = null)
 * @method mixed  auth($password)
 * @method string echo($message)
 * @method mixed  ping($message = null)
 * @method mixed  select($database)
 * @method mixed  bgrewriteaof()
 * @method mixed  bgsave()
 * @method mixed  client($subcommand, $argument = null)
 * @method mixed  config($subcommand, $argument = null)
 * @method int    dbsize()
 * @method mixed  flushall()
 * @method mixed  flushdb()
 * @method array  info($section = null)
 * @method int    lastsave()
 * @method mixed  save()
 * @method mixed  slaveof($host, $port)
 * @method mixed  slowlog($subcommand, $argument = null)
 * @method array  time()
 * @method array  command()
 * @method int    geoadd($key, $longitude, $latitude, $member)
 * @method array  geohash($key, array $members)
 * @method array  geopos($key, array $members)
 * @method string geodist($key, $member1, $member2, $unit = null)
 * @method array  georadius($key, $longitude, $latitude, $radius, $unit, array $options = null)
 * @method array  georadiusbymember($key, $member, $radius, $unit, array $options = null)
 */
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