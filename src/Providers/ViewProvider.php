<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Mvc\View;

class ViewProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'view';

    /**
     * Register application service.
     *
     * @return void
     */
    public function register()
    {
        $this->di->setShared($this->providerName, function() {
            return new View();
        });
    }
}
