<?php

namespace Nip\Application\DependencyInjection;

use Nip\Application\Application;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class RegisterPaths
 * @package Nip\Application\Bootstrap\Bootstrapers
 */
class RegisterPathsCompilerPass implements CompilerPassInterface
{
    /**
     * Bootstrap the given application.
     *
     * @param Application $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        if (method_exists($app, 'bindPathsInContainer')) {
            $app->bindPathsInContainer();
        }
    }

    public function process(ContainerBuilder $container)
    {
        $app = $container->get('app');

        $container->setParameter('path', $app->path());
        $container->setParameter('path.base', $app->basePath());
        $container->setParameter('path.lang', $app->langPath());
        $container->setParameter('path.config', $app->configPath());
        $container->setParameter('path.public', $app->publicPath());
        $container->setParameter('path.storage', $app->storagePath());
        $container->setParameter('path.database', $app->databasePath());
        $container->setParameter('path.resources', $app->resourcePath());
        $container->setParameter('path.bootstrap', $app->bootstrapPath());
    }
}
