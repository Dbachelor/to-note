<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testIndex(): void
    {
        $productController = new ProductController();
        $this->assertNotNull($productController->index(), 'if false kindly run php artisan db:seed --class=ProductSeeder');
    }
}
