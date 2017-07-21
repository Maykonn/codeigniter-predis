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


abstract class AbstractLibrary
{
    protected $CI;

    /**
     * AbstractLibrary constructor.
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->configure();
    }

    protected abstract function configure();
}