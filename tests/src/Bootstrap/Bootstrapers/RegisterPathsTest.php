<?php

namespace Nip\Application\Tests\Bootstrap\Bootstrapers;

use Mockery\Mock;
use Nip\Application\Bootstrap\Bootstrapers\RegisterPaths;
use Nip\Application\Tests\AbstractTest;
use Nip\Application\Tests\Fixtures\Library\Application;

/**
 * Class RegisterPathsTest
 * @package Nip\Application\Tests\Bootstrap\Bootstrapers
 */
class RegisterPathsTest extends AbstractTest
{
    public function test_bootstrap()
    {
        /** @var \Nip\Application\Application|Mock $application */
        $application = \Mockery::mock(Application::class)->makePartial();
        $application->shouldReceive('bindPathsInContainer')->once();

        $bootstrapper = new RegisterPaths();
        $bootstrapper->bootstrap($application);
        self::assertTrue(true);
    }
}