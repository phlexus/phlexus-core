<?php
declare(strict_types=1);

namespace Tests;

use Phlexus\Application;

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
