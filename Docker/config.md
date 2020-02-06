## Configuração do Docker
*******
 1. [Comandos](#comand)
 

*******
<div id='comand'/>

## Comandos<br>
* up -subir o docker-compose
* -d -para rodar o container como um processo, em background
````
$ sudo docker-compose up -d

teste: localhost:8080

$ sudo docker ps

Se alterar --build
````
* Entrar no terminal do docker (exec -it (ser interativo), (nome do container) )
````
$ sudo docker exec -it api-doc88_app-doc88_1 bash

uname -a //Verificar qual linux esta rodando
exit // Sair

$ sudo docker-compose down //Derubar container

Derrubar Todos
$ docker --rmi all 
````
* Criar link simbolico na raiz do laravel
````
$ ln -s public html
````
* Permissões 
````
chown nginx -R /usr/share/nginx/storage
```` 
docker
* Criar Image
````
$ sudo docker build -t avdesign/image-laravel-appDoc88:latest .
````

* Matar os dockers que estão rodando
````
$ sudo docker kill $(docker ps -q)
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
* Teste ping no docker que foi adicionado o network
````
pink kafka
````
* Entrar no bash do /kafka
````
docker-compose exec kafka bash
````
* Criar Topicos
````
kafka-topics --create --bootstrap-server localhost:9092 --replication-factor 1 --partitions 3 --topic  name_topic
````
* Listar Topicos
````
kafka-topics --list --bootstrap-server localhost:9092
````
* Incluir no Dockerfile do Modulo
````
RUN apk add alpine-sdk autoconf librdkafka-dev nano vim

RUN pecl install rdkafka

RUN ln -s /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
    echo "extension=rdkafka.so" >> /usr/local/etc/php/php.ini
    
docker-compose up -d --build
 
docker-compose exec name_module bash
````
* Verificar se o rdkafka
````
php -m

composer require wesleywillians/phpeasykafka
````
* Em name_module/app/Providers/AppServiceProvider -> register()
````
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
* Criar um comando para testar o processo de consumo das mensagens
````
php artisan make:command KafkaConsumer

php artisan kafka:consume orders orders-group


kafka-console-producer --broker-list localhost:9092 --topic orders

````



