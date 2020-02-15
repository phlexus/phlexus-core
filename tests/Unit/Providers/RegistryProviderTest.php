<?php
declare(strict_types=1);

namespace Tests\Unit\Providers;

use Phlexus\Providers\AbstractProvider;
use Phlexus\Providers\ProviderInterface;
use Phlexus\Providers\RegistryProvider;
use PHPUnit\Framework\TestCase;

final class RegistryProviderTest extends TestCase
{
    /**
     * @test
     */
    public function implementation()
    {
        $class = $this->createMock(RegistryProvider::class);

        $this->assertInstanceOf(AbstractProvider::class, $class);
        $this->assertInstanceOf(ProviderInterface::class, $class);
    }
}
