<?php

declare(strict_types=1);

namespace Tests\Unit\Providers;

use Phlexus\Providers\AbstractProvider;
use Phlexus\Providers\ProviderInterface;
use Phlexus\Providers\ViewProvider;
use PHPUnit\Framework\TestCase;

final class ViewProviderTest extends TestCase
{
    /**
     * @test
     */
    public function implementation()
    {
        $class = $this->createMock(ViewProvider::class);

        $this->assertInstanceOf(AbstractProvider::class, $class);
        $this->assertInstanceOf(ProviderInterface::class, $class);
    }
}
