PHP 8.2 + Swoole + Kafka.

Para rodar o projeto com docker:

```
docker-compose up -d
```

```
php server.php executar o servidor Swoole responsável por ficar escutando as mensagens real time e enviar para fila
```
```
php consumer.php responsável por mostrar as mensagens que estão na fila
```

Para enviar as mensagens para fila é so fazer um request:
```
curl localhost:8080/produce
```
