<?php
use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;
use App\Kafka\KafkaProducer;

include __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

$http = new Server("0.0.0.0", getenv('PORT_SWOOLE'));
$kafkaProducer = new KafkaProducer(getenv('PORT_KAFKA'), getenv('TOPIC_KAFKA'));

$http->on("start", function () {
	echo "Servidor Swoole iniciado na porta " . getenv('PORT_SWOOLE') . PHP_EOL;
});

$http->on("request", function (Request $request, Response $response) use ($kafkaProducer) {
	$path = $request->server['request_uri'];

	if ($path === '/produce') {
		$kafkaProducer->produceMessages();
	}
});

$http->start();
