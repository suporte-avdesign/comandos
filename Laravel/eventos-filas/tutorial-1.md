##Tutorial Eventos e filas
*******
 1. [Preparando trabalhos para a fila](#content-1)
 2. [Em que fila deve estar passando](#content-2)
 3. [O que você quer dizer com fila?](#content-3)
 4. [A carga útil](#content-4)
 

*******
<div id='content-1'/>

## Preparando trabalhos para a fila<br>
Cada trabalho que colocamos na fila é armazenado em algum espaço de armazenamento classificado pela ordem de execução; esse local de armazenamento pode ser um banco de dados MySQL, uma loja Redis ou um serviço de terceiros como o Amazon SQS.

Posteriormente neste mergulho, exploraremos como os trabalhadores buscam esses trabalhos e começarão a executá-los, mas antes disso vamos ver como armazenamos nossos trabalhos, eis os atributos que mantemos para cada trabalho que armazenamos:

<div id='content-2'/>

##Em que fila deve estar passando
* O número de vezes que este trabalho foi tentado (inicialmente zero)
* O horário em que o trabalho foi reservado por um trabalhador
* O horário em que o trabalho fica disponível para um trabalhador buscar
* A hora em que o trabalho foi criado
* A carga útil do trabalho

<div id='content-3'/>

##O que você quer dizer com fila?
Seu aplicativo envia vários tipos de trabalhos para a fila; por padrão, todos os trabalhos são colocados em uma única fila; no entanto, convém colocar trabalhos de correio em uma fila diferente e instruir um trabalhador dedicado a executar trabalhos somente a partir dessa fila; isso garantirá que outros trabalhos não atrasem o envio de emails, já que ele possui um trabalhador dedicado.

* <b>O número de tentativas</b>

    Por padrão, o gerenciador de filas continuará tentando executar um trabalho específico se ele falhar em execução, continuará fazendo isso para sempre, a menos que você defina um número máximo de tentativas, quando as tentativas de trabalho atingirem esse número, o trabalho será marcado como com falha e os trabalhadores não tentará executá-lo novamente. Esse número começa como zero, mas continuamos incrementando-o toda vez que executamos o trabalho.
* <b>O tempo de reserva</b>

    Depois que um trabalhador escolhe um trabalho, marcamos como reservado e armazenamos o carimbo de data e hora de quando isso aconteceu, da próxima vez que um trabalhador tentar escolher um novo trabalho, ele não escolherá um reservado, a menos que o bloqueio da reserva tenha expirado, mas mais tarde .
* <b>O tempo de disponibilidade</b>

    Por padrão, um trabalho está disponível quando é empurrado para a fila e os trabalhadores podem selecioná-lo imediatamente, mas às vezes pode ser necessário atrasar a execução de um trabalho por algum tempo, você pode fazer isso fornecendo um atraso enquanto empurra o trabalho para a fila usando o  later() método de  push():
    
    >*Queue::later(60, new SendInvoice())*

    O later() método usa o  availableAt() método para determinar o tempo de disponibilidade:
    
    ````
        protected function availableAt($delay = 0)
        {
            return $delay instanceof DateTimeInterface
                                ? $delay->getTimestamp()
                                : Carbon::now()->addSeconds($delay)->getTimestamp();
        }
   ````
   Como você pode ver, você pode passar uma instância de  DateTimeInterface para definir a hora exata ou pode passar o número de segundos e o Laravel calculará o tempo de disponibilidade para você sob o hood.
   
   <div id='content-1'/>
   
## A carga útil<br>
Os métodos push() e later()usam o createPayload() método internamente para criar as informações necessárias para executar o trabalho quando ele é escolhido por um trabalhador. Você pode passar um trabalho para a fila em dois formatos:
````
// Passa um objeto 
Queue::push(new SendInvoice($order));

// Passa uma string
Queue::push('App\Jobs\SendInvoice@handle', ['order_id' => $orderId])
````
No segundo exemplo, enquanto o trabalhador estiver escolhendo o trabalho, o Laravel usará o contêiner para criar uma instância da classe especificada, assim você terá a chance de exigir quaisquer dependências no construtor do trabalho.
* <b>Criando a carga útil de um trabalho de sequência</b>

    createPayload() chama  createPayloadArray() internamente que chama o  createStringPayload() método, caso o tipo não seja um objeto:
    ````
    protected function createStringPayload($job, $data)
    {
        return [
            'displayName' => is_string($job) ? explode('@', $job)[0] : null,
            'job' => $job, 'maxTries' => null,
            'timeout' => null, 'data' => $data,
        ];
    }
    ````
    O  displayName de um trabalho é uma string que você pode usar para identificar o trabalho que está sendo executado. No caso de definições de trabalho sem objeto, usamos o nome da classe de trabalho como  displayName.
    
    Observe também que armazenamos os dados fornecidos na carga útil do trabalho.
* <b>Criando a carga útil de uma tarefa de objeto</b>
  
    Veja como uma carga útil de trabalho baseada em objeto é criada:
    ````
    protected function createObjectPayload($job)
    {
        return [
            'displayName' => $this->getDisplayName($job),
            'job' => 'Illuminate\Queue\CallQueuedHandler@call',
            'maxTries' => isset($job->tries) ? $job->tries : null,
            'timeout' => isset($job->timeout) ? $job->timeout : null,
            'data' => [
                'commandName' => get_class($job),
                'command' => serialize(clone $job),
            ],
        ];
    }
    ````
    Como já temos a instância do trabalho, podemos extrair algumas informações úteis, por exemplo, o  getDisplayName() método procura um  displayName() método dentro da instância do trabalho e, se encontrado, usa o valor de retorno como o nome do trabalho, isso significa que você pode adicionar esse método na sua classe de trabalho para controlar o nome do seu trabalho na fila.
    ````
    protected function getDisplayName($job)
    {
        return method_exists($job, 'displayName')
                        ? $job->displayName() : get_class($job);
    }
    ````
    