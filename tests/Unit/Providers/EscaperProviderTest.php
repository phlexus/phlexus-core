<?php

declare(strict_types=1);

namespace Tests\Unit\Providers;

use Phlexus\Providers\AbstractProvider;
use Phlexus\Providers\EscaperProvider;
use Phlexus\Providers\ProviderInterface;
use PHPUnit\Framework\TestCase;

final class EscaperProviderTest extends TestCase
{
    /**
     * @test
     */
    public function implementation()
    {
        $class = $this->createMock(EscaperProvider::class);

        $this->assertInstanceOf(AbstractProvider::class, $class);
        $this->assertInstanceOf(ProviderInterface::class, $class);
    }
}
