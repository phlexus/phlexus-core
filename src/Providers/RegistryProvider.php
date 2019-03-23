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
     * @return void
     */
    public function register()
    {
        $this->di->setShared($this->providerName, function(){
            return new Registry();
        });
    }
}
