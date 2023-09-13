<?php

namespace App\Http\Controllers;

use App\Events\CartItem;
use App\Http\Managers\CartManager;
use App\Http\Services\ResponseService;
use App\Kafka\Consumers\CartConsumer;
use App\Kafka\Producers\KafkaProducer;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    public function index()
    {
        return Cart::all();
    }

    public function consume(Request $request)
    {
        new CartConsumer(1);
        return ResponseService::success($request->all(), 'item added to cart', 201);
    }

    public function store(Request $request)
    {
        new KafkaProducer('cart_items', $request->products, $request->user()->id);
        CartItem::dispatch($request->user()->id);
        return ResponseService::success($request->all(), 'item added to cart', 201);
    }

    public function destroy($id)
    {
        return Cart::find($id)->delete()?ResponseService::success([], null, 204):ResponseService::error();
    }

}
