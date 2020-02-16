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

use Phalcon\Security;

class SecurityProvider extends AbstractProvider
{
    /**
     * Default hashing factor number rounds
     */
    public const DEFAULT_WORK_FACTOR = 12;

    /**
     * Configuration key name
     */
    public const WORK_FACTOR_PARAM_KEY = 'work_factor';

    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'security';

    /**
     * Register application provider
     *
     * @param array $parameters
     */
    public function register(array $parameters = []): void
    {
        $this->getDI()->setShared($this->providerName, function () use ($parameters) {
            $workFactor = $parameters[self::WORK_FACTOR_PARAM_KEY] ?? self::DEFAULT_WORK_FACTOR;

            $security = new Security();
            $security->setWorkFactor($workFactor);

            return $security;
        });
    }
}
