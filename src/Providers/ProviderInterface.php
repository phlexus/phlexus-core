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

use Phalcon\Di\InjectionAwareInterface;

interface ProviderInterface extends InjectionAwareInterface
{
    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     */
    public function register(array $parameters = []): void;

    /**
     * Get the Service name.
     *
     * @return string
     */
    public function getName(): string;
}
