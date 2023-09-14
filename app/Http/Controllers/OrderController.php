<?php

namespace App\Http\Controllers;

use App\Events\CheckOut;
use App\Http\Services\ResponseService;
use App\Kafka\Producers\KafkaProducer;
use Illuminate\Http\Request;
use App\Models\Cart;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        $items = Cart::where('user_id', $request->user()->id)->select('product_id')->get();
        $KafkaProducer = new KafkaProducer();
        $KafkaProducer('checkout', $items, $request->user()->id);
        CheckOut::dispatch();
        return ResponseService::success([], null, 201);
    }
}
