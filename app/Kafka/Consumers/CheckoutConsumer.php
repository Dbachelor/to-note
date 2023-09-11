<?php

namespace App\Kafka\Consumers;

use App\Http\Managers\OrderManager;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Junges\Kafka\Facades\Kafka;

class CartConsumer
{
    public function __invoke($topic='checkout')
    {
        $consumer = Kafka::createConsumer()->subscribe($topic);
        $consumer->withHandler(function(KafkaConsumerMessage $message){
            if ('checkout' == $message->getTopicName()){
                $items = $message->getBody();
                $user_id = $message->getKey();
                OrderManager::handleOrderPlacement($user_id, $items);
            }
        })->build()->consume();
    }
}