<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Registry;

class ModulesProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'modules';

    /**
     * Array of all modules to configure / register / boot
     *
     * @var array
     */
    protected $modules = [];

    public function configure()
    {
        // TODO
    }

    /**
     * Register application provider
     *
     * @return void
     */
    public function register()
    {
        $configuredModules = $this->modules;
        $this->di->setShared($this->providerName, function () use ($configuredModules) {
            $registry = new Registry();
            foreach ($configuredModules as $name => $module) {
                $registry->offsetSet($name, (object)$module);
            }

            return $registry;
        });
    }

    /**
     * Boot registered provider
     *
     * @see ModulesProvider::register()
     * @return void
     */
    public function boot()
    {
        $registeredModules = [];
        foreach ($this->modules as $name => $module) {
            // TODO
        }

        $application = phlexus_container('bootstrap')->getApplication();
        $application->registerModules($registeredModules);
    }
}
