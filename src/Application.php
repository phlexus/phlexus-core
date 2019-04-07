<?php declare(strict_types=1);

namespace Phlexus;

use InvalidArgumentException;
use Phalcon\Cli\Console;
use Phalcon\Di;
use Phalcon\DiInterface;
use Phalcon\Mvc\Application as MvcApplication;
use Phlexus\Providers\ConfigProvider;
use Phlexus\Providers\DispatcherProvider;
use Phlexus\Providers\ModelsManagerProvider;
use Phlexus\Providers\ModelsMetadataProvider;
use Phlexus\Providers\ModulesProvider;
use Phlexus\Providers\ProviderInterface;
use Phlexus\Providers\RegistryProvider;
use Phlexus\Providers\ResponseProvider;
use Phlexus\Providers\RouterProvider;
use Phlexus\Providers\ViewProvider;

/**
 * Plexus Application
 *
 * @package Phlexus
 */
class Application
{
    /**
     * Default MVC Mode
     *
     * Default behaviour of WEB Application
     */
    const MODE_DEFAULT = 'default';

    /**
     * Console Mode
     *
     * Used for tasks and cron jobs
     */
    const MODE_CLI = 'cli';

    /**
     * MC Mode
     *
     * Model and Controller mode without View.
     * Controllers always returns array which is
     * transformed into JSON and send to client.
     */
    const MODE_API = 'api';

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
     * Application MVC request
     *
     * @var string
     */
    protected $requestUri = '/';

    /**
     * Application mode
     *
     * Possible values: default and cli
     *
     * @var string
     */
    protected $mode;

    /**
     * Application Service Providers
     *
     * @var ProviderInterface[]
     */
    protected $providers = [];

    /**
     * Application constructor
     *
     * @param string $mode
     * @param array $configs
     * @param array $vendorModules
     */
    public function __construct(
        string $mode = self::MODE_DEFAULT,
        array $configs = [],
        array $vendorModules = []
    ) {
        $this->di = new Di();
        $this->app = $this->createApplication($mode);
        $this->di->setShared('bootstrap', $this);

        Di::setDefault($this->di);

        $modules = [
            'vendor' => $vendorModules,
            'custom' => $configs['modules'] ?? [],
        ];

        $viewConfigs = $configs['view'] ?? [];

        // Init Generic Service Providers
        $this->initializeProvider(new RegistryProvider($this->di));
        $this->initializeProvider(new ConfigProvider($this->di), $configs);
        $this->initializeProvider(new ModelsManagerProvider($this->di));
        $this->initializeProvider(new ModelsMetadataProvider($this->di));
        $this->initializeProvider(new ModulesProvider($this->di), $modules);
        $this->initializeProvider(new RouterProvider($this->di));
        $this->initializeProvider(new DispatcherProvider($this->di));
        $this->initializeProvider(new ResponseProvider($this->di));

        // Init Mode Service Providers
        if ($mode == self::MODE_DEFAULT) {
            $this->initializeProvider(new ViewProvider($this->di), $viewConfigs);
        }

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
        return $this->app->handle($this->requestUri)->getContent();
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
        $provider->register($parameters);
        $provider->boot();

        $this->providers[$provider->getName()] = $provider;

        return $this;
    }

    /**
     * Create Internal Application
     *
     * @param string $mode
     * @return Console|MvcApplication
     * @throws InvalidArgumentException
     */
    protected function createApplication(string $mode)
    {
        $this->mode = $mode;

        switch ($mode) {
            case self::MODE_DEFAULT:
            case self::MODE_API:
                return new MvcApplication($this->di);
            case self::MODE_CLI:
                return new Console($this->di);
            default:
                throw new InvalidArgumentException('Invalid application mode: ' . $mode);
        }
    }
}
