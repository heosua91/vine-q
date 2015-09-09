<?php
/*
 * This file is part of Laravel Vine API.
 *
 * (c) Bui Xuan Quy <quybx91@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace QLib\VineQ\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * This is the VineQ facade class.
 *
 * @author Bui Xuan Quy <quybx91@gmail.com>
 */
class VineQ extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vineq';
    }
}