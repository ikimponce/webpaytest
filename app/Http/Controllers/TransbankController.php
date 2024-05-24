<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

class TransbankController extends Controller
{
    public function __controller(){
        if (app()->environment('production')){
            WebpayPlus::configureForProduction(
                env('webpay_plus_cc'),
                env('webpay_plus_api_key')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function iniciar_compra(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);
        $total = $request->session()->get('total', 0);
    
        if (empty($carrito)) {
            return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');
        }
    
        $ncompra = new Compra();
        $ncompra->session_id = $request->session()->getId();
        $ncompra->total = $total;
        $ncompra->save();
    
        $url_to_pay = self::start_web_pay_plus_transaction($ncompra);
        return redirect()->away($url_to_pay);
    }

    public function start_web_pay_plus_transaction($ncompra){
        $transaccion = (new Transaction)->create(
            $ncompra->id,
            $ncompra->session_id,
            $ncompra->total,
            route('confirmar_pago')
        );
        $url = $transaccion->getUrl().'?token_ws='.$transaccion->getToken();
        return $url;
    }

    public function confirmar_pago(Request $request){
        $confirmacion = (new Transaction)->commit($request->get('token_ws'));

        $compra = Compra::where('id', $confirmacion->buyOrder)->first();

        if($confirmacion->isApproved()){
            $compra->status = 2;
            $compra->update();

            return redirect(env('URL_FRONTEND_AFTER_PAYMENT')."?compra_id={$compra->id}");
        } else {
            return redirect(env('URL_FRONTEND_AFTER_PAYMENT')."?compra_id={$compra->id}");
        }
    }
}
