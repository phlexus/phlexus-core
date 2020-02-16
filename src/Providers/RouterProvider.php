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

use Phalcon\Config;
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
     */
    public function register(array $parameters = []): void
    {
        $this->getDI()->setShared($this->providerName, function () {
            $router = new Router(false);
            $router->removeExtraSlashes(true);

            /** @var Config $modules */
            $modules = phlexus_container('modules');
            $modules = $modules->toArray();
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
