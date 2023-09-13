<?php

namespace App\Listeners;

use App\Events\CheckOut;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckOutListener
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
    public function handle(CheckOut $event): void
    {
        //
        new CheckOutListener();
    }
}
