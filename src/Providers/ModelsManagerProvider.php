<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Mvc\Model\Manager;

class ModelsManagerProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'modelsManager';

    /**
     * Register application provider
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function () {
            /** @var \Phalcon\DiInterface $this */
            $modelsManager = new Manager();
            //$modelsManager->setEventsManager($this->getShared('eventsManager'));
            return $modelsManager;
        });
    }
}
