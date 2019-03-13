<?php declare(strict_types=1);

namespace Phlexus\Providers;

use Phalcon\Mvc\User\Component;

abstract class AbstractProvider extends Component implements ProviderInterface
{
    protected $providerName;
}
