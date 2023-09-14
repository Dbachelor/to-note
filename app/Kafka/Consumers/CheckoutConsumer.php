<?php

namespace App\Kafka\Consumers;

use App\Http\Managers\OrderManager;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Junges\Kafka\Facades\Kafka;

class CheckOutConsumer
{
    public function __invoke($topic='checkout')
    {
        $consumer = \Junges\Kafka\Facades\Kafka::createConsumer(['checkout'])
       ->subscribe('checkout')
        ->withConsumerGroupId('group')
        ->withDlq('checkout')
        ->withMaxMessages(1)
        ->withHandler(function(KafkaConsumerMessage $message){
            if ('checkout' == $message->getTopicName()){
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