<?php declare(strict_types=1);

namespace Phlexus\Providers;

use LogicException;
use Phalcon\DiInterface;
use Phalcon\Mvc\User\Component;

abstract class AbstractProvider extends Component implements ProviderInterface
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName;

    final public function __construct(DiInterface $di)
    {
        if (!$this->providerName) {
            throw new LogicException(
                sprintf('Provider name is required! "%s" cannot have an empty name.', get_class($this))
            );
        }

        $this->setDI($di);
        $this->configure();
    }

    /**
     * Get Provider name
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->providerName;
    }

    /**
     * @return void
     */
    public function boot()
    {
        // Implement in child class
    }

    /**
     * @return void
     */
    public function configure()
    {
        // Implement in child class
    }
}
