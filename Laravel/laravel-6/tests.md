# Instalação 
*******
 1. [Instalação](#install)
 2. [Pacotes](#packeges)

*******
<div id='install'/>

## Instalação

>*laravel new name_project*


>*php artisan key:generate*



<div id='packeges'/>

## Pacotes

Ativa o tinker em uma página web
````
composer require spatie/laravel-web-tinker --dev
php artisan web-tinker:install


````

Um editor de código para o Ignition
````
composer require facade/ignition-code-editor --dev
composer require facade/ignition-tinker-tab --dev
````

Instalação da scaffolding Auth
````
composer require laravel/ui --dev

// Generate basic scaffolding...
php artisan ui vue
php artisan ui react

// Generate login / registration scaffolding...
php artisan ui vue --auth
php artisan ui react --auth

npm i
npm rum dev
````

Todos str_e os array_auxiliares foram movidos para o novo pacote Composer
````
composer require laravel/helpers
````
