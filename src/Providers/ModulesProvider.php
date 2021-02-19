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

use Phalcon\Registry;
use Phlexus\Application;
use Phlexus\Helpers;

class ModulesProvider extends AbstractProvider
{
    /**
     * Constant to find match in composer vendor packages
     */
    public const PHLEXUS_NAMESPACE_PATTERN = 'Phlexus\Modules\\';

    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'modules';

    /**
     * Register application provider
     *
     * @param array $rawModules
     */
    public function register(array $rawModules = []): void
    {
        $vendorModules = $this->prepareVendorModules($rawModules['vendor']);
        $customModules = $this->prepareCustomModules($rawModules['custom']);
        $modules = array_merge($vendorModules, $customModules);

        /** @var Application $app */
        $app = Helpers::phlexusContainer('bootstrap');
        $app->getApplication()
            ->registerModules($modules);

        $this->getDI()->setShared($this->providerName, function () use ($modules) {
            $registry = new Registry();
            foreach ($modules as $name => $module) {
                $registry->offsetSet($name, (object)$module);
            }

            return $registry;
        });
    }

    /**
     * @param array $vendorModules
     * @return array
     */
    protected function prepareVendorModules(array $vendorModules = []): array
    {
        $modules = [];
        foreach ($vendorModules as $namespace => $path) {
            $phlexusPattern = str_replace('\\', '\\\\', self::PHLEXUS_NAMESPACE_PATTERN);
            if (!preg_match('#^' . $phlexusPattern . '(\w+)#', $namespace, $matches)) {
                continue;
            }

            $moduleName = $matches[1];
            $className = self::PHLEXUS_NAMESPACE_PATTERN . $moduleName . '\\Module';

            $modules[$moduleName] = [
                'className' => $className,
                'path' => $path[0] . DIRECTORY_SEPARATOR . 'Module.php',
                'router' => $path[0] . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'routes.php',
            ];

            $this->getDI()->setShared($className, $modules[$moduleName]);
        }

        return $modules;
    }

    /**
     * @param array $customModules
     * @return array
     */
    protected function prepareCustomModules(array $customModules = []): array
    {
        return $customModules;
    }
}
