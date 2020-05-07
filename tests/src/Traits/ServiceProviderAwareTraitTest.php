<?php

namespace Nip\Application\Tests\Traits;

use Nip\Application\Application;
use Nip\Application\Tests\AbstractTest;

/**
 * Class ServiceProviderAwareTraitTest
 * @package Nip\Application\Tests\Traits
 */
class ServiceProviderAwareTraitTest extends AbstractTest
{

    public function test_getGenericProviders()
    {
        $application = new Application();
        $application->initContainer();
        $providers = $application->getGenericProviders();

        static::assertIsArray($providers);
//        static::assertCount(0, $providers);
    }
}
