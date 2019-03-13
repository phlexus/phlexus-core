<?php declare(strict_types=1);

namespace Phlexus;

use Phalcon\Mvc\Application as MvcApplication;

class Application
{
    protected $app;

    public function __construct()
    {
        $this->app = new MvcApplication();
    }

    public function run()
    {
        return $this->getOutput();
    }

    public function getOutput()
    {
        return $this->app->handle()->getContent();
    }
}
