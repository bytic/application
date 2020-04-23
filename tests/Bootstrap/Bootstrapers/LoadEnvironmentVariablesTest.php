<?php

namespace Nip\Application\Tests\Bootstrap\Bootstrapers;

use Nip\Application\Bootstrap\Bootstrapers\LoadEnvironmentVariables;
use Nip\Application\Tests\AbstractTest;
use Nip\Application\Tests\Fixtures\Application;
use Nip\Application\Tests\Fixtures\LegacyApplication;

class LoadEnvironmentVariablesTest extends AbstractTest
{
    /**
     * @doesNotPerformAssertions
     */
    public function test_bootstrap()
    {
        $application = new Application();
        $bootstraper = new LoadEnvironmentVariables();

        $bootstraper->bootstrap($application);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function test_bootstrap_with_legacy_app()
    {
        $application = new LegacyApplication();
        $bootstraper = new LoadEnvironmentVariables();

        $bootstraper->bootstrap($application);
    }
}