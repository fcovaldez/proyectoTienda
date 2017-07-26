<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Cart;
use Input;
use App\Orden;
use App\DetalleOrden;
use Auth;

class PayPalController extends Controller
{
    private $_api_context;
    public function __construct()
	{
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}
    public function postPayment(){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $items = array();
        $currency= 'MXN';
        $subtotal=Cart::subtotal();
        $subtotal= str_replace(",","",$subtotal);
        foreach(Cart::content() as $carrito){
            $item= new Item();
            $item->setName($carrito->name)
            ->setCurrency($currency)
            ->setDescription('Tienda Tec')
            ->setQuantity($carrito->qty)
            ->setPrice($carrito->price);
            $items[] = $item;
        }
        $item_list = new ItemList();
        $item_list->setItems($items);
        $details = new Details();
        $details->setSubtotal($subtotal)
        ->setShipping(150);
        $total= $subtotal + 150;
        $amount = new Amount();
        $amount->setCurrency($currency)
        ->setTotal($total)
        ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setItemList($item_list)
        ->setDescription('Pedido proyecto negocios electronicos II');

        $redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('payment.status'))
			->setCancelUrl(\URL::route('payment.status'));
        
        $payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
        
        try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Algo ha salido mal!!!');
			}
		}

        foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
        \Session::put('paypal_payment_id', $payment->getId());
		if(isset($redirect_url)) {

			return \Redirect::away($redirect_url);
		}
		return \Redirect::route('/carrito')
			->with('error', 'Error.');
	}

	public function getPaymentStatus()
	{
		$payment_id = \Session::get('paypal_payment_id');
		\Session::forget('paypal_payment_id');
		$payerId = \Input::get('PayerID');
		$token = \Input::get('token');
		if (empty($payerId) || empty($token)) {
			return \Redirect::route('/')
				->with('message', 'Hubo un problema al intentar pagar con Paypal');
		}
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
		$execution->setPayerId(\Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { 
			$this->guardarOrden();
			Cart::destroy();
            flash('¡Su compra ha sido exitosa!!!')->success();
			return \Redirect::route('/')
				->with('message', 'Compra realizada de forma correcta');
		}
		return \Redirect::route('/')
			->with('message', 'La compra fue cancelada');
	}
    public function guardarOrden(){
        $subtotal=Cart::subtotal();
        $subtotal= str_replace(",","",$subtotal);
        $carrito=Cart::content();
        $envio=150;
        $orden= new Orden();
        $orden->subtotal=$subtotal;
        $orden->envio=$envio;
        $orden->idusuario=Auth::user()->id;
        $orden->save();
        foreach(Cart::content() as $carrito){
            $this->guardarDetalle($carrito,$orden->id);
        }
    }
    public function guardarDetalle($articulo,$ordenid){
        $ordendetalle= new DetalleOrden();
        $ordendetalle->precio=$articulo->price;
        $ordendetalle->cantidad=$articulo->qty;
        $ordendetalle->idproducto=$articulo->id;
        $ordendetalle->idorden=$ordenid;
        $ordendetalle->save();
    }
}




