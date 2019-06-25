<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Events\Manager;

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
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function () {
            $manager = new Manager();
            $manager->enablePriorities(true);

            return $manager;
        });
    }
}
