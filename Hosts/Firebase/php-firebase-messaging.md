# Php Cloud Messaging
*******
 1. [Instalação](#install)

*******
<div id='install'/>

## Instalação<br>

* Pegar chave(token) no Firebase Cloud Messaging/ [clique aqui](https://github.com/suporte-avdesign/comandos/blob/master/Hosts/Firebase/firebaseMessaging.md).*
```
 Acrescente .env
  
 FB_SERVER_KEY= token
```
* Baixe a biblioteca com a opção da versão dietorio-laravel
>*$ composer require sngrl/php-firebase-cloud-messaging:1.1.4*

* Criar um arquivo na pasta Firebase/CloudMessagingFb.php
```
<?php
namespace NameSpace\Firebase;


use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;


class CloudMessagingFb
{
    private $title = '';
    private $body = '';
    private $tokens = [];
    private $data = [];


    public function send()
    {
        $client = new Client();
        $client->setApiKey(env('FB_SERVER_KEY'));

        $message = new Message();
        foreach ($this->tokens as $token) {
            $message->addRecipient(new Device($token));
        }

        $message
            ->setNotification(new Notification($this->title, $this->body))
            ->setData($this->data);

        return $client->send($message);

    }

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param array $tokens
     * @return $this
     */
    public function setTokens(array $tokens)
    {
        $this->tokens = $tokens;
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

}
```
* Criar um arquivo na pasta Firebase/ChatMessageFb.php
```
<?php

namespace CodeShopping\Firebase;

use CodeShopping\Events\ChatMessageSent;
use CodeShopping\Models\ChatGroup;
use Illuminate\Http\UploadedFile;


class ChatMessageFb
{
    use FirebaseSync;

    private $chatGroup;

    public function create(array $data){

        $this->chatGroup = $data['chat_group'];
        $type = $data['type'];

        switch ($type) {
            case 'audio':
            case 'image':
                $this->upload($data['content']);
                /** @var UploadedFile $uploadedFile */
                $uploadedFile = $data['content'];
                $fileUrl = $this->groupFilesDir() . '/' . $this->buildFileName($uploadedFile);
                $data['content'] = $fileUrl;
        }
        $reference = $this->getMessagesReference();
        $newReference = $reference->push([
            'type' => $data['type'],
            'content' => $data['content'],
            'created_at' => ['.sv' => 'timestamp'], // firebase gera timestamp
            'user_id' => $data['user']->profile->firebase_uid
        ]);



        $this->setLastMessage($newReference->getKey());

        // Atualiza o grupo que foi enviado a mensagem
        $this->chatGroup->updateInFb();

        //Não enviar as msgs no console e no teste unitário
        if (!app()->runningInConsole() && !app()->runningUnitTests()) {
            event( new ChatMessageSent($this->chatGroup,$data['type'],$data['content'],$data['user']));
        }


    }

    /**
     * @param UploadedFile $file
     */
    private function upload(UploadedFile $file)
    {
        $file->storeAs($this->groupFilesDir(), $this->buildFileName($file), ['disk' => 'public']);
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    private function buildFileName(UploadedFile $file)
    {
        switch ($file->getMimeType()){
            case 'audio/x-hx-aac-adts':
                return "{$file->hashName()}aac";
            default:
                return $file->hashName();
        }
    }


    /**
     * Pasta onde salvar os files
     * @return string
     */
    private function groupFilesDir()
    {
        return ChatGroup::DIR_CHAT_GROUPS . '/' . $this->chatGroup->id . '/messages_files';
    }


    public function deleteMessages(ChatGroup $chatGroup)
    {
        $this->chatGroup = $chatGroup;
        $this->getMessagesReference()->remove();
    }


    private function setLastMessage($messageUid)
    {
        $path = "{$this->getChatGroupsMessageReference()}/last_message_id";
        $reference = $this->getFirebaseDatabase()->getReference($path);
        $reference->set($messageUid);

    }


    private function getMessagesReference()
    {
        $path = "{$this->getChatGroupsMessageReference()}/messages";
        return $this->getFirebaseDatabase()->getReference($path);
    }


    private function getChatGroupsMessageReference()
    {
        return "/chat_groups_messages/{$this->chatGroup->id}";
    }


}
```
**[*Github*](#)**

  https://github.com/sngrl/php-firebase-cloud-messaging

**[*Videos*](#)**
    
`PUSH NOTIFICATIONS`

* Instalando biblioteca para enviar push notifications.
  * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=630&conteudo=5488

* Criando evento e listener para enviar push notifications
  * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=630&conteudo=5489
  
* Criando método para pegar tokens dos clientes
  * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=630&conteudo=5490
  
* Criando método para pegar tokens dos vendedores
  * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=630&conteudo=5491

