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

use LogicException;
use Phalcon\Di\DiInterface;
use Phalcon\Di\Injectable;

abstract class AbstractProvider extends Injectable implements ProviderInterface
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName;

    /**
     * AbstractProvider constructor.
     *
     * @param DiInterface $di
     */
    final public function __construct(DiInterface $di)
    {
        if (!$this->providerName) {
            throw new LogicException(
                sprintf('Provider name is required! "%s" cannot have an empty name.', get_class($this))
            );
        }

        $this->setDI($di);
    }

    /**
     * Get Provider name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->providerName;
    }
}
