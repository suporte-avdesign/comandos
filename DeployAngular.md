# Deploy Angular
*******
 1. [Build - Gerando software de produção](#build)
 2. [Integração do Angular com Laravel](#integracao) 
 3. [Rota Single Page Application](#single-page-application) 
 4. [Gerando aplicação Angular de forma otimizada](#angular-forma-otimizada) 

*******
<div id='build'/>

## Build - Gerando software de produção<br>
Caminho da pasta:<br>
angular.json build->options->outputPath
>*ng build*

<div id='integracao'/>

## Integração do Angular com Laravel<br>
* Criar arquivo:

>*resources/views/angular.blade.php* <br>

* copiar o index.html gerado pelo build:
```
<!doctype html>
  <html lang="pt">
  <head>
      <meta charset="utf-8">
      <title>Avd Whatsapp</title>
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

* Criar Rota web: <br>
```
Route::get('/app', function () {
    return view('angular');
});
```
<div id='single-page-application'/>

## Rota Single Page Application <br>

* Criar Rota web: <br>
```
Route::get('/app/{angular}', function ($angular) {
    return view('angular');
})->where('angular', '.*');
```

<div id='angular-forma-otimizada'/>

## Gerando aplicação Angular de forma otimizada <br>

* Em  app.module.ts acrescentar (export) function jwtFactory(authService: AuthService) <br> 
>*ng build --prod*
 