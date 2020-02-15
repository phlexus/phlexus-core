<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Di\InjectionAwareInterface;

interface ProviderInterface extends InjectionAwareInterface
{
    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = []);

    /**
     * Get the Service name.
     *
     * @return string
     */
    public function getName();
}
