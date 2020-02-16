<?php

declare(strict_types=1);

namespace Tests\Unit\Providers;

use Phlexus\Providers\AbstractProvider;
use Phlexus\Providers\ConfigProvider;
use Phlexus\Providers\ProviderInterface;
use PHPUnit\Framework\TestCase;

final class ConfigProviderTest extends TestCase
{
    /**
     * @test
     */
    public function implementation(): void
    {
        $class = $this->createMock(ConfigProvider::class);

        $this->assertInstanceOf(AbstractProvider::class, $class);
        $this->assertInstanceOf(ProviderInterface::class, $class);
    }
}
