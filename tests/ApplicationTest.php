<?php

namespace Nip\Application\Tests;

use Nip\Application\Application;
use Nip\Dispatcher\Dispatcher;
use Nip\Mail\Mailer;
use Nip\Mvc\Modules;
use Nip\Router\Router;

/**
 * Class ApplicationTest.
 */
class ApplicationTest extends AbstractTest
{
    /**
     * @var Application
     */
    protected $application;

    public function testRegisterServices()
    {
        $application = new Application();
        $application->registerServices();
//
//        static::assertInstanceOf(Mailer::class, $this->application->getContainer()->get('mailer'));
//        static::assertInstanceOf(Modules::class, $this->application->getContainer()->get('mvc.modules'));
//        static::assertInstanceOf(Dispatcher::class, $this->application->getContainer()->get('dispatcher'));
        static::assertInstanceOf(Router::class, $application->getContainer()->get('router'));
    }

//    public function testBootstrap()
//    {
//        $application = new Application();
//        $application->bootstrap();
//
//        self::assertTrue($application->hasBeenBootstrapped());
//    }

}
