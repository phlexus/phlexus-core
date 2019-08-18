<?php declare(strict_types=1);

namespace Phlexus\Module;

use Phalcon\Events\EventsAwareInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

interface ModuleInterface extends ModuleDefinitionInterface, EventsAwareInterface
{
    public function initialize();

    public function getHandlersNamespace();

    public static function getModuleName(): string;
}
