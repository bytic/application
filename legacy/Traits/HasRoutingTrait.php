<?php

namespace Nip\Application\Traits;

use Nip\DebugBar\DataCollector\RouteCollector;

/**
 * Trait HasRoutingTrait
 * @package Nip\Application\Traits
 */
trait HasRoutingTrait
{
    public function setupURLConstants()
    {
        $this->determineBaseURL();
        define('CURRENT_URL', $this->getRequest()->getHttp()->getUri());
    }

    public function setupRouting()
    {
        $router = $this->getRouter();
        $router->setRequest($this->getRequest());
        if ($this->getDebugBar()->isEnabled()) {
            /** @var RouteCollector $routeCollector */
            $routeCollector = $this->getDebugBar()->getCollector('route');
            $routeCollector->setRouter($router);
        }
    }

    public function preRouting()
    {
        $this->getRouter()->getContext()->setHost(
            $this->getStaging()->getStage()->getHost()
        );
    }

    public function postRouting()
    {
    }

    protected function determineBaseURL()
    {
        $stage = $this->getStaging()->getStage();
        $pathInfo = $this->getRequest()->getHttp()->getBaseUrl();

        $baseURL = $stage->getHTTP() . $stage->getHost() . $pathInfo;
        define('BASE_URL', $baseURL);
    }
}
