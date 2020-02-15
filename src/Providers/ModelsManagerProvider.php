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
            /** @var \Phalcon\Di\DiInterface $this */
            $modelsManager = new Manager();
            //$modelsManager->setEventsManager($this->getShared('eventsManager'));
            return $modelsManager;
        });
    }
}
