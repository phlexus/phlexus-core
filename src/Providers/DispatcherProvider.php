<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Cli\Dispatcher as CliDi;
use Phalcon\Mvc\Dispatcher as MvcDi;
use Phlexus\Application;
use Phlexus\Event\EventException;

/**
 * Class DispatcherProvider
 *
 * @package Phlexus\Providers
 */
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
        /** @var DispatcherProvider $provider */
        $provider = $this;

        $this->di->setShared($this->providerName, function() use ($parameters, $provider) {
            $provider->initializeGlobalEvents($parameters);

            if (phlexus_container(Application::APP_CONTAINER_NAME)->getMode() === Application::MODE_CLI) {
                $dispatcher = new CliDi();
                $provider->initializeCliEvents($parameters);
            } else {
                $dispatcher = new MvcDi();
                $provider->initializeMvcEvents($parameters);
            }

            $dispatcher->setDI(phlexus_container());
            $dispatcher->setEventsManager(phlexus_container('eventsManager'));

            return $dispatcher;
        });
    }

    /**
     * @param array $events
     * @throws EventException
     */
    protected function initializeGlobalEvents(array $events): void
    {
        if (empty($events['global'])) {
            return;
        }

        foreach ($events['global'] as $handler => $class) {
            $this->initializeEvent($handler, $class);
        }
    }

    /**
     * @param array $events
     * @throws EventException
     */
    protected function initializeMvcEvents(array $events): void
    {
        if (empty($events['mvc'])) {
            return;
        }

        foreach ($events['mvc'] as $handler => $class) {
            $this->initializeEvent($handler, $class);
        }
    }

    /**
     * @param array $events
     * @throws EventException
     */
    protected function initializeCliEvents(array $events): void
    {
        if (empty($events['cli'])) {
            return;
        }

        foreach ($events['cli'] as $handler => $class) {
            $this->initializeEvent($handler, $class);
        }
    }

    /**
     * @param string $handler
     * @param string $class
     * @throws EventException
     */
    protected function initializeEvent(string $handler, string $class): void
    {
        if (!class_exists($class)) {
            throw new EventException('Event class do not exists: ' . $class);
        }

        phlexus_container('eventsManager')->attach($handler, new $class($this));
    }
}
