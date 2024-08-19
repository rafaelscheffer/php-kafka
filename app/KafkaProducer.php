<?php
namespace App\Kafka;

use longlang\phpkafka\Producer\Producer;
use longlang\phpkafka\Producer\ProducerConfig;

include __DIR__ . '/../vendor/autoload.php';

class KafkaProducer {
	private $producer;

	public function __construct($port) {
		echo "Inicia conexão Producer\n";
		$config = new ProducerConfig();
		$config->setBootstrapServer($port);
		$config->setUpdateBrokers(true);
		$config->setAcks(-1);

		$this->producer = new Producer($config);
	}

	public function produceMessages() {
		for ($i = 1; $i <= 10; $i++) {
			$value = "Value " . $i;
			$key = "Key" . $i;
			$this->producer->send('poc-swoole', $value, $key);
			echo "Mensagem $value publicada \n";
		}
	}
}
