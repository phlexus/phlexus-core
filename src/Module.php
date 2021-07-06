<?php

/**
 * This file is part of the Phlexus CMS.
 *
 * (c) Phlexus CMS <cms@phlexus.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phlexus;

use Phalcon\Di\DiInterface;
use Phalcon\Events\Manager;
use Phalcon\Events\ManagerInterface;
use Phlexus\Module\ModuleInterface;
use Phlexus\Helpers;

/**
 * Phlexus Module Definition
 *
 * Current class must be extended inside each Custom Module
 */
abstract class Module implements ModuleInterface
{
    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * @var ManagerInterface|null
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
        $this->di = $di ?: Helpers::phlexusContainer();
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
    public function getEventsManager(): ManagerInterface
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
     * @return void
     */
    public function setEventsManager(ManagerInterface $eventsManager): void
    {
        $this->eventsManager = $eventsManager;
    }
}
