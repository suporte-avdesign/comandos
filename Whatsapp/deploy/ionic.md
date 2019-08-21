# Deploy da aplicação ionic 
*******
 1. [Gerando ícone e splash personalizados para o app](#ícone-splash)

*******
<div id='ícone-splash'/>

## Gerando ícone e splash personalizados para o app

* Alterar o local do arquivo environment-prod
```
host: dominio
baseFilesUrl: dominio/storage
```
 
* Para gerar os icones digite do aplicativo:
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
* Fazer o build do android para enviar o apk para Google Play Store :
    *platforms/android/app/build/outputs/apk/release/app-release-unsigned.apk
```
$ ionic cordova build android --prod --release   
```   

* Enviando apk via Android Studio
    * Abrir a pasta platforms/android/
```
Build -> Generate Signed Bundle or APK
(x) APK -> next -> Create New

Key store path : Salvar na raiz do projeto o arquivo certified_nome_projeto.jks
Password: avd_nome_projeto  Confirm avd_nome_projeto

Alias: nome_projeto
Password: avd_nome_projeto  Confirm: avd_nome_projeto

Nome e Sobrenome: Anselmo Velame
Organizational Und: AVDesign
Organizational: AVDesign
City or Locality - Salvador
State Province: Bahia
Country Code: BR

Next

Signature Versions: escolher versão

Finish

```

* Resolver  Clipboard