<?php

/**
 * This file is part of the Phlexus CMS.
 *
 * (c) Phlexus CMS <cms@phlexus.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

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
     */
    public function register(array $parameters = []): void
    {
        $this->getDI()->setShared($this->providerName, function () use ($parameters) {
            return (new PdoFactory())->load($parameters);
        });
    }
}
