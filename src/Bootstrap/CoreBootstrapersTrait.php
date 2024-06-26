<?php

namespace Nip\Application\Bootstrap;

use Nip\Application\Bootstrap\Bootstrapers\BootProviders;
use Nip\Application\Bootstrap\Bootstrapers\HandleExceptions;
use Nip\Application\Bootstrap\Bootstrapers\LoadConfiguration;
use Nip\Application\Bootstrap\Bootstrapers\LoadEnvironmentVariables;
use Nip\Application\Bootstrap\Bootstrapers\RegisterContainer;
use Nip\Application\Bootstrap\Bootstrapers\RegisterProviders;
use Nip\Application\Bootstrap\Bootstrapers\SetupAutoloader;

/**
 * Class CoreBootstrapersTrait
 * @package Nip\Application\Bootstrap
 */
trait CoreBootstrapersTrait
{
    use BootstrapAwareTrait;

    /**
     * @return string[]
     */
    protected function getDefaultBootstrappers()
    {
        return [
            RegisterContainer::class,
            LoadEnvironmentVariables::class,
            LoadConfiguration::class,
            HandleExceptions::class,
            RegisterProviders::class,
            SetupAutoloader::class,
            BootProviders::class,
        ];
    }
}
