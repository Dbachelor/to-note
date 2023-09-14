<?php

namespace App\Kafka\Producers;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class KafkaProducer
{

    public function __invoke(string $topic, mixed $data, int $key)
    {
        $message = new Message(
            headers: [],
            body: ['data' => $data],
            key: $key
        );
        Kafka::publishOn($topic)->withMessage($message)->send();
    }
}