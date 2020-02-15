<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Mvc\Model\Metadata\Memory as MemoryMetadata;

class ModelsMetadataProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'modelsMetadata';

    /**
     * Register application provider
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function () {
            return new MemoryMetadata();
        });
    }
}
