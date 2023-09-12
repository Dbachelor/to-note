<?php

namespace Tests\Unit;

use App\Http\Managers\CartManager;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class CartManagerTest extends TestCase
{
    /**
     * A unit test for delete action.
     */
    public function testDelete(): void
    {
        if (App::environment('test')){
            $this->assertTrue(CartManager::delete(1));
        }      
    }

}
