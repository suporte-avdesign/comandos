## Packeges no laravel 5.8
*******
 1. [Gerar o arquivo composer.json](#install)
*******
<div id='install'/>

## Gerar o arquivo composer.json
````
$ composer init

````
* Retorno no terminal
````
Nome do pacote (<vendor> / <name>) [avdesign/press]
Descrição []: pacote laravel 5.8
Autor [Aanselmo Velame <design@anselmovelame.com.br>, n para pular]:
Estabilidade Mínima []:
Tipo de pacote (por exemplo, biblioteca, projeto, meta-pacote, plugin-compositor) []:
Licença []: MIT

Defina suas dependências.

Você gostaria de definir suas dependências (requerer) interativamente [sim]? N
Você gostaria de definir suas dependências dev (require-dev) interativamente [sim]? N

{
     "name": "avdesign/press",
     "description": "Package laravel 5.8",
     "licença": "MIT",
     "autores": [
         {
             "nome": "Aanselmo Velame",
             "email": "design@anselmovelame.com.br"
         }
     ]
     "exigir": {}
}

Você confirma geração [sim]? y

````
* Instatal testbench
````
$ composer require --dev orchestra/testbench
```` 
* Verificar a instalação
````
$ git status
````
* Criar um arquivo .gitignore
````
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
.env
.phpunit.result.cache
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
````
* Criar diretorios
````
src
tests ->
    Feature
    Unit
````
* Editar arquivo composer.json
````
 - - - - - - - - - - - - - - - - - - - --
"autoload": {
        "psr-4": {
            "avdesign\\Press\\*": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "avdesign\\Press\\Tests\\*": "tests/"
        }
    },

````
* Instalar PHPUnit
````
$ wget -O phpunit https://phar.phpunit.de/phpunit-7.phar
$ chmod +x phpunit
$ ./phpunit --version

````
* Criar o arquivo phpunit.xml
````
<?xml version="1.0" encoding="UTF-8"?>
<phpunit backupGlobals="false"
         backupStaticAttributes="false"
         bootstrap="vendor/autoload.php"
         colors="true"
         convertErrorsToExceptions="true"
         convertNoticesToExceptions="true"
         convertWarningsToExceptions="true"
         processIsolation="false"
         stopOnFailure="false">
    <testsuites>
        <testsuite name="Unit">
            <directory suffix="Test.php">./tests/Unit</directory>
        </testsuite>

        <testsuite name="Feature">
            <directory suffix="Test.php">./tests/Feature</directory>
        </testsuite>
    </testsuites>
    <filter>
        <whitelist processUncoveredFilesFromWhitelist="true">
            <directory suffix=".php">./src</directory>
        </whitelist>
    </filter>    
</phpunit>
````
* tests/Feature criar uma Class InitialTest com namespace avdesignPressTests
````
<?php

namespace avdesignPressTests;


use Orchestra\Testbench\TestCase;

class InitialTest extends TestCase
{
    /** @test */
    public function my_first_test()
    {
        $this->assertTrue(true);
    }
}
````
* No terminal digite o comando:
````
$ phpunit
````

[Proximo](https://github.com/suporte-avdesign/comands/tree/master/Laravel/packeges/2-markdown-review.md) . Seria necessário muito esforço para descrever a sintaxe no texto (eles serão formatados), então, considere esta tabela abaixo para toda a sintaxe básica.  
