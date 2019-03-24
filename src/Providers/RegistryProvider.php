<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Registry;

class RegistryProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'registry';

    /**
     * Register application service.
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function(){
            return new Registry();
        });
    }
}
