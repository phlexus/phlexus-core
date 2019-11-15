<?php
declare(strict_types=1);

namespace Tests\Unit;

use Phalcon\Mvc\Application as MvcApplication;
use Phlexus\Application;
use Tests\TestCase;

final class ApplicationTest extends TestCase
{
    /**
     * @test
     */
    public function init()
    {
        $app = new Application();
        $this->assertInstanceOf(MvcApplication::class, $app->getApplication());
    }
}
