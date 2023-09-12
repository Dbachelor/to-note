<?php

namespace App\Http\Managers;

use App\Models\OrderDetails;

class OrderDetailsManager
{
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