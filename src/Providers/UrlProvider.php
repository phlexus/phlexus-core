<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Mvc\Url;

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
        $this->di->setShared($this->providerName, Url::class);
    }
}
