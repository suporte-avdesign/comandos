## Eventos e filas
*******
 1. [Events Send Mail](#event-send-mail)
 2. [Exemplos de Eventos MYSQL](#exemples-events-mysql)
 3. [Observers](#observers)
 4. [Events Listener](#events_listener)
 5. [Queues Jobs](#queues_jobs)

*******
<div id='event-send-mail'/>

## Events Send Mail<br>
Criar class mail pasta

>*$ php artisan make:mail UserRegistered --markdown=frontend.emails.user.registered*

````
class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Confirme sua conta na '.config('app.name'))
            ->markdown('frontend.emails.user.registered');
    }
}

/************ frontend.emails.user.registered    *******************/

@component('mail::message')
# Olá {{$user->first_name}}

Seu cadastro ainda não foi concluído! .
Para ativa-lo agora, basta clicar no botão "Concluir Cadastro".

@component('mail::button', ['url' => url('/cadastro/'.$user->email.'/'.$user->token)])
Concluir Cadastro
@endcomponent

Obrigado,<br>
{{ config('app.name') }}<br>
{{ env('DT_PHONE') }}
@endcomponent
````



<div id='exemples-events-mysql'/>

## Exemplos de Events MYSQL<br>

```
- creating 
- created
- updating
- updated
- saving
- saved

  User::created(function($user){
    \Mail::to($user)->send(new UserRegistered($user));
  }
```

<div id='observers'/>

## Observers<br>

Criar uma pasta app/Observers

```
namespace AVD\Observers;


class UserObserver
{
    public function creating($user){
        //
    }

    public function created($user){
        \Mail::to($user)->send(new UserRegistered($user));
    }
    public function updating($user){
        //
    }
    public function updated($user){
       //
    }
    public function saving($user){
        //
    }
    public function saved($user){
        //
    }

}
```
Em AppServiceProvider boot()
````
User::observe(UserObserver::class);
````

<div id='events_listener' />

## Events Listener<br>

Em app/Providers/EventServiceProvider

````
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegistered::class => [
            SendEmailVerificationListener::class,
        ],
    ];
````
Executar o comando
>*$ php artisan event:generate*

Em app/Events
````
namespace AVD\Events;

use AVD\Models\Web\User;

class UserCreatedEvent
{
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

}
````
Criar no model
````
    protected $dispatchesEvents = [
        'created' => UserCreatedEvent::class,
    ];
````

<div id='queues_jobs'/>

## Queues Jobs<br>
Definir qual driver em .env QUEUE_CONNECTION=database
````
Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"

- sync: execulta na hora
- database: 
- beanstalkd: Serviço da Amazom
- sqs:
- redis:
- null:
````
Criar a tabela 
>*$ php artisan queue:table*

````
$table->bigIncrements('id');
$table->string('queue')->index();  // Tipo da Fila
$table->longText('payload'); //  Guarda o Namespace e a Class
$table->unsignedTinyInteger('attempts'); // Número de tentativas
$table->unsignedInteger('reserved_at')->nullable(); // Prioridade da Fila
$table->unsignedInteger('available_at'); // Avalia quando execultar novamente
$table->unsignedInteger('created_at');
````
Para colocal os emails na fila Manualmente trocar "send" por "queue" <br>
Para colocal os emails na fila Autômaticamente nas class colocar implements ShouldQueue<br>
Execultar o camando abaixo para o laravel observar e colocar na fila local
>*$ php artisan queue:work*

Em produção instalar e configurar o Supervisor<br>
    https://laravel.com/docs/5.8/queues#supervisor-configuration
    


  









