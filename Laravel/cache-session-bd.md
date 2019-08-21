## Armazenar Cache e Session no bd
*******
 1. [Cache](#cache)
 2. [Session](#session)
*******
<div id='cache'/>

## Cache
* Gerar migração
>*php artisan cache:table*
* Mudar o driver .env
```
CACHE_DRIVER=databese
```
* Execultar 
>*php artisan migrate*

<div id='session'/>

## Session
* Gerar migração
>*$ php artisan session:table*
* Mudar o driver .env
```
SESSION_DRIVER=databese
```
* Execultar 
>*php artisan migrate*

**[*Observação:*](#)**

   * Da  permissão nas pastas depóis do deploy
        * composer.json
     
```
"scripts": {
    --------------final----------------
    "post-deploy-cmd":[
        "chmod -R 755 bootstrap\/cache",
        "chmod -R 755 storage",
        "php artisan cache:clear"
    ]
},
 
   
```
    
