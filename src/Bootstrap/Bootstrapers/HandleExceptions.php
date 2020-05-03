<?php

namespace Nip\Application\Bootstrap\Bootstrapers;

use Nip\Application\Application;
use Nip\Debug\Debug;
use Nip\Debug\ErrorHandler;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

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

        $handler = ErrorHandler::register(null, false);
        $app->getContainer()->set(ErrorHandler::class, $handler);
        $handler->throwAt(E_ALL & ~(E_STRICT|E_NOTICE|E_WARNING|E_USER_WARNING), true);
    }
}
