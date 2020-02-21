##Veja a documentação:

* https://laravel.com/docs/5.8/filesystem
* https://laravel-docs-pt-br.readthedocs.io/en/latest/filesystem/


* Abaixo  um exemplo na camada view com blade:
````
@php
  $exists = \Storage::disk('local')->exists('test.txt');
  if($exists){
    echo "tem";
    $contents = \Storage::disk('local')->get('test.txt');
    var_dump($contents);
  }
@endphp
````
* Lembrando que você deve sempre rodar o comando abaixo:

```
php artisan storage:link
````
* Desta forma você cria um link simbólico e deve colocar o arquivo a ser lido no seguinte diretório:
````
storage/app
````

* Caso queira alterar este diretório deve alterar o arquivo abaixo:
````
config/filesystems.php
````

* A constante abaixo:
````
'local' => [
  'driver' => 'local',
  'root' => storage_path('app'),
````

* Video Manipulação 

* https://www.youtube.com/watch?v=VVn56JlX2-s
