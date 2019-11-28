<?php

namespace Nip\Application\Traits;

use Nip\AutoLoader\AutoLoaderServiceProvider;
use Nip\Dispatcher\DispatcherServiceProvider;
use Nip\Filesystem\FilesystemServiceProvider;
use Nip\Locale\LocaleServiceProvider;
use Nip\Mail\MailServiceProvider;
use Nip\Mvc\MvcServiceProvider;
use Nip\Router\RouterServiceProvider;
use Nip\Router\RoutesServiceProvider;
use Nip\Staging\StagingServiceProvider;

/**
 * Trait ServiceProviderAwareTrait
 * @package Nip\Application\Traits
 */
trait ServiceProviderAwareTrait
{
    use \Nip\Container\ServiceProvider\ServiceProviderAwareTrait;

    /**
     * @return array
     */
    public function getGenericProviders()
    {
        return [
            AutoLoaderServiceProvider::class,
//            LoggerServiceProvider::class,
//            InflectorServiceProvider::class,
            LocaleServiceProvider::class,
            MailServiceProvider::class,
            MvcServiceProvider::class,
            DispatcherServiceProvider::class,
            StagingServiceProvider::class,
            RouterServiceProvider::class,
            RoutesServiceProvider::class,
//            DatabaseServiceProvider::class,
//            TranslatorServiceProvider::class,
//            FlashServiceProvider::class,
            FilesystemServiceProvider::class,
        ];
    }
}