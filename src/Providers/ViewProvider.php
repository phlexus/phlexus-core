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
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function() {
            return new View();
        });
    }
}
