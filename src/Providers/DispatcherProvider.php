<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Mvc\Dispatcher;

class DispatcherProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'dispatcher';

    /**
     * Register application provider
     *
     * @return void
     */
    public function register()
    {
        $this->di->setShared($this->providerName, function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDI(phlexus_container());

            return $dispatcher;
        });
    }
}
