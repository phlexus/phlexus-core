<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Http\Response;

class ResponseProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'response';

    /**
     * Register application provider
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, Response::class);
    }
}
