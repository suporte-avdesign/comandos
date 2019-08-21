# Firebase Push Notifications 
*******
 1. [Instalação](#install)

*******
<div id='install'/>

## Instalação<br>

* Digite o camando com a opção da versão
```
$ ionic cordova plugin add cordova-plugin-firebase-messaging
$ npm install @ionic-native/firebase-messaging@4.13.0
```

* Registrar os serviços em app.module.ts
```
import { FirebaseMessaging } from '@ionic-native/firebase-messaging';

providers: [
    ----
    FirebaseMessaging    
]
```

* Laravel: Guardar o token no nanco de dados:
```
Tabela: user_profile
Campo:  device_token

```
* Instalar versão apropriada da Biblioteca para Firebase Cloud Messaging
```
composer require redjanym/php-firebase-cloud-messaging:1.1.4
```
* Copia a chave do servidor do Firebase para o Laravel .env
    
    `Configuração do projeto->Cloud Messaging->Chave do Servidor`
```
FB_SERVER_KEY="xxxxxxxx-xxxxx-xxxx"
```    

* Ionic: serviços responsaveis pelo envio e add no device_token
```
UserProfileHttp
interface Profile {
    ----------
  device_token?: string;
}

PushNotificationProvider
```



* Configuração do Firebase Dynamic Links
    * https://github.com/suporte-avdesign/comandos/blob/master/Hosts/Firebase/DynamicLinks.md

**[*Fontes*](#)**

* https://ionicframework.com/docs/native/firebase-messaging

* PHP API Biblioteca para Firebase Cloud Messaging do Google.
    * https://github.com/redjanym/php-firebase-cloud-messaging

* Criar solicitações de envio do servidor de apps
    * https://firebase.google.com/docs/cloud-messaging/send-message

**[*Videos*](#)**

 `PUSH NOTIFICATIONS`

* https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=630&conteudo=5485