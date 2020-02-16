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
     */
    public function register(array $parameters = []): void
    {
        $this->getDI()->setShared($this->providerName, Escaper::class);
    }
}
