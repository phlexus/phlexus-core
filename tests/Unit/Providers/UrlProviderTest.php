<?php

declare(strict_types=1);

namespace Tests\Unit\Providers;

use Phlexus\Providers\AbstractProvider;
use Phlexus\Providers\ProviderInterface;
use Phlexus\Providers\UrlProvider;
use PHPUnit\Framework\TestCase;

final class UrlProviderTest extends TestCase
{
    /**
     * @test
     */
    public function implementation(): void
    {
        $class = $this->createMock(UrlProvider::class);

        $this->assertInstanceOf(AbstractProvider::class, $class);
        $this->assertInstanceOf(ProviderInterface::class, $class);
    }
}
