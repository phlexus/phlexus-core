<?php declare(strict_types=1);

if (!function_exists('phlexus_container')) {
    /**
     * Calls the default Dependency Injection container.
     *
     * @param  mixed
     * @return mixed|\Phalcon\DiInterface
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
