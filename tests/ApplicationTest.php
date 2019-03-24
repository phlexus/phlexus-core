<?php declare(strict_types=1);

namespace Tests;

use Phlexus\Application;

/**
 * Trait ApplicationTest
 *
 * @package Tests
 */
trait ApplicationTest
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @return Application
     */
    public function createApplication() : Application
    {
        return new Application();
    }
}
