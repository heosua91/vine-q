<?php

/*
 * This file is part of Laravel Vine API.
 *
 * (c) Bui Xuan Quy <quybx91@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace QLib\VineQ;

use QLib\VineQ\VineQ;

/**
 * This is the Vine factory class.
 *
 * @author Bui Xuan Quy <quybx91@gmail.com>
 */
class VineQFactory
{
    /**
     * Make a new Vine client.
     *
     * @param array $config
     *
     * @return \VineQ
     */
    public function make()
    {
        return new VineQ;
    }
}
