<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Mvc\Model\Metadata\Memory as Memory;

class ModelsMetadataProvider extends AbstractProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'modelsMetadata';

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->serviceName, function () {
            return new Memory();
        });
    }
}
