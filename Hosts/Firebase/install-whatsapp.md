# Firebase
*******
 1. [Instalação](#install)

*******
<div id='install'/>

## Instalação

*1* - Clique em Adicionar Projeto
````
Nome do projeto: whatsapp-firebase
Código do projeto: whatsapp-firebase-avd
Localização do Analytics: Brasil
Local do Cloud Firestore: us-east1

[x] Usar as configurações padrão
[x] Aceitar os termos

Criar Projeto
````
*2* - Clicar no icone da Web

    - Criar 2 arquivos (dev,prod) de configuração na aplicação nome_arquivo.js
    - Adicionar ao arquivo prod .gitignore
````
  export default{ 
      apiKey: "---------",
      authDomain: "---------",
      databaseURL: "---------",
      projectId: "---------",
      storageBucket: "---------",
      messagingSenderId: "---------"
  }
```` 
*3* - Em Configurações -> Contas e Serviços (para se comunicar com o php).

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
*4* - Chamar o arquivo em:  Providers -> AppServiceProvider
````
public function register()
{
    $this->app->bind(Firebase::class, function(){
       $serviceAccount = Firebase\ServiceAccount::fromJsonFile(base_path('firebase-admin.json'));
       return (new Factory())->withServiceAccount($serviceAccount)->create();
    });
}
````
*5* - Método de autênticação por telefone
```
Desenvolver
    Authentication
        Método de login
            Ativar Smartphone
    
    Números de telefone para testes (opcional)
    +16505551231    123466
```