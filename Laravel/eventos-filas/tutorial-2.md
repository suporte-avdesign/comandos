## Tutorial Eventos e filas
*******
 1. [Preparando trabalhos para a fila](#tutorial-1)
 2. [Enviando trabalhos para a fila](#tutorial-2)
 2. [Exemplos de Eventos MYSQL](#exemples-events-mysql)
 3. [Observers](#observers)
 4. [Events Listener](#events_listener)
 5. [Queues Jobs](#queues_jobs)

*******
<div id='tutorial-2'/>

## Preparando trabalhos para a fila<br>
* Existem várias maneiras de enviar trabalhos para a fila:<div id='tutorial-2'/>

## Enviando trabalhos para a fila<br>
* Existem várias maneiras de enviar trabalhos para a fila:
````
Queue::push(new InvoiceEmail($order));

Bus::dispatch(new InvoiceEmail($order));

dispatch(new InvoiceEmail($order));

(new InvoiceEmail($order))->dispatch();
````
*






>*$ php artisan make:mail UserRegistered --markdown=frontend.emails.user.registered*
