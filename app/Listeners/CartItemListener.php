<?php

namespace App\Listeners;

use App\Events\CartItem;
use App\Kafka\Consumers\CartConsumer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

class CartItemListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CartItem $event): void
    {
        Log::alert('This is some useful information.');
        new CartConsumer($event->user_id);
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            CartItem::class,
            [$this, 'handle']
        );
    }

}
