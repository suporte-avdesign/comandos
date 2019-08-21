# Configuração do Laravel 
*******
 1. [Instalação](#install)

*******
<div id='install'/>

## Instalação<br>
>*# composer update*
* Criar arquivo .env
>*# touch .env*
* Gerar Chaves
```
php artisan key:generate
php artisan jwt:secret
php artisan storage:link
php artisan cache:clear

chmod -R 755 bootstrap/cache
chmod -R 755 storage

```
* Alterar url Http/Middleware/CorsMiddleware.php (caso o angular esteja em outro host)
````
private $origins = [
    'https://url-da-aplicacao.com',
];
````    

* Firebase em Configurações -> Contas e Serviços (para se comunicar com o php).
  
      - SDK Admin do Firebase
      - Gerar chave privada 
      - Criar 2 arquivos (dev,prod.json) e colocar na raiz do projeto php
      - Obs: se perder gerar uma nova chave
````
{
"type": "------------",
"project_id": "------------",
"private_key_id": "------------",
"private_key": "------------",
"client_email": "------------",
"client_id": "------------",
"auth_uri": "------------",
"token_uri": "------------",
"auth_provider_x509_cert_url": "------------",
"client_x509_cert_url": "------------",
}
  
````

* Alterar para prod.json:  Providers -> AppServiceProvider
````
public function register()
{
    $this->app->bind(Firebase::class, function(){
       $serviceAccount = Firebase\ServiceAccount::fromJsonFile(base_path('prod.json'));
       return (new Factory())->withServiceAccount($serviceAccount)->create();
    });
}
````


