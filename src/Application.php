<?php

namespace Nip\Application;

use Exception;
use Nip\Application\Bootstrap\CoreBootstrapersTrait;
use Nip\Application\Traits\AutoLoaderAwareTrait;
use Nip\Application\Traits\DeprecatedRegisterServices;
use Nip\Application\Traits\HasDatabase;
use Nip\Application\Traits\HasLoggerTrait;
use Nip\Application\Traits\HasRoutingTrait;
use Nip\Application\Traits\HasTranslationTrait;
use Nip\Config\ConfigAwareTrait;
use Nip\Container\ContainerAliasBindingsTrait;
use Nip\Cookie\Jar as CookieJar;
use Nip\Dispatcher\DispatcherAwareTrait;
use Nip\Http\Response\Response;
use Nip\Request;
use Nip\Router\RouterAwareTrait;
use Nip\Session;
use Nip\Staging\StagingAwareTrait;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Application.
 */
class Application implements ApplicationInterface
{
    use Traits\BindPathsTrait;
    use Traits\CacheBootstrapTrait;
    use Traits\CanBootTrait;
    use Traits\EnviromentConfiguration;
    use Traits\ServiceProviderAwareTrait;

    use ContainerAliasBindingsTrait;
    use CoreBootstrapersTrait;
    use RouterAwareTrait;
    use DispatcherAwareTrait;
    use StagingAwareTrait;

    use ConfigAwareTrait;
    use HasTranslationTrait;
    use HasRoutingTrait;

    use AutoLoaderAwareTrait;
    use HasLoggerTrait;
    use HasDatabase;
    use DeprecatedRegisterServices;

    /**
     * @var null|Request
     */
    protected $request = null;

    /**
     * @var null|Session
     */
    protected $sessionManager = null;

    public function run()
    {
        $this->loadFiles();
        $this->prepare();
        $this->setup();

        $request = $this->getRequest();
        $response = $this->handleRequest($request);

        $response = $this->filterResponse($response, $request);
        $response->send();
        $this->terminate($request, $response);
    }

    public function loadFiles()
    {
    }

    public function prepare()
    {
        $this->bootstrap();

        $this->setupRequest();
        $this->setupErrorHandling();
        $this->setupURLConstants();
    }

    public function setupRequest()
    {
    }

    /**
     * @return Request|null
     */
    public function getRequest()
    {
        if ($this->request == null) {
            $this->initRequest();
        }

        return $this->request;
    }

    /**
     * @return $this
     */
    public function initRequest()
    {
        //Usefull for cron jobs
        $_SERVER = array_replace([
            'SERVER_NAME' => 'localhost',
            'SERVER_PORT' => 80,
            'HTTP_HOST' => 'localhost'
        ], $_SERVER);
        $request = Request::createFromGlobals();
        Request::instance($request);
        $this->request = $request;

        return $this;
    }

    public function setup()
    {
        $this->setupConfig();
        $this->setupDatabase();
        $this->setupSession();
        $this->setupTranslation();
        $this->setupLocale();
        $this->setupRouting();
        $this->boot();
    }

    public function setupConfig()
    {
        $this->registerContainerConfig();
    }

    public function setupSession()
    {
        if ($this->getRequest()->isCLI() == false) {
            $requestHTTP = $this->getRequest()->getHttp();
            $domain = $requestHTTP->getRootDomain();
            $sessionManager = $this->getSession();

            if (!$sessionManager->isAutoStart()) {
                $sessionManager->setRootDomain($domain);
                $sessionManager->setLifetime($this->getContainer()->get('config')->get('SESSION')->get('lifetime'));
            }

            if ($domain != 'localhost') {
                CookieJar::instance()->setDefaults(
                    ['domain' => '.' . $domain]
                );
            }
            $this->sessionManager->init();
        }
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        if ($this->sessionManager === null) {
            $this->initSession();
        }

        return $this->sessionManager;
    }

    public function initSession()
    {
        $this->sessionManager = $this->newSession();
    }

    /**
     * @return Session
     */
    public function newSession()
    {
        return new Session();
    }

    public function setupLocale()
    {
    }

    /**
     * @param null|Request $request
     *
     * @return Response
     */
    public function handleRequest($request = null)
    {
        $request = $request ? $request : $this->getRequest();

        try {
            ob_start();
            $this->preHandleRequest();
            $this->preRouting();

            // check is valid request
            if ($this->isValidRequest($request)) {
                $this->route($request);
            } else {
                die('');
            }

            $this->postRouting();

            return $this->getResponseFromRequest($request);
        } catch (Exception $e) {
            return $this->handleException($request, $e);
        }
    }

    public function preHandleRequest()
    {
        $this->getContainer()->singleton('request', $this->getRequest());
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function isValidRequest($request)
    {
        if ($request->isMalicious()) {
            return false;
        }

        return true;
    }

    /**
     * @param Request $request
     *
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

    /** @noinspection PhpUnusedParameterInspection
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function filterResponse(Response $response, Request $request)
    {
        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function terminate(Request $request, Response $response)
    {
    }

    /**
     * Throw an HttpException with the given data.
     *
     * @param int $code
     * @param string $message
     * @param array $headers
     *
     * @return void
     * @throws HttpException
     *
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
}
