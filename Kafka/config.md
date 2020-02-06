## Configuração do Kafka
*******
 1. [Configuração](#config)
 

*******
<div id='config'/>

## Configuração<br>

* Isntalar Kafta no Dockerfile
* Incluir no Dockerfile do Modulo
````
RUN apk add alpine-sdk autoconf librdkafka-dev nano vim

RUN pecl install rdkafka

RUN ln -s /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
    echo "extension=rdkafka.so" >> /usr/local/etc/php/php.ini
    
docker-compose up -d --build
 
docker-compose exec name_module bash
````

* Adicionar no docker-compose.yaml do Module o networks
````
networks:
  default:
    external:
      name: name-network
````
* Fazer o build da nova instalação
````
docker-compose up -d --build

docker-compose exec name_container bash
````

* Instalar no Module Biblioteca Easykafka
````
composer require wesleywillians/phpeasykafka
````

* Fazer as configurações que vamos utilizar no Kafka name_module/app/Providers/AppServiceProvider -> register()
````
use PHPEasykafka\Broker;
use PHPEasykafka\BrokerCollection;

$this->app->bind("kafkaBrokerCollection", function() {
    $broker = new Broker("kafka", "9092");
    $kafkaBrokerCollection = new BrokerCollection();
    $kafkaBrokerCollection->addBroker($broker);
    return $kafkaBrokerCollection;
});

$this->app->bind("kafkaTopicConfig", function() {
    return [
        'topic' => [
            'auto.offset.reset' => 'largest', #Começar a ler do final
        ],
        'consumer' => [
            'enable.auto.commit' => "true", #Se o consumer leu, já dá um commit no offset
            'auto.commit.interval.ms' => "100", #Interval do commit
            'offset.store.method' => 'broker' #Onde vai guardar
        ]
    ];
});

````
* Verificar se as extensão foi instalada "rdkafka"
````
php -m
````
* Criar o commands KafkaProducerSeeder
````
# php artisan make:command KafkaProducerSeeder

# chmod 777 app/Console/Commands/ -R
````
* Fazer as configurações nescessárias no KafkaProducerSeeder
````
protected $signature = 'kafka:produce-name';

public function handle(ContainerInterface $container)

````

* Criar diretório e arquivo kafka/docker-compose.yaml
````
version: '3'
services:
  zookeeper:
    image: confluentinc/cp-zookeeper:latest
    environment:
      ZOOKEEPER_CLIENT_PORT: 2181
      ZOOKEEPER_TICK_TIME: 2000

  kafka:
    image: confluentinc/cp-kafka:latest
    depends_on:
      - zookeeper
    environment:
      KAFKA_BROKER_ID: 1
      KAFKA_ZOOKEEPER_CONNECT: zookeeper:2181
      KAFKA_ADVERTISED_LISTENERS: PLAINTEXT://kafka:9092
      KAFKA_OFFSETS_TOPIC_REPLICATION_FACTOR: 1

networks:
  default:
    external:
      name: name-network
````

* Help networks
````
docker network
docker network --help
docker network create --help
````

* Create networks
````
docker network create name_network
docker network ls
````
* Create/dir/ 
````
docker-compose up -d
````
* Teste com ping no modulo que foi adicionado o network
````
ping kafka
````
* Entrar no bash do /kafka
````
docker-compose exec kafka bash
````
* Criar Topicos dos Modulos(customers/orders/products)
````
kafka-topics --create --bootstrap-server localhost:9092 --replication-factor 1 --partitions 3 --topic  name_topic
kafka-topics --create --bootstrap-server localhost:9092 --replication-factor 1 --partitions 3 --topic  name_topic
kafka-topics --create --bootstrap-server localhost:9092 --replication-factor 1 --partitions 3 --topic  name_topic

````
* Listar Topicos
````
kafka-topics --list --bootstrap-server localhost:9092
````
* Excluir Topico
````
kafka-topics --list --bootstrap-server localhost:9092 --delete --topic name_topic
````
* Criar command KafkaConsumer dentro micro-servico
````
$ docker-compose exec name bash

# php artisan make:command KafkaProduce

# php artisan kafka:consume orders orders-group
````

* Testar consumo dentro do kafka
````
# kafka-console-consumer --bootstrap-server localhost:9092 --topic name_topic --from-beginning
````
* Testar no console do module a signature:
````
# php artisan php artisan kafka:produce-name
````
* Se tudo deu certo o kafka vai imprimir os dados da seeder
````
{"id":"5cf02212-8756-46d6-ba77-3ac8f025b84d","name":"Produto - ee06cc11-f50b-47d4-b339-71b8a8aab56d","description":"Descri\u00e7\u00e3o do produto ee06cc11-f50b-47d4-b339-71b8a8aab56d","price":12.5,"qty_available":5,"qty_total":15,"updated_at":"2019-11-07 06:47:55","created_at":"2019-11-07 06:47:55"}

````

* Criar e configurar os Observers nos micro-servives
````
bash-4.4# php artisan make:observer KafkaProductObserver --model=Product

````
* Registrar os Observers no boot do app/Providers/AppServiceProvider
````

````

* Criar uma pasta no micro-service/KafkaHandlers 
* Criar uma class OrderHandler, (__invoke) é obrigatório
 
 
* Testar mensagem /kafka 
````
root@82291af9d6e0:/# kafka-console-producer --broker-list localhost:9092 --topic orders
````

* Criar uma pasta dos Services
````
````



