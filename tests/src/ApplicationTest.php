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
    /**
     * @var Application
     */
    protected $application;

    public function test_getGenericProviders()
    {
        $application = new Application();
        $application->initContainer();
        $providers = $application->getGenericProviders();

        self::assertIsArray($providers);
        self::assertCount(0, $providers);
    }

    public function testRegisterServices()
    {
        /** @var Mock|Application $application */
        $application = \Mockery::mock(Application::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $application->shouldReceive('getConfiguredProviders')->andReturn([RouterServiceProvider::class]);

        $application->initContainer();
        $application->registerConfiguredProviders();

        static::assertInstanceOf(Router::class, $application->getContainer()->get('router'));
    }

}
