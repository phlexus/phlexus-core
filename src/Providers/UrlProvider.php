<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Url;

class UrlProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'url';

    /**
     * Register application service.
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function () use ($parameters) {
            $url = new Url();
            if (isset($parameters['base_uri'])) {
                $url->setBaseUri($parameters['base_uri']);
            }

            return $url;
        });
    }
}
