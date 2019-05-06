<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\GroupInterface;

class RouterProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'router';

    /**
     * Register application service.
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function() {
            $router = new Router(false);
            $router->removeExtraSlashes(true);

            $modules = phlexus_container('modules')->toArray();
            foreach ($modules as $module) {
                if (empty($module->router)) {
                    continue;
                }

                if (!file_exists($module->router)) {
                    continue;
                }

                $group = require $module->router;
                if (!$group instanceof GroupInterface) {
                    continue;
                }

                $router->mount($group);
            }

            $router->setDI(phlexus_container());

            return $router;
        });
    }
}
