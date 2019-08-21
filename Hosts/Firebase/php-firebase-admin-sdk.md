# Firebase Admin SDK
*******
 1. [Instalação](#install)

*******
<div id='install'/>

## Instalação<br>
>*$ composer require kreait/firebase-php:4.0*

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


**[*Fontes*](#)**

* Github

  https://github.com/kreait/firebase-php

* Documentação

  https://firebase-php.readthedocs.io
  
**[*Videos*](#)** 

* AUTENTICAÇÃO NA API COM FIREBASE
    
      https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=620&conteudo=5322  

    * Integrando Firebase no backend
    * Pegando usuário Firebase no backend   

