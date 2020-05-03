<?php

namespace Nip\Application\Traits;

/**
 * Trait DeprecatedRegisterServices
 * @package Nip\Application\Traits
 *
 * @deprecated use RegisteredProviders
 */
trait DeprecatedRegisterServices
{
    /**
     * @deprecated use registerConfiguredProviders
     */
    public function registerServices()
    {
        $this->registerConfiguredProviders();
    }
}
