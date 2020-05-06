<?php

namespace Nip\Application\Bootstrap\Bootstrapers;

use ByTIC\Dotenv\Support\DotenvLoader;
use Nip\Application\Application;

/**
 * Class LoadEnvironmentVariables
 *
 * @package Nip\Application\Bootstrap\Bootstrapers
 */
class LoadEnvironmentVariables extends AbstractBootstraper
{
    /**
     * Bootstrap the given application.
     *
     * @param Application $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        if ($app->configurationIsCached()) {
            return;
        }

        DotenvLoader::safeLoad($app);
    }
}
