<?php

namespace App\Kafka\Producers;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class KafkaProducer
{

    public function __construct(string $topic, array $data, int $user_id)
    {
        $message = new Message(
            body: ['data' => $data],
            key: (string)$user_id
        );
        Kafka::publishOn($topic)->withMessage($message)->send();
    }
}