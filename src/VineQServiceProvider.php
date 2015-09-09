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
        $this->registerBindings($this->app);
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

            return new VineQManager($factory);
        });

        $app->alias('vineq', VineQManager::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->bind('vineq.connection', function ($app) {
            $manager = $app['vineq'];

            return $manager->createConnection();
        });

        $app->alias('vineq.connection', VineQ::class);
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
            'vineq.connection',
        ];
    }
}
