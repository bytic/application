<?php

namespace Nip\Application\Tests;

use Nip\Application\Application;
use Nip\Dispatcher\Dispatcher;
use Nip\Mail\Mailer;
use Nip\Mvc\Modules;
use Nip\Router\Router;

/**
 * Class ApplicationTest.
 */
class ApplicationTest extends AbstractTest
{
    public function testBooting()
    {
        $application = new Application();
        static::assertFalse($application->isBooted());

        $application->registerConfiguredProviders();
        static::assertInstanceOf(Router::class, $application->getContainer()->get('router'));
    }
}
