<?php declare(strict_types=1);

namespace Phlexus;

use Phalcon\Di;
use Phalcon\DiInterface;
use Phalcon\Mvc\Application as MvcApplication;
use Phlexus\Providers\DispatcherProvider;
use Phlexus\Providers\ModulesProvider;
use Phlexus\Providers\ProviderInterface;
use Phlexus\Providers\ResponseProvider;
use Phlexus\Providers\RegistryProvider;
use Phlexus\Providers\RouterProvider;
use Phlexus\Providers\ViewProvider;

class Application
{
    /**
     * The Dependency Injector
     *
     * @var DiInterface
     */
    protected $di;

    /**
     * The Phalcon Application
     *
     * @var MvcApplication
     */
    protected $app;

    /**
     * Application Service Providers
     *
     * @var ProviderInterface[]
     */
    protected $providers = [];

    /**
     * Application constructor
     * @param array $vendorModules
     */
    public function __construct(array $vendorModules = [])
    {
        $this->di = new Di();
        $this->app = new MvcApplication($this->di);
        $this->di->setShared('bootstrap', $this);

        Di::setDefault($this->di);

        $this->initializeProvider(new RegistryProvider($this->di));
        $this->initializeProvider(new ModulesProvider($this->di), $vendorModules);
        $this->initializeProvider(new RouterProvider($this->di));
        $this->initializeProvider(new ViewProvider($this->di));
        $this->initializeProvider(new DispatcherProvider($this->di));
        $this->initializeProvider(new ResponseProvider($this->di));

        $this->app->setDI($this->di);
    }

    /**
     * Run!
     *
     * @return string
     */
    public function run() : string
    {
        return $this->getOutput();
    }

    /**
     * Get Application output
     *
     * @return string
     */
    public function getOutput() : string
    {
        return $this->app->handle('/')->getContent();
    }

    /**
     * Get current Application instance
     *
     * @return MvcApplication
     */
    public function getApplication() : MvcApplication
    {
        return $this->app;
    }

    /**
     * Initialize the Service in the Dependency Injector Container.
     *
     * @param  ProviderInterface $provider
     * @param array $parameters
     * @return $this
     */
    protected function initializeProvider(ProviderInterface $provider, array $parameters = []) : Application
    {
        if (!empty($parameters)) {
            $provider->register($parameters);
        } else {
            $provider->register();
        }

        $provider->boot();

        $this->providers[$provider->getName()] = $provider;

        return $this;
    }
}
