<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Config;

class ConfigProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'config';

    /**
     * Register application provider
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function() use ($parameters) {
            return new Config($parameters);
        });
    }
}
