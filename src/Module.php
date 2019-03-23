<?php declare(strict_types=1);

namespace Phlexus;

use Phalcon\DiInterface;
use Phalcon\Events\Manager;
use Phalcon\Events\ManagerInterface;
use Phlexus\Module\ModuleInterface;

abstract class Module implements ModuleInterface
{
    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * @var Manager
     */
    protected $eventsManager;

    /**
     * Module constructor.
     *
     * @param DiInterface $di
     * @param Manager|null $manager
     */
    public function __construct(DiInterface $di = null, Manager $manager = null)
    {
        $this->di = $di ?: phlexus_container();
        $this->eventsManager = $manager;
    }

    /**
     * Initialize module.
     */
    public function initialize()
    {
        $this->registerAutoloaders($this->di);
        $this->registerServices($this->di);
    }

    /**
     * Returns the internal event manager.
     *
     * @return ManagerInterface
     */
    public function getEventsManager() : ManagerInterface
    {
        $manager = $this->eventsManager;
        if ($manager instanceof ManagerInterface) {
            return $manager;
        }

        if ($this->di->has('eventsManager')) {
            $manager = $this->di->getShared('eventsManager');
        } else {
            $manager = new Manager();
            $manager->enablePriorities(true);
        }

        $this->setEventsManager($manager);
        return $manager;
    }

    /**
     * Sets the events manager.
     *
     * @param  ManagerInterface $eventsManager
     * @return $this
     */
    public function setEventsManager(ManagerInterface $eventsManager)
    {
        $this->eventsManager = $eventsManager;
        return $this;
    }
}
