<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Escaper;

class EscaperProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'escaper';

    /**
     * Register application service.
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, Escaper::class);
    }
}
