<?php

namespace Nip\Application\Tests\Traits;

use Nip\Application\Application;
use Nip\Application\Tests\AbstractTest;

/**
 * Class EnviromentConfigurationTest
 * @package Nip\Application\Tests\Traits
 */
class EnviromentConfigurationTest extends AbstractTest
{
    public function testEnvironmentFile()
    {
        $application = new Application();
        self::assertSame('.env', $application->environmentFile());

        $application->loadEnvironmentFrom('.env.live');
        self::assertSame('.env.live', $application->environmentFile());
    }

    public function testEnvironmentFilePath()
    {
        $application = new Application();
        self::assertSame('/.env', $application->environmentFilePath());
    }
}
