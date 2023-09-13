<?php

namespace App\Kafka\Consumers;

use Junges\Kafka\Consumers\Consumer;
use Junges\Kafka\Contracts\Consumer as ContractsConsumer;

class Consumers
{
    protected function gracefulShutdown(\Junges\Kafka\Facades\Kafka $consumer) {
        $consumer->stopConsume(function() {
            echo 'Stopped consuming';
            exit(0);
        });
    }
}