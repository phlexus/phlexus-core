<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;

final class BasicTest extends TestCase
{
    /**
     * @test
     */
    public function basicAssert()
    {
        $this->assertTrue(true);
    }
}
