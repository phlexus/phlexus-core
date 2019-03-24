<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;

/**
 * Class BasicTest
 *
 * @package Tests\Unit
 */
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
