<?php

namespace App\Http\Managers;

use App\Models\Product;

class ProductManager
{
    public static function calculateCost(array $order) : float
    {
        $cost = 0.0;
        foreach ($order as $order)
        {
            $cost += Product::find($order)->price;
        }
        return (float) $cost;
    }
}