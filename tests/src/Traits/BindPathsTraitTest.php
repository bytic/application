<?php

namespace Nip\Application\Tests\Traits;

use Nip\Application\Application;
use Nip\Application\Tests\AbstractTest;

/**
 * Class BindPathsTraitTest
 * @package Nip\Application\Tests\Traits
 */
class BindPathsTraitTest extends AbstractTest
{
    public function test_init_basepath_from_constants()
    {
        define('ROOT_PATH', TEST_FIXTURE_PATH);
        $application = new Application();
        self::assertSame(TEST_FIXTURE_PATH, $application->basePath());
    }

    public function test_bindPathsInContainer()
    {
        $application = new Application();
        $application->initContainer();
        $application->bindPathsInContainer();
        self::assertSame($application->basePath(), $application->getContainer()->get('path.base'));
        self::assertSame(
            $application->basePath() . DIRECTORY_SEPARATOR . 'bootstrap',
            $application->getContainer()->get('path.bootstrap')
        );
    }
}
