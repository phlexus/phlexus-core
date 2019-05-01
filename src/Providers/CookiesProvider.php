<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Http\Response\Cookies;

class CookiesProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'cookies';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function () {
            $cookies = new Cookies();
            $cookies->useEncryption(false);

            return $cookies;
        });
    }
}
