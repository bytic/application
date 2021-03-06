<?php

namespace Nip\Application\Bootstrap\Bootstrapers;

use Nip\Application\Application;

/**
 * Class RegisterPaths
 * @package Nip\Application\Bootstrap\Bootstrapers
 */
class RegisterPaths extends AbstractBootstraper
{
    /**
     * Bootstrap the given application.
     *
     * @param Application $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $app->bindPathsInContainer();
    }
}
