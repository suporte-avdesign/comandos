## Google Storage
*******
 1. [Install](#install)
*******
<div id='install'/>

## Install
* Menu -> Storage -> Selecionar Instância

## Biblioteca Superbalist
* https://github.com/Superbalist/laravel-google-cloud-storage
>*composer require superbalist/laravel-google-cloud-storage*
* Registre o provedor de serviços em config/app.php
```
'providers' => [
    // ...
    Superbalist\LaravelGoogleCloudStorage\GoogleCloudStorageServiceProvider::class,
]
```
* Adicione o novo disco em config/filesystems.php
```
 // Importante: adicionar base_path(key_file) 
'gcs' => [
    'driver' => 'gcs',
    'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'codigo-do-projeto'),
    'key_file' => base_path(env('GOOGLE_CLOUD_KEY_FILE', null)), // optional: /path/to/service-account.json
    'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'your-bucket'),
    'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', null), // optional: /default/path/to/apply/in/bucket
    'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', null), // see: Public URLs below
    'visibility' => 'public', // optional: public|private
],
```
* Adicione no .env para testar local
```
GOOGLE_CLOUD_PROJECT_ID=codigo-do-projeto
GOOGLE_CLOUD_KEY_FILE=./service-account.json
GOOGLE_CLOUD_STORAGE_BUCKET=nome-storage-intervalo.com
GOOGLE_CLOUD_STORAGE_PATH_PREFIX=opcional-local-arquivos
GOOGLE_CLOUD_STORAGE_API_URI=fazer-upload-teste-copiar-endereco

FILESYSTEM_DRIVER=gcs

```
* Alterar driver métodos (upload,delete) de upload de files

  * ChatGroup,Product,User etc..
  ```
  private static function uploadPhoto(UploadedFile $photo)
  {
      $dir = self::photoDir();
      //$photo->store($dir, ['disk' => 'public']);
      $photo->store($dir, ['disk' => env('FILESYSTEM_DRIVER')]);
  }
  
  private function deletePhoto(){
      $dir = self::photoDir();
      //\Storage::disk('public')->delete("{$dir}/{$this->photo}");
      \Storage::disk(env('FILESYSTEM_DRIVER'))->delete("{$dir}/{$this->photo}");
  }
  
  ```
            
        

