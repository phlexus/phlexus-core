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

use Phalcon\Http\Response\Cookies;

class CookiesProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'cookies';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = [])
    {
        $this->getDI()->setShared($this->providerName, function () {
            $cookies = new Cookies();
            $cookies->useEncryption(false);

            return $cookies;
        });
    }
}
