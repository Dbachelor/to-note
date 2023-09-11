<?php

namespace App\Http\Managers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;

class OrderManager
{
    public static function handleOrderPlacement(int $user_id, array $order) : void
    {
        $amount = self::calculateCost($order);
        //enter order
        self::saveOrder($user_id, $amount);
        //save order details
        self::saveOrderDetails($user_id, $order);
    }

    public static function calculateCost(array $order) : float
    {
        $cost = 0.0;
        foreach ($order as $order)
        {
            $cost += Product::find($order)->price;
        }
        return (float) $cost;
    }

    public static function saveOrder(int $user_id, float $amount) : void
    {
        $order = new Order();
        $order->user_id = $user_id;
        $order->amount = $amount;
        $order->save();
    }

    public static function saveOrderDetails(int $user_id, array $orders) : void
    {
        $oderDetails = [];
        foreach ($orders as $order) {
            $oderDetails['user_id'] = $user_id;
            $oderDetails['product_id'] = $order->product_id;
            $orderDetails['created_at'] = now();
            $orderDetails['updated_at'] = now();
        }
        OrderDetails::insert($oderDetails);
    }
}