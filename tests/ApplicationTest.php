<?php

namespace Nip\Application\Tests;

use Mockery\Mock;
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
        /** @var Application|Mock $application */
        $application = \Mockery::mock(Application::class)->makePartial();
        $application->shouldReceive('bootProviders')->once();

        static::assertFalse($application->isBooted());

        $application->boot();
        static::assertTrue($application->isBooted());
    }
}
