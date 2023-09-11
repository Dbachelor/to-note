<?php

namespace App\Kafka\Producers;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class KafkaProducer
{

    public function __invoke(string $topic, array $data, int $user_id):void
    {
        $message = new Message(
            headers: ['header-key' => 'header-value'],
            body: ['data' => $data],
            key: $user_id
        );
        Kafka::publishOn($topic)->withMessage($message)->send();
    }
}