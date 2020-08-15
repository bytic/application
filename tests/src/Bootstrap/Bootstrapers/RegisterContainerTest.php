<?php

namespace Nip\Application\Tests\Bootstrap\Bootstrapers;

use Nip\Application\Bootstrap\Bootstrapers\RegisterContainer;
use Nip\Application\Tests\AbstractTest;
use Nip\Application\Tests\Fixtures\Library\Application;
use Nip\Application\Tests\Fixtures\Library\LegacyApplication;

/**
 * Class RegisterContainerTest
 * @package Nip\Application\Tests\Bootstrap\Bootstrapers
 */
class RegisterContainerTest extends AbstractTest
{
    public function testRegisterServices()
    {
        $application = new Application();
        static::assertFalse($application->hasContainer());

        $bootstrapper = new RegisterContainer();
        $bootstrapper->bootstrap($application);

        static::assertTrue($application->hasContainer());
    }

    public function testRegisterServicesWithLegacyApplication()
    {
        $application = new LegacyApplication();
        static::assertFalse($application->hasContainer());

        $bootstrapper = new RegisterContainer();
        $bootstrapper->bootstrap($application);

        static::assertTrue($application->hasContainer());
    }
}
