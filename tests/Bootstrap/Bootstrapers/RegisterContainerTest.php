<?php

namespace Nip\Application\Tests\Bootstrap\Bootstrappers;

use Nip\Application\Bootstrap\Bootstrapers\RegisterContainer;
use Nip\Application\Tests\AbstractTest;
use Nip\Application\Tests\Fixtures\Application;

/**
 * Class ApplicationTest.
 */
class ApplicationTest extends AbstractTest
{

    public function testRegisterServices()
    {
        $application = new Application();
        static::assertFalse($application->hasContainer());

        $bootrapper = new RegisterContainer();
        $bootrapper->bootstrap($application);

        static::assertTrue($application->hasContainer());
    }
}
