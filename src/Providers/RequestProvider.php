<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Http\Request;

/**
 * Class RequestProvider
 *
 * @package Phlexus\Providers
 */
class RequestProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'request';

    /**
     * Register application service.
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, Request::class);
    }
}
