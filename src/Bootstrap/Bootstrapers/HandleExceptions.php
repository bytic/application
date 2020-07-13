<?php

namespace Nip\Application\Bootstrap\Bootstrapers;

use Nip\Application\Application;
use Nip\Debug\Debug;

/**
 * Class HandleExceptions
 * @package Nip\Application\Bootstrap\Bootstrapers
 */
class HandleExceptions extends AbstractBootstraper
{
    /**
     * Bootstrap the given application.
     *
     * @param Application $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $this->setApp($app);

        if (config('app.debug')) {
            Debug::enable();
        } else {
        }

        $handler = \Symfony\Component\ErrorHandler\ErrorHandler::register(null, false);
        $handler->throwAt(E_ALL & ~(E_STRICT | E_NOTICE | E_WARNING | E_USER_WARNING), true);
    }
}
