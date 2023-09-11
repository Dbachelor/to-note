<?php

namespace App\Kafka\Consumers;

use App\Http\Managers\CartManager;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Junges\Kafka\Facades\Kafka;

class CartConsumer
{
    public function __invoke($topic='cart_items')
    {
        $consumer = Kafka::createConsumer()->subscribe($topic);
        $consumer->withHandler(function(KafkaConsumerMessage $message){
            if ('cart_items' == $message->getTopicName()){
                $items = $message->getBody();
                $user_id = $message->getKey();
                CartManager::addItemToCart($user_id, $items);
            }
        })->build()->consume();
    }
}