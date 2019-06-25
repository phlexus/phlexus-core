<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Security;

class SecurityProvider extends AbstractProvider
{
    /**
     * Default hashing factor number rounds
     */
    const DEFAULT_WORK_FACTOR = 12;

    /**
     * Configuration key name
     */
    const WORK_FACTOR_PARAM_KEY = 'work_factor';

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
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->di->setShared($this->providerName, function () use ($parameters) {
            $workFactor = $parameters[self::WORK_FACTOR_PARAM_KEY] ?? self::DEFAULT_WORK_FACTOR;

            $security = new Security();
            $security->setWorkFactor($workFactor);

            return $security;
        });
    }
}
