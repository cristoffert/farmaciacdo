<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\compra;
use App\Bodega;
use App\EstadoCompra;
use App\User;
use App\formapago;
use Session;
use App\Producto;
use DateTime;
use App\detalle_compra;
use  App\CartDetail;
use App\Proveedor;
use App\PreciosProducto;
use App\TipoPaca;
use App\Marca; 
use App\TipoContenido;
use App\abonoCompra;
use Carbon\Carbon;
use App\Registro;
use Auth;



class RegistroController extends Controller
{
    public function RegistroController(){
        return view('admin.ordencompra.edit');
    }

    public function storeg(Requests $request)
    {
        \App\registro::RegistroController([
            'dococ'         => $requests['dococ'],
            'posicion'      => $requests['posicion'],
            'escaneo'       => $request['escaneo'],
            'lote'          => $request['lote'],
            'vencimiento'   => $request['vencimiento'],
            'cantidadrecepcion'=> $request['cantidadrecepcion'],
            //'Registro'  => $request [date('l jS \of F Y h:i:s A')],
        ]);
        return "Producto Registrado";
    }
}