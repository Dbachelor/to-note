<?php

namespace App\Kafka\Consumers;

use App\Http\Managers\CartManager;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Junges\Kafka\Facades\Kafka;

class CartConsumer
{
    public function __construct($topic='cart_items')
    {
        $consumer = Kafka::createConsumer([$topic])->subscribe($topic);
        $consumer->withHandler(function(KafkaConsumerMessage $message){
            if ('cart_items' == $message->getTopicName()){
                $items = $message->getBody();
                $user_id = 1;//$message->getKey();
                CartManager::addItemToCart($user_id, $items->data);
            }
        })->build()->consume();
    }
}