<?php

namespace Tests\Unit;

use App\Http\Controllers\CartController;
use App\Models\Cart;
use PHPUnit\Framework\TestCase;

class CartControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testIndex(): void
    {
        $this->assertEquals([], []);
    }
}
