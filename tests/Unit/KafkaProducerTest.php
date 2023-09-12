<?php

namespace Tests\Unit;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;
use Tests\TestCase;


class KafkaProducerTest extends TestCase
{
     public function testPublishCartItems()
     {
         Kafka::fake();
         $message = new Message(
            headers: [],
            body: ['data' => [1,2,3]],
            key: 1
        );
         $producer = Kafka::publishOn('cart_items')->withMessage($message);
             
         $producer->send();
             
         Kafka::assertPublishedOn('cart_items');       
     }

     public function testPublishCheckout()
     {
         Kafka::fake();
         $message = new Message(
            headers: [],
            body: ['data' => [1,2,3]],
            key: 1
        );
         $producer = Kafka::publishOn('checkout')->withMessage($message);
             
         $producer->send();
             
         Kafka::assertPublishedOn('checkout');       
     }
}
