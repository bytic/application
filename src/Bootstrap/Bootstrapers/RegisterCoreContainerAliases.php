<?php

namespace Nip\Application\Bootstrap\Bootstrapers;

use Nip\Application\Application;
use Nip\Application\ApplicationInterface;
use Nip\Container\Container;
use Nip\Http\Kernel\Kernel;
use Nip\Http\Kernel\KernelInterface;

/**
 * Class RegisterCoreContainerAliases
 * @package Nip\Application\Bootstrap\Bootstrapers
 */
class RegisterCoreContainerAliases extends AbstractBootstraper
{
    /**
     * Bootstrap the given application.
     *
     * @param Application $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        /** @var Container $container */
        $container = $app->getContainer();

        $container->share('kernel', $app);
        $container->share('app', $app);
        $container->alias('app', Application::class);
        $container->alias('app', ApplicationInterface::class);

        $container->share('container', $container);

        $container->share('kernel.http', function () use ($container) {
            return $container->get(Kernel::class);
        });
        $container->alias('kernel.http', KernelInterface::class);
//        $container->alias('router', Router::class);
//        $container->alias('dispatcher', Dispatcher::class);
    }
}
