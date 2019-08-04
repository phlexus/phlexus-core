<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Db\Adapter\PdoFactory;

class DatabaseProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'db';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function () use ($parameters) {
            return PdoFactory::load($parameters);
        });
    }
}
