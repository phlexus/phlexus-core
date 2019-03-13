<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Di\InjectionAwareInterface;

interface ProviderInterface extends InjectionAwareInterface
{
    /**
     * Register application service.
     *
     * @return void
     */
    public function register();

    /**
     * Package boot method.
     *
     * @return void
     */
    public function boot();

    /**
     * Configures the current service provider.
     *
     * @return void
     */
    public function configure();

    /**
     * Get the Service name.
     *
     * @return string
     */
    public function getName();
}
