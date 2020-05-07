<?php

namespace Nip\Application;

use Nip\Application\Bootstrap\CoreBootstrapersTrait;
use Nip\AutoLoader\AutoLoaderAwareTrait;
use Nip\Container\ContainerAliasBindingsTrait;
use Nip\Dispatcher\DispatcherAwareTrait;
use Nip\Http\Response\Response;
use Nip\Request;
use Nip\Router\RouterAwareTrait;
use Nip\Staging\StagingAwareTrait;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    use Traits\ServiceProviderAwareTrait;

    use ContainerAliasBindingsTrait;
    use CoreBootstrapersTrait;
    use AutoLoaderAwareTrait;
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

    public function setupAutoLoaderPaths()
    {
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

    public function terminate()
    {
    }

    /**
     * Throw an HttpException with the given data.
     *
     * @param int $code
     * @param string $message
     * @param array $headers
     * @return void
     *
     * @return void
     * @throws HttpException
     */
    public function abort($code, $message = '', array $headers = [])
    {
        if ($code == 404) {
            throw new NotFoundHttpException($message);
        }
        throw new HttpException($code, $message, null, $headers);
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
        if ($request->hasMCA()) {
            $response = $this->dispatchRequest($request);
            ob_get_clean();

            return $response;
        }

        throw new NotFoundHttpException('No MCA in Request');
    }
}
