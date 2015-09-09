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

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * This is the VineQ service provider class.
 *
 * @author Bui Xuan Quy <quybx91@gmail.com>
 */
class VineQServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('vineq.factory', function () {
            return new VineQFactory();
        });

        $app->alias('vineq.factory', VineQFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('vineq', function ($app) {
            $factory = $app['vineq.factory'];
			$manager = new VineQManager($factory);
            return $manager->createConnection();
        });

        $app->alias('vineq', VineQ::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'vineq',
            'vineq.factory',
        ];
    }
}
