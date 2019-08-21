# Deploy da aplicação ionic 
*******
 1. [Gerando ícone e splash personalizados para o app](#ícone-splash)
 1. [Integração do Angular com Laravel](#laravel)

*******
<div id='ícone-splash'/>

## Gerando ícone e splash personalizados para o app

* Alterar o local do arquivo environment-prod
```
host: dominio
baseFilesUrl: dominio/storage
```
 
* Digite na pasta do projeto o seguinte comando:
```
$ ionic cordova resources
```
* Se parar e levar muito tempo nestas linhas feche  o terminal e instale:
  * Se existir @ no pacote colocar "" por causa da versão
```
$ npm install "@angular-devkit/build-optimizer"@0.8.3 --save-dev
```
* Fazer o build para produção(web) gera os arquivos na pasta www
```
$ ionic build --prod      
```
* Fazer o build do android para o dispositivo(celular) gerar o arquivo na pasta:
    *platforms/android/app/build/outputs/apk/debug/app-debug.apk
```
$ ionic cordova build android --prod      
```
* Rodando aplicação no simulador e no celular o app-debug.apk
```
$ ionic cordova run android --prod
$ ionic cordova emulate android --prod      
      
```
* Enviando apk para Google Play Store




* Resolver  Clipboard