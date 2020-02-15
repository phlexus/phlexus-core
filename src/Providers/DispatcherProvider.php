<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Cli\Dispatcher as CliDi;
use Phalcon\Mvc\Dispatcher as MvcDi;
use Phlexus\Application;

class DispatcherProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'dispatcher';

    /**
     * Register application provider
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function() {
            if (phlexus_container(Application::APP_CONTAINER_NAME)->getMode() === Application::MODE_CLI) {
                $dispatcher = new CliDi();
            } else {
                $dispatcher = new MvcDi();
            }

            $dispatcher->setDI(phlexus_container());
            $dispatcher->setEventsManager(phlexus_container('eventsManager'));

            return $dispatcher;
        });
    }
}
