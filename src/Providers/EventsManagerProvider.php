<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Events\Manager;
use Phlexus\Event\EventException;

class EventsManagerProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'eventsManager';

    /**
     * Register application service.
     *
     * @param array $events
     * @return void
     */
    public function register(array $events = [])
    {
        $this->di->setShared($this->providerName, function () use ($events) {
            $manager = new Manager();
            $manager->enablePriorities(true);

            foreach ($events as $handler => $class) {
                if (!class_exists($class)) {
                    throw new EventException('Event class do not exists: ' . $class);
                }

                $manager->attach($handler, new $class($this));
            }

            return $manager;
        });
    }
}
