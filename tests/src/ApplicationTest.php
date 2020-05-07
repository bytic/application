<?php

namespace Nip\Application\Tests;

use Mockery\Mock;
use Nip\Application\Application;
use Nip\Router\Router;
use Nip\Router\RouterServiceProvider;

/**
 * Class ApplicationTest.
 */
class ApplicationTest extends AbstractTest
{

    public function testRegisterServices()
    {
        /** @var Mock|Application $application */
        $application = \Mockery::mock(Application::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $application->shouldReceive('getConfiguredProviders')->andReturn([RouterServiceProvider::class]);

        $application->initContainer();
        $application->registerConfiguredProviders();

        static::assertInstanceOf(Router::class, $application->getContainer()->get('router'));
    }

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
