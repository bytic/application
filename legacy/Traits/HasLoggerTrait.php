<?php

namespace Nip\Application\Traits;

use Exception;
use Nip\Application\Application;
use Nip\Debug\Debug;
use Nip\Debug\ErrorHandler;
use Nip\DebugBar\StandardDebugBar;
use Nip\Http\Response\Response;
use Nip\Http\Response\ResponseFactory;
use Nip\Request;
use Whoops\Handler\PrettyPageHandler;

/**
 * Trait HasLoggerTrait
 * @package Nip\Application\Traits
 */
trait HasLoggerTrait
{
    /**
     * @var null|LoggerManager
     */
    protected $logger = null;

    protected $debugBar = null;

    public function setupErrorHandling()
    {
        fix_input_quotes();

        if ($this->getStaging()->getStage()->inTesting()) {
            Debug::enable(E_ALL, true);
            $this->getDebugBar()->enable();
            $this->getDebugBar()->addMonolog($this->getLogger()->getMonolog());
        } else {
            Debug::enable(E_ALL & ~E_NOTICE, false);
        }

        $this->getLogger()->init();
        $this->getContainer()->get(ErrorHandler::class)->setDefaultLogger($this->getLogger());
    }

    /**
     * @return LoggerManager|null
     */
    public function getLogger()
    {
        if ($this->logger == null) {
            $this->initLogger();
        }

        return $this->logger;
    }

    /**
     * @param LoggerManager $logger
     *
     * @return $this
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;

        return $this;
    }

    public function initLogger()
    {
        $logger = $this->newLogger();
        $logger->setBootstrap($this);
        $this->setLogger($logger);
    }

    /**
     * @return LoggerManager
     */
    public function newLogger()
    {
        $logger = new LoggerManager();

        return $logger;
    }

    /**
     * @return StandardDebugBar
     */
    public function getDebugBar()
    {
        if ($this->debugBar == null) {
            $this->initDebugBar();
        }

        return $this->debugBar;
    }

    /**
     * @param null $debugBar
     */
    public function setDebugBar($debugBar)
    {
        $this->debugBar = $debugBar;
    }

    public function initDebugBar()
    {
        $this->setDebugBar($this->newDebugBar());
    }

    /**
     * @return StandardDebugBar
     */
    public function newDebugBar()
    {
        $debugBar = new StandardDebugBar();

        return $debugBar;
    }


    /**
     * @param Exception $e
     * @param Request $request
     *
     * @return Response
     */
    protected function handleException(Request $request, Exception $e)
    {
        $this->reportException($e);

        return $this->renderException($request, $e);
    }

    /**
     * Report the exception to the exception handler.
     *
     * @param Exception $e
     *
     * @return void
     */
    protected function reportException(Exception $e)
    {
        $this->getLogger()->error($e);
    }

    /**
     * @param Request $request
     * @param Exception $e
     *
     * @return Response
     */
    protected function renderException(Request $request, Exception $e)
    {
        if ($this->getStaging()->getStage()->isPublic()) {
            $this->getDispatcher()->setErrorController();

            return $this->getResponseFromRequest($request);
        } else {
            $whoops = new \Whoops\Run();
            $whoops->allowQuit(false);
            $whoops->writeToOutput(false);
            $whoops->pushHandler(new PrettyPageHandler());

            return ResponseFactory::make($whoops->handleException($e));
        }
    }
}
