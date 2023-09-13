<?php

namespace App\Kafka\Consumers;

use App\Http\Managers\OrderManager;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Junges\Kafka\Facades\Kafka;

class CartConsumer
{
    public function __construct($topic='checkout')
    {
        $consumer = \Junges\Kafka\Facades\Kafka::createConsumer(['cart_items'])
       ->subscribe('cart_items')
        ->withConsumerGroupId('group')
        ->withDlq('cart_items')
        ->withMaxMessages(1)
        ->withHandler(function(KafkaConsumerMessage $message){
            if ('cart_items' == $message->getTopicName()){
                $items = $message->getBody();
                $user_id = $message->getKey();
                Log::alert($items);
                OrderManager::handleOrderPlacement($user_id, $items->data);
            }
        })->build(); 

        $consumer->stopConsuming();
        $consumer->consume();
    }
}