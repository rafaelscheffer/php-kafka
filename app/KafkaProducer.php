<?php
namespace App\Kafka;

use longlang\phpkafka\Producer\Producer;
use longlang\phpkafka\Producer\ProducerConfig;

include __DIR__ . '/../vendor/autoload.php';

class KafkaProducer {
	private $producer;
	private $topic_kafka;

	public function __construct($port, $topic_k) {
		echo "Inicia conexão Producer\n";
		$config = new ProducerConfig();
		$config->setBootstrapServer($port);
		$config->setUpdateBrokers(true);
		$config->setAcks(-1);

		$this->producer = new Producer($config);
		$this->topic_kafka = $topic_k;
	}

	public function produceMessages() {
		for ($i = 1; $i <= 10; $i++) {
			$value = "Value " . $i;
			$key = "Key" . $i;
			$this->producer->send($this->topic_kafka, $value, $key);
			echo "Mensagem $value publicada \n";
		}
	}
}
