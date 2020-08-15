<?php

namespace Nip\Application\Tests\Bootstrap\Bootstrapers;

use Mockery\Mock;
use Nip\Application\Bootstrap\Bootstrapers\RegisterProviders;
use Nip\Application\Tests\AbstractTest;
use Nip\Application\Tests\Fixtures\Library\Application;
use Nip\Router\Router;
use Nip\Router\RouterServiceProvider;

/**
 * Class RegisterContainerTest
 * @package Nip\Application\Tests\Bootstrap\Bootstrapers
 */
class RegisterProvidersTest extends AbstractTest
{
    public function testRegisterConfiguredProvidersNoConfig()
    {
        /** @var \Nip\Application\Application|Mock $application */
        $application = \Mockery::mock(Application::class)->makePartial();
//        $application->shouldReceive('bootProviders')->once();
        $application->shouldReceive('getConfiguredProviders')->andReturn([RouterServiceProvider::class]);

        $application->initContainer();

        $application->getContainer()->set('app', $application);

        $bootstrapper = new RegisterProviders();
        $bootstrapper->bootstrap($application);

        static::assertInstanceOf(Router::class, $application->getContainer()->get('router'));
    }
}
