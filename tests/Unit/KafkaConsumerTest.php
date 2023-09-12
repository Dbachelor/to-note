<?php

namespace Tests\Unit;

use App\Models\Cart;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\ConsumedMessage;
use Tests\TestCase as TestCase;


class KafkaConsumerTest extends TestCase
{
    public function testCartItemsIsConsumed()
    {
        Kafka::fake();
        Kafka::shouldReceiveMessages([
            new ConsumedMessage(
                topicName: 'cart_items',
                partition: 0,
                headers: [],
                body: [1,2,3],
                key: null,
                offset: 0,
                timestamp: 0
            ),
        ]);
        $consumer = Kafka::createConsumer(['cart_items'])
            ->withHandler(function (KafkaConsumerMessage $message) use (&$carts) {
                $cart = Cart::find($message->getBody()[0]);
        
                $cart?->update(['updated_at' => now()->format("Y-m-d H:i:s")]);
        
                return 0;

            })->build();
            
        $consumer->consume();

        // Now, you can test if the post published_at field is not empty, or anything else you want to test:
        
        $this->assertNotNull(Cart::find(1)?->updated_at);
    }

}
