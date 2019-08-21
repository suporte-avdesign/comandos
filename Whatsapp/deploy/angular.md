# Deploy da aplicação angular 
*******
 1. [Gerando software de produção](#producao)
 1. [Integração do Angular com Laravel](#laravel)

*******
<div id='producao'/>

## Gerando software de produção<br>

* Fazer as configurrações necessárias no arquivo angular.json
```
"architect": {
        "build": {
          "builder": "@angular-devkit/build-angular:browser",
          "options": {
            "outputPath": "../project-laravel/public/js",
            ---------
```
* Deixar (title, base, favicon) padrão no index.html
```
  <!doctype html>
  <html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>Nome do Projeto</title>
    <base href="/app">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/js/favicon.ico">
  </head> 
  ----------         
            
```
* Gerar os arquivos copilados no caminho "outputPath"
>*ng build*

<div id='laravel'/>

## Integração do Angular com Laravel

* Criar um arquivo resources/views/angular.blade.php

* Copiar o arquivo index.html gerado pelo build para angular.blade.php
```
<!doctype html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>Nome Projeto</title>
    <base href="/app">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/js/favicon.ico">
  </head>
  <body>
    <app-root></app-root>
    <script type="text/javascript" src="/js/runtime.js"></script>
    <script type="text/javascript" src="/js/polyfills.js"></script>
    <script type="text/javascript" src="/js/styles.js"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
    <script type="text/javascript" src="/js/vendor.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
  </body>
</html>

```
* Remover o welcome 
* Criar Route(web) de acesso da aplicação angular no laravel
```
Route::get('/app', function () {
    return view('angular');
});
```
* Route do Single Page Application
```
Route::get('/app/{angular}', function ($angular) {
    return view('angular');
})->where('angular', '.*');
```
* Testar aplicação ifconfig local
```
$ php artisan serve --host=192.168.0.102
$ 192.168.0.102:8000/api
```
* Alterar endereço remoto em environment.prod.ts
```
import { environment } from '../environments/environment';

export function jwtFactory(authService: AuthService) {
  return {
      whitelistedDomains: [
        //new RegExp('192.168.0.102:8000/*'),
        new RegExp(`${environment.api.host}/*`)
      ],
      tokenGetter: () => {
        return authService.getToken();
      }
  }
}
```
*Em:* `services/auth/firebase-auth-service.ts`
````
    import firebaseConfig from './firebase-config';
ALTERAR PARA: 
    import firebaseConfig from './firebase-config-prod';
````

* Gerando aplicação Angular de forma otimizada (Produção)
>*ng build --prod*
```
"configurations": {
    "production": {
      "fileReplacements": [
        {
          "replace": "src/environments/environment.ts",
          "with": "src/environments/environment.prod.ts"
        }
      ],
      "optimization": true,
      "outputHashing": "all",
      "sourceMap": false,
      "extractCss": true,
      "namedChunks": false,
      "aot": true,
      "extractLicenses": true,
      "vendorChunk": false,
      "buildOptimizer": true
    }
  }
```
* Verificar e corrigir onde existir erros
* Copiar html gerado para angular.blade.php 
```
<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Nome Projeto</title>
    <base href="/app">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/js/favicon.ico">
    <link rel="stylesheet" href="/js/styles.ae7da0598d2f599ea38b.css"></head>
<body>
    <app-root></app-root>
    <script type="text/javascript" src="/js/runtime.a66f828dca56eeb90e02.js"></script>
    <script type="text/javascript" src="/js/polyfills.7fb637d055581aa28d51.js"></script>
    <script type="text/javascript" src="/js/scripts.3d71feb04f7ed144b0f0.js"></script>
    <script type="text/javascript" src="/js/main.02df0397712b491b3912.js"></script>
</body>
</html>
```

