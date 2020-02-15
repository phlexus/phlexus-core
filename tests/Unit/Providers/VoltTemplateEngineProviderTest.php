<?php

declare(strict_types=1);

namespace Tests\Unit\Providers;

use Phlexus\Providers\AbstractProvider;
use Phlexus\Providers\ProviderInterface;
use Phlexus\Providers\VoltTemplateEngineProvider;
use PHPUnit\Framework\TestCase;

final class VoltTemplateEngineProviderTest extends TestCase
{
    /**
     * @test
     */
    public function implementation()
    {
        $class = $this->createMock(VoltTemplateEngineProvider::class);

        $this->assertInstanceOf(AbstractProvider::class, $class);
        $this->assertInstanceOf(ProviderInterface::class, $class);
    }
}
