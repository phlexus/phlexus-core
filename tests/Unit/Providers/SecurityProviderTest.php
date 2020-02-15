<?php

declare(strict_types=1);

namespace Tests\Unit\Providers;

use Phlexus\Providers\AbstractProvider;
use Phlexus\Providers\ProviderInterface;
use Phlexus\Providers\SecurityProvider;
use PHPUnit\Framework\TestCase;

final class SecurityProviderTest extends TestCase
{
    /**
     * @test
     */
    public function implementation()
    {
        $class = $this->createMock(SecurityProvider::class);

        $this->assertInstanceOf(AbstractProvider::class, $class);
        $this->assertInstanceOf(ProviderInterface::class, $class);
    }
}
