<?php
use longlang\phpkafka\Consumer\ConsumeMessage;
use longlang\phpkafka\Consumer\Consumer;
use longlang\phpkafka\Consumer\ConsumerConfig;
use Swoole\Coroutine;

include __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

function consume(ConsumeMessage $message): void {
	echo $message->getKey() . ":" . $message->getValue() . "\n";
}

Coroutine\run(static function (): void {
	echo "Iniciando configuração...\n";
	$startConfigTime = microtime(true);
	$config = new ConsumerConfig();
	$config->setBroker(getenv('PORT_KAFKA'));
	$config->setTopic(getenv('TOPIC_KAFKA'));
	$config->setGroupId(getenv('GROUP_KAFKA'));
	$config->setClientId(getenv('CLIENT_KAFKA'));
	$config->setGroupInstanceId(getenv('GROUP_INSTACIED_KAFKA'));

	$consumer = new Consumer($config, 'consume');
	$endConfigTime = microtime(true);
	echo "Configuração do Kafka concluída em " . ($endConfigTime - $startConfigTime) . " microssegundos\n";
	$consumer->start();
});