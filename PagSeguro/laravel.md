## Model PagSeguro
*******
 1. [Install Guzzle](#install)
 2. [Checkout Redirect ](#checkout_redirect)
 3. [Checkout Lightbox ](#checkout_lightbox)
 

*******
<div id='install'/>

## Intall Guzzle <br>
* Adicionar no composer.json
 * http://docs.guzzlephp.org/en/stable/overview.html#installation
````
{
   "require": {
      "guzzlehttp/guzzle": "~6.0"
   }
}
$ Composer update
````
* Adicionar no .env 
```` 
PAGSEGURO_ENVORINMENT=sandbox ou production
PAGSEGURO_EMAIL=xxxxxxxxxxxxx
PAGSEGURO_TOKEN=xxxxxxxxxxxxx
````
* Criar arquivo na pasta config com as variaveis
````
<?php

$environment = env('PAGSEGURO_ENVORINMENT');
$isSandbox = ($environment == 'sandbox') ? true : false;


$urlCheckout                = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout' : 'https://ws.pagseguro.uol.com.br/v2/checkout';
$urlCheckoutAfterRequest    = ($isSandbox) ? 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=' : 'https://ws.pagseguro.uol.com.br/v2/checkout/payment.html?code=';
$urlLightbox                = ($isSandbox) ? 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js' : 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js';
$urlSessionTranparent       = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions' : 'https://ws.pagseguro.uol.com.br/v2/sessions';
$urlTransparentJs           = ($isSandbox) ? 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js' : 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
$urlPaymentTransparent      = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions' : 'https://ws.pagseguro.uol.com.br/v2/transactions';
$urlNotification            = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications' : 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications';

return [
    'environment'   => $environment,
    'email'         => env('PAGSEGURO_EMAIL'),
    'token'         => env('PAGSEGURO_TOKEN'),
    
    'url_checkout'                  => $urlCheckout,
    'url_redirect_after_request'    => $urlCheckoutAfterRequest,
    'url_lightbox'                  => $urlLightbox,
    'url_transparent_session'       => $urlSessionTranparent,
    'url_transparent_js'            => $urlTransparentJs,
    'url_payment_transparent'       => $urlPaymentTransparent,
    'url_notification'              => $urlNotification,
];
````
* Criar PagSeguro (Routes,Controller, Repository, Interface)

<div id='checkout_redirect'/>

## Checkout Redirect <br>
* Route
````
Route::get('pagseguro', 'Web\PagSeguroController@pagseguro')->name('pagseguro');
````
* PagSeguroRepository
````
<?php

namespace AVD\Repositories\Web;

use AVD\Interfaces\Web\PagSeguroInterface;
use GuzzleHttp\Client as Guzzle;

class PagSeguroRepository implements PagSeguroInterface
{


    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Create
     *
     * @param  array $input
     * @return mixed
     */
    public function generate()
    {
        $params = [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
            'currency' => 'BRL',
            'itemId1' => '0001',
            'itemDescription1' => 'Produto PagSeguroI',
            'itemAmount1' => '99999.99',
            'itemQuantity1' => '1',
            'itemWeight1' => '1000',
            'itemId2' => '0002',
            'itemDescription2' => 'Produto PagSeguroII',
            'itemAmount2' => '99999.98',
            'itemQuantity2' => '2',
            'itemWeight2' => '750',
            'reference' => 'REF1234',
            'senderName' => 'Jose Comprador',
            'senderAreaCode' => '99',
            'senderPhone' => '999999999',
            'senderEmail' => 'comprador@uol.com.br',
            'shippingType' => '1',
            'shippingAddressRequired' => 'true',
            'shippingAddressStreet' => 'Av. PagSeguro',
            'shippingAddressNumber' => '9999',
            'shippingAddressComplement' => '99o andar',
            'shippingAddressDistrict' => 'Jardim Internet',
            'shippingAddressPostalCode' => '99999999',
            'shippingAddressCity' => 'Cidade Exemplo',
            'shippingAddressState' => 'SP',
            'shippingAddressCountry' => 'BRA',
            'timeout' => '25',
            'enableRecover' => 'false'
        ];

        $params = http_build_query($params); //email=xpto&token=xpto etc...


        $guzzle = new Guzzle();
        $response = $guzzle->request('POST', config('pagseguro.url_checkout'), [
            'query' => $params,
        ]);
        $body = $response->getBody();
        $contents = $body->getContents(); //receber code para redirecionar o usuário

        $xml = simplexml_load_string($contents); // xml para json

        return $xml->code;
    }


}
````
* PagSeguroController
````
<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Interfaces\Web\PagSeguroInterface as InterPagSeguro;
use AVD\Http\Controllers\Controller;

class PagSeguroController extends Controller
{
    /**
     * @var InterPagSeguro
     */
    private $pagSeguro;

    public function __construct(InterPagSeguro $pagSeguro)
    {

        $this->pagSeguro = $pagSeguro;
    }

    public function pagseguro()
    {
        $code = $this->pagSeguro->generate();

        $urlRedirect = config('pagseguro.url_redirect_after_request').$code;

        return redirect()->away($urlRedirect);

        
    }
}

````

<div id='checkout_lightbox'/>

## Checkout Lightbox <br>
* Route





