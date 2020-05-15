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
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Session\Manager;

class FlashProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'flash';

    /**
     * Register application service.
     *
     * @psalm-suppress UndefinedMethod
     *
     * @param array $parameters Custom parameters for Service Provider
     */
    public function register(array $parameters = []): void
    {
        $this->getDI()->setShared($this->providerName, function () use ($parameters) {
            $session = new Manager();
            
            $files = new Stream(
                [
                    'savePath' => $parameters['path'],
                ]
            );
            
            $session->setAdapter($files);

            $escaper = new Escaper();
            
            $flash   = new FlashSession($escaper, $session);

            return $flash;
        });
    }
}
