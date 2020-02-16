<?php

declare(strict_types=1);

namespace Tests\Integration;

use InvalidArgumentException;
use Phalcon\Mvc\Application as MvcApplication;
use Phlexus\Application;
use Tests\IntegrationTestCase;

final class ApplicationTest extends IntegrationTestCase
{
    /**
     * @return array
     */
    public function modesDataProvider(): array
    {
        return [
            [Application::MODE_DEFAULT],
            [Application::MODE_API],
            [Application::MODE_CLI],
        ];
    }

    /**
     * @return array
     */
    public function rootPathsDataProvider(): array
    {
        $ds = DIRECTORY_SEPARATOR;

        return [
            [''],
            [__DIR__],
            [dirname(__DIR__)],
            ["..$ds"],
            ["..$ds..$ds"],
        ];
    }

    /**
     * @test
     * @dataProvider modesDataProvider
     *
     * @param string $mode
     */
    public function initMode(string $mode): void
    {
        $app = new Application('', $mode);

        $this->assertSame($mode, $app->getMode());
    }

    /**
     * @test
     */
    public function initDefault(): void
    {
        $app = new Application('');
        $this->assertInstanceOf(MvcApplication::class, $app->getApplication());
    }

    /**
     * @test
     */
    public function unknownMode(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Application('', 'unknown');
    }

    /**
     * @test
     * @dataProvider rootPathsDataProvider
     *
     * @param string $path
     */
    public function rootPath(string $path): void
    {
        $app = new Application($path);

        $this->assertSame($path, $app->getRootPath());
    }
}
