<?php

namespace Nip\Application\Tests\Traits;

use Nip\Application\Tests\AbstractTest;
use Nip\Application\Tests\Fixtures\Library\Application;

/**
 * Class CacheBootstrapTraitTest
 * @package Nip\Application\Tests\Traits
 */
class CacheBootstrapTraitTest extends AbstractTest
{
    public function test_getCachedConfigPath()
    {
        $application = new Application();

        self::assertSame(
            TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'cache/config.php',
            $application->getCachedConfigPath()
        );
    }

    public function test_configurationIsCached()
    {
        $application = new Application();
        $configPath = TEST_FIXTURE_PATH . '/bootstrap/cache/config.php';

        @unlink($configPath);
        self::assertFalse($application->configurationIsCached());

        file_put_contents($configPath, '++');
        self::assertTrue($application->configurationIsCached());

        unlink($configPath);
        self::assertFalse($application->configurationIsCached());
    }
}
