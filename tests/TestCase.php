<?php
declare(strict_types=1);

namespace Tests;

use Phlexus\Application;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * Class TestCase
 *
 * @package Tests
 */
abstract class TestCase extends PHPUnitTestCase
{
    use ApplicationTest;

    /**
     * Set Up fixture
     *
     * Instantiate Phlexus Application
     */
    public function setUp(): void
    {
        if (!$this->app instanceof Application) {
            $this->createApplication();
        }
    }
}
