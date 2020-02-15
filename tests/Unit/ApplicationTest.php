<?php
declare(strict_types=1);

namespace Tests\Unit;

use InvalidArgumentException;
use Phalcon\Mvc\Application as MvcApplication;
use Phlexus\Application;
use Tests\TestCase;

final class ApplicationTest extends TestCase
{
    /**
     * @return array
     */
    public function modesDataProvider(): array
    {
        return [
            [Application::MODE_DEFAULT]
            [Application::MODE_API],
            [Application::MODE_CLI],
        ];
    }

    /**
     * @test
     * @dataProvider modesDataProvider
     *
     * @param string $mode
     */
    public function initMode($mode)
    {
        $app = new Application($mode);

        $this->assertSame($mode, $app->getMode());
    }

    /**
     * @test
     *
     * @return void
     */
    public function initDefault()
    {
        $app = new Application();
        $this->assertInstanceOf(MvcApplication::class, $app->getApplication());
    }

    /**
     * @test
     *
     * @return void
     */
    public function unknownMode()
    {
        $this->expectException(InvalidArgumentException::class);
        new Application('unknown');
    }
}
