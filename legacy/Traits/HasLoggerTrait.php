<?php

namespace Nip\Application\Traits;

use Exception;
use Nip\DebugBar\StandardDebugBar;
use Nip\Http\Exceptions\Handler;
use Nip\Http\Kernel\Traits\HandleExceptions;
use Nip\Http\Response\Response;
use Nip\Logger\Logger;
use Nip\Request;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Trait HasLoggerTrait
 * @package Nip\Application\Traits
 * @deprecated use container services
 */
trait HasLoggerTrait
{
    use HandleExceptions;

    /**
     * @var null|LoggerManager
     */
    protected $logger = null;

    protected $debugBar = null;

    public function setupErrorHandling()
    {
        fix_input_quotes();
//
//        if ($this->getStaging()->getStage()->inTesting()) {
//            Debug::enable(E_ALL, true);
////            $this->getDebugBar()->enable();
////            $this->getDebugBar()->addMonolog($this->getLogger()->getMonolog());
//        } else {
//            Debug::enable(E_ALL & ~E_NOTICE, false);
//        }
//
//        $this->getLogger()->init();
//        $this->getContainer()->get(ErrorHandler::class)->setDefaultLogger($this->getLogger());
    }

    /**
     * @return Logger|null
     */
    public function getLogger()
    {
        return app('log');
    }

    /**
     * @return StandardDebugBar
     */
    public function getDebugBar()
    {
        return app('debugbar');
    }

    /**
     * @deprecated use app('debugbar')
     */
    public function setDebugBar($debugBar)
    {
    }

    /**
     * @deprecated use app('debugbar')
     */
    public function initDebugBar()
    {
    }

    /**
     * @deprecated use app('debugbar')
     */
    public function newDebugBar()
    {
    }
}
