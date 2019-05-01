<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Files;

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
            $session = new Manager();
            $session->setHandler(new Files(['savePath' => '/tmp']));
            $session->start();

            return $session;
        });
    }
}
