<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Tag;

/**
 * Class TagProvider
 *
 * @package Phlexus\Providers
 */
class TagProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'tag';

    /**
     * Register application service.
     *
     * @param array $parameters
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, Tag::class);
    }
}
