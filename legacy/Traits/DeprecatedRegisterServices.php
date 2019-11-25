<?php

namespace Nip\Application\Traits;

use Nip\AutoLoader\AutoLoaderServiceProvider;
use Nip\Dispatcher\DispatcherServiceProvider;
use Nip\Filesystem\FilesystemServiceProvider;
use Nip\Locale\LocaleServiceProvider;
use Nip\Mail\MailServiceProvider;
use Nip\Mvc\MvcServiceProvider;
use Nip\Router\RouterServiceProvider;
use Nip\Staging\StagingServiceProvider;

/**
 * Trait DeprecatedRegisterServices
 * @package Nip\Application\Traits
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