<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Session\Adapter\Files as Session;

class SessionProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'session';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function () {
            $session = new Session();
            $session->start();

            return $session;
        });
    }
}
