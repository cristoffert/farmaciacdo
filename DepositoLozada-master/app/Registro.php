<?php

namespace App;
use App\EstadoCompra;
use App\Proveedor;
use App\formapago;
use App\User;


use Illuminate\Database\Eloquent\Model;

class registro extends Model
{
   protected $table = 'registro';

   protected $fillable  = ['posicion','escaneo','lote','vencimiento','cantidadrecepcion'];

   protected $PK = 'regid';

}