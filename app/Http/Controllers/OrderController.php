<?php

namespace App\Http\Controllers;

use App\Http\Services\ResponseService;
use App\Kafka\Producers\KafkaProducer;
use Illuminate\Http\Request;
use App\Models\Cart;

class OrderController extends Controller
{
    //
    public function checkOutAction(Request $request)
    {
        $items = Cart::where('user_id', $request->user()->id)->select('product_id')->get();
        new KafkaProducer('checkout', $items, $request->user()->id);
        return ResponseService::success([], null, 201);
    }
}
