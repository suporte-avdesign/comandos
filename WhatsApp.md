# Tutorial dos Sistemas

*******
Instalação dos Ambientes:

 1. [WhatsApp Laravel Api](#whatsapp-laravel)
 2. [WhatsApp Angular (admin)](#whatsapp-angular)
 3. [WhatsApp Ionic](#whatsapp-ionic)
 4. [Cordova](#cordova)
 5. [Photo Viewer](#photo-viewer)
 6. [Firebase Messaging](#firebase-messaging)
 7. [Firebase Dynamic Links](#firebase-dynamic-links)
 

*******

<div id='whatsapp-laravel'/>

## Instalação do Laravel <br>
Digite os seguintes comandos:

>*composer update<br>
php artisan key:generate<br>
php artisan jwt:secret*

## Permissões <br>
Digite os seguintes comandos:

>*sudo chmod -R 777 storage/api/public/chat_groups <br>
sudo chmod -R 777 storage/api/public/products <br>
sudo chmod -R 777 storage/api/public/users<br>
php artisan storage:link*

* **[*Observação*](#)** : Remover o .gitignore da pasta storage/app para carregar as imagens faker


## Conexão com Firebase <br>
Criar um arquivo para conexão com o firebase  na raiz nome-do-arquivo.json
>*{<br>
    "type": "service_account",<br>
    "project_id": "-------------------",<br>
    "private_key_id": "--------------",<br>
    "private_key": "--------------",<br>
    "client_email": "------------------",<br>
    "client_id": "-----------------",<br>
    "auth_uri": "---------------------",<br>
    "token_uri": "------------------------",<br>
    "auth_provider_x509_cert_url": "---------------------------------",<br>
    "client_x509_cert_url": "----------------------------"<br>
  }*
  
 
## Alterar urls para cnexão com o app <br> 
app/Http/Middleware/CorsMiddleware.php

>*private $origins = [<br>
&nbsp;&nbsp; 'http://localhost:4200',<br>
&nbsp;&nbsp; 'http://localhost:8100',<br>
&nbsp;&nbsp; 'http://192.168.0.XXX:8100',<br>
&nbsp;&nbsp; 'http://192.168.0.XXX:8101'<br>
];*
  

<div id='whatsapp-angular'/>

## Instalação do Angular<br>
Digite os seguintes comandos:

>*npm install*

<div id='whatsapp-ionic'/>


## Instalação do Ionic

>*npm install*

Criar arquivo export default na raiz com as credencias do firebase nome-do-arquivo.js

>*export default {<br>
&nbsp;&nbsp; apiKey: "---",<br>
&nbsp;&nbsp; authDomain: "---",<br>
&nbsp;&nbsp; databaseURL: "---,<br>
&nbsp;&nbsp; projectId: "---",<br>
&nbsp;&nbsp; storageBucket: "---",<br>
&nbsp;&nbsp; messagingSenderId: "---"<br>
}*

Alterar urls app.modules.ts

>*function jwtFactory(authService: AuthProvider) {<br>
&nbsp;&nbsp; return {<br>
&nbsp;&nbsp;&nbsp;&nbsp; whitelistedDomains: [ <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; new RegExp('whatsapp-laravel.test/*
>'),<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; new RegExp('192.168.0.106:8000/*')<br>
&nbsp;&nbsp;&nbsp;&nbsp; ],<br>
&nbsp;&nbsp;&nbsp;  tokenGetter: () => {<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  return authService.getToken();<br>
&nbsp;&nbsp;&nbsp; }<br>
&nbsp;&nbsp; }<br>
}*

Comandos Principais
>*ionic g provider nome_do_provider*

<div id='cordova'/>

## Instalando Cordova<br>
>*sudo npm install -g cordova*

Instalando Plataformas

>*ionic cordova platform add android --save<br>
ionic cordova platform add ios --save<br>
ionic cordova platform add windows --save*

Removendo Plataformas (remove ou rm)

>*ionic cordova platform remove android<br> 
ionic cordova platform rm android*

Gerando Builds

>*ionic cordova build android<br>
ionic cordova build ios<br>
ionic cordova build windows*

Simular aplicação no emulador

* **[*Obs*](#)** : Alterar dados no config.xml

>*ionic cordova emulate android<br>
ionic cordova emulate ios<br>
ionic cordova emulate windows*

* **[*Error*](#)** : Failed to execute shell command "getprop,dev.bootcomplete"" on device: Error: adb: Command failed with exit code 1 Error output:

Simular na rede WiFi 
acrescentar --livereload no final para atualizar em tempo real
>*ionic cordova emulate android --livereload<br>
ionic cordova emulate ios <br>
ionic cordova emulate windows*

Endereço do ip do WiFi linux: ifconfig
php artisan serve --host=192.168.0.104

Simular no Dispositivo (Celular) 
Acrescentar --livereload no final para atualizar em tempo real
>*ionic cordova run android --device --livereload<br>
ionic cordova ru ios --device<br>
ionic cordova run windows --device*

<div id='photo-viewer' />

## Instalação Photo Viewer<br>
>*ionic cordova plugin add com-sarriaroman-photoviewer@1.1.18*<br>
>*npm install @ionic-native/photo-viewer@4.12.2 --save*


<div id='firebase-messaging' />

## Instalação Firebase Messaging<br>
Digite os seguintes comandos no terminal:

>*ionic cordova plugin add cordova-plugin-firebase-messaging*<br>
>*npm install @ionic-native/firebase-messaging@4.13.0*<br><br>
>*Em app.components.ts no método initializeApp()*<br><br>



Configuração no Firebase Cloud Messaging


 * **TESTE EM 2 EMULADORES** <br>
 >*adb devices*<br>
 >*ionic cordova run android --target=xpto*
 




<div id='firebase-dynamic-links' />

## Instalação Firebase Dynamic Links<br>
Digite os seguintes comandos no terminal:

>*ionic cordova plugin add cordova-plugin-firebase-dynamiclinks --save --variable APP_DOMAIN="code.education" --variable APP_PATH="/" --variable PAGE_LINK_DOMAIN="https://lavdesign.page.link"*<br><br>
>*npm install @ionic-native/firebase-dynamic-links@4.14.0 --save*

Configuração no Laravel .env
>*MOBILE_URL=https://site.com/projeto* 
>*MOBILE_PAGE_LINK=https://page.link*
>*MOBILE_ID=br.com.site.projeto*

Configuração no Firebase:<br>
Colocar padrão de URL na lista de permissões<br>
627&conteudo=5445
>*^https://www\.avdesign\.com\.br.*\*$





Debugando no Chrome digite: 
>*chrome://inspect*

Firebase - Chave Cloud Messaging <br>
Project Configurações/Cloud Messaging <br>
Chave do servidor: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx<br>

Laravel .env<br>
FB_SERVER_KEY= Chave do servidor


