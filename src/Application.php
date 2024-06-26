<?php

namespace Nip\Application;

use Nip\Application\Bootstrap\CoreBootstrapersTrait;
use Nip\Container\ContainerAliasBindingsTrait;
use Nip\Dispatcher\DispatcherAwareTrait;
use Nip\Http\Response\Response;
use Nip\Request;
use Nip\Router\RouterAwareTrait;
use Nip\Staging\StagingAwareTrait;

/**
 * Class Application
 * @package Nip
 */
class Application implements ApplicationInterface
{
    use Traits\BindPathsTrait;
    use Traits\CacheBootstrapTrait;
    use Traits\CanBootTrait;
    use Traits\EnviromentConfiguration;
    use Traits\HasLocaleTrait;
    use Traits\ExecutionTrait;

    use ContainerAliasBindingsTrait, Traits\ServiceProviderAwareTrait {
        ContainerAliasBindingsTrait::addServiceProvider insteadof Traits\ServiceProviderAwareTrait;
    }
    use CoreBootstrapersTrait;
    use RouterAwareTrait;
    use DispatcherAwareTrait;
    use StagingAwareTrait;

    /**
     * The ByTIC framework version.
     *
     * @var string
     */
    const VERSION = '1.0.1';

    /**
     * Indicates if the application has "booted".
     *
     * @var bool
     */
    protected $booted = false;

    /**
     * @var null|Request
     */
    protected $request = null;

    /**
     * Create a new Illuminate application instance.
     *
     * @param  string|null $basePath
     */
    public function __construct($basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }
    }

    /** @noinspection PhpUnusedParameterInspection
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function filterResponse(Response $response, Request $request)
    {
        return $response;
    }

    /**
     * @return string
     */
    public function getRootNamespace()
    {
        return 'App\\';
    }

    /**
     * @param Request $request
     * @return Response
     */
    protected function getResponseFromRequest($request)
    {
        if (!$request->hasMCA()) {
            $this->abort(404, 'No MCA in Request');
        }

        $response = $this->dispatchRequest($request);
        ob_get_clean();

        return $response;
    }
}
