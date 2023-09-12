<?php

namespace App\Http\Managers;

use App\Models\Order;

class OrderManager
{
    public static function handleOrderPlacement(int $user_id, array $order) : void
    {
        $amount = ProductManager::calculateCost($order);
        //enter order
        self::saveOrder($user_id, $amount);
        //save order details
        OrderDetailsManager::saveOrderDetails($user_id, $order);
        //empty cart for the user
        CartManager::delete($user_id);
    }

    public static function saveOrder(int $user_id, float $amount) : void
    {
        $order = new Order();
        $order->user_id = $user_id;
        $order->amount = $amount;
        $order->save();
    }
}