<?php

namespace Nip\Application\Bootstrap\Bootstrapers;

use Nip\Application\Application;

/**
 * Class RegisterContainer
 * @package Nip\Application\Bootstrap\Bootstrapers
 */
class RegisterContainer extends AbstractBootstraper
{
    /**
     * Bootstrap the given application.
     *
     * @param Application $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        if ($app->hasContainer()) {
            return;
        }
        $app->initContainer();
    }
}
