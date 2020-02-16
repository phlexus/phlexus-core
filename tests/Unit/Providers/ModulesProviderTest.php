<?php

declare(strict_types=1);

namespace Tests\Unit\Providers;

use Phlexus\Providers\AbstractProvider;
use Phlexus\Providers\ModulesProvider;
use Phlexus\Providers\ProviderInterface;
use PHPUnit\Framework\TestCase;

final class ModulesProviderTest extends TestCase
{
    /**
     * @test
     */
    public function implementation(): void
    {
        $class = $this->createMock(ModulesProvider::class);

        $this->assertInstanceOf(AbstractProvider::class, $class);
        $this->assertInstanceOf(ProviderInterface::class, $class);
    }
}
