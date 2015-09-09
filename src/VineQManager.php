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

/**
 * This is the VineQ manager class.
 *
 * @author Bui Xuan Quy <quybx91@gmail.com>
 */
class VineQManager
{
    /**
     * The factory instance.
     *
     * @var VineQFactory
     */
    private $factory;

    /**
     * Create a new VineQ manager instance.
     *
     * @param \QLib\VineQ\VineQFactory $factory
     *
     * @return void
     */
    public function __construct(VineQFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    public function createConnection()
    {
        return $this->factory->make();
    }

    /**
     * Get the factory instance.
     *
     * @return \QLib\VineQ\VineQFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
