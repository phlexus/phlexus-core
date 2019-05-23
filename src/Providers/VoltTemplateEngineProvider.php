<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Mvc\View\Engine\Volt;

class VoltTemplateEngineProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'volt';

    /**
     * Register application service.
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $di = $this->getDI();
        $view = $di->getShared('view');
        $di->setShared($this->providerName, function() use ($view, $di, $parameters) {
            $volt = new Volt($view, $di);

            if (!empty($parameters['volt'])) {
                $volt->setOptions($parameters['volt']);
            }

            return $volt;
        });
    }
}
