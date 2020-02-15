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

if (!function_exists('phlexus_container')) {
    /**
     * Calls the default Dependency Injection container.
     *
     * @param mixed
     * @return \Phalcon\Di\DiInterface
     */
    function phlexus_container()
    {
        $default = \Phalcon\Di::getDefault();
        $args = func_get_args();
        if (empty($args)) {
            return $default;
        }

        return call_user_func_array([$default, 'get'], $args);
    }
}

if (!function_exists('phlexus_config')) {
    /**
     * Access configuration files
     *
     * Also can access nested values.
     * Example: phlexus_config('config.db.name')
     *
     * @param mixed
     * @return mixed
     */
    function phlexus_config()
    {
        $args = func_get_args();
        $config = \Phalcon\Di::getDefault()->getShared('config');

        if (empty($args)) {
            return $config;
        }

        return call_user_func_array([$config, 'path'], $args);
    }
}

if (!function_exists('phlexus_model')) {
    /**
     * @param string $model
     * @return mixed
     */
    function phlexus_model(string $model)
    {
        if (class_exists($model) && $model instanceof \Phalcon\Mvc\ModelInterface) {
            /**
             * @psalm-suppress UndefinedClass
             */
            return new $model();
        }

        return null;
    }
}

if (!function_exists('phlexus_themes_path')) {
    /**
     * @param string $config
     * @return string|null
     */
    function phlexus_themes_path(string $config = 'theme.themes_dir')
    {
        return phlexus_config($config);
    }
}
