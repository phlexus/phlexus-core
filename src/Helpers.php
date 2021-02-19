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

class Helpers
{
    /**
     * Calls the default Dependency Injection container.
     *
     * @param mixed
     * @return \Phalcon\Di\DiInterface
     */
    public static function phlexusContainer()
    {
        $default = \Phalcon\Di::getDefault();
        $args = func_get_args();
        if (empty($args)) {
            return $default;
        }

        return call_user_func_array([$default, 'get'], $args);
    }

    /**
     * Access configuration files
     *
     * Also can access nested values.
     * Example: phlexus_config('config.db.name')
     *
     * @param mixed
     * @return mixed
     */
    public static function phlexusConfig()
    {
        $args = func_get_args();
        $config = \Phalcon\Di::getDefault()->getShared('config');

        if (empty($args)) {
            return $config;
        }

        return call_user_func_array([$config, 'path'], $args);
    }

    /**
     * @param string $model
     * @return mixed
     */
    public static function phlexusModel(string $model)
    {
        if (class_exists($model)) {
            /**
             * @psalm-suppress UndefinedClass
             */
            return new $model();
        }

        return null;
    }

    /**
     * @param string $config
     * @return string|null
     */
    public static function phlexusThemesPath(string $config = 'theme.themes_dir')
    {
        return self::phlexusConfig($config);
    }
}