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


class RedisServerConfiguration
{
    /**
     * @var \ArrayObject
     */
    private $configuration;

    /**
     * @return \ArrayObject
     */
    public function getParams()
    {
        return $this->configuration;
    }

    public function __construct(Array $config)
    {
        $this->configuration = new \ArrayObject($config);
    }

    public function toArray()
    {
        return $this->configuration->getArrayCopy();
    }

    private function isValid(Array $config)
    {
        // TODO: implements the config validation
        return true;
    }
}