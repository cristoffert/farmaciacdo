@extends('layouts.app')

@section('title','Venta')


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('titulo-contenido','Venta')

@section('header-class')

<div class="panel-header panel-header-sm">
</div>
@endsection

@section('contenido')
<div class="row">    
        <!-- mostrar mensaje del controlador -->
        @if (session('notification'))
        <div class="alert alert-info alert-with-icon" data-notify="container">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>
            <span data-notify="icon" class="now-ui-icons ui-1_check"></span>
            <span data-notify="message">{{ session('notification') }}</span>
        </div>
        @endif
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                    <div class="row text-center">
                         <div class="col-md-6 pr-1">
                                <div class="form-group">
                                   <h5 class="title">Mirar Venta</h5>
                                  
                                </div>
                         </div>
                         <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <h5 class="title" id="date">Fecha</h5>
                                    
                                </div>
                         </div>                 
                    </div>
              </div>
             
            
    
         <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                    @if ( session( 'error' ) )
                    <div class="alert alert-warning">
                        <ul>
                            @foreach (session('error') as $itemError)
                                <li>{{ $itemError }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table" cellspacing="0" id="tableCompras">
                            <thead class=" text-primary">
                             <th class="text-center">
                                    N°Venta
                                </th>
                                <th class="text-center">
                                    Estado
                                </th>
                                <th class="text-center">
                                    Forma de pago
                                </th>
                                <th class="text-center">
                                    fecha de entrega
                                </th>
                                <th class="text-center">
                                    hora de entrega
                                </th>
                                 <th class="text-center">
                                    Saldo
                                </th>
                                <th class="text-center">
                                    Cliente
                                </th>
                                 <th class="text-center">
                                    Cedula
                                </th>

                                <th class="text-center">
                                    Total
                                </th>                            
                                
                            </thead>
                            @foreach( $Cargarventas as $Cargarventa )
                            <?php
                                $nombreEstadoCompra =  $Cargarventa -> estadoVentas();
                            ?>
                                <tr>
                                        <td class="text-center">{{ $Cargarventa -> id }}</td>
                                        @if( $Cargarventa -> estadoVentas() != "" ||  $Cargarventa -> estadoVentas() != null )
                                        <td class="text-center">{{  $Cargarventa -> estadoVentas() -> nombre }}</td> 
                                        @else
                                        <td class="text-center">0</td> 
                                        @endif
                                         @if( $Cargarventa -> formapagos() != "" ||  $Cargarventa -> formapagos() != null )
                                        <td class="text-center">{{  $Cargarventa -> formapagos() -> nombre }}</td> 
                                        @else
                                        <td class="text-center">no definido</td> 
                                        @endif

                                        @if( $Cargarventa -> fecha_entrega != "" ||  $Cargarventa -> fecha_entrega != null )
                                        <td class="text-center">{{  $Cargarventa -> fecha_entrega}}</td> 
                                        @else
                                        <td class="text-center">fecha no definida</td> 
                                        @endif
                                         @if( $Cargarventa -> hora != "" ||  $Cargarventa -> hora != null )
                                        <td class="text-center">{{  $Cargarventa -> hora}}</td> 
                                        @else
                                        <td class="text-center">hora no definida</td> 
                                        @endif
                                        @if( $Cargarventa -> saldo != "" ||  $Cargarventa -> saldo != null )
                                        <td class="text-center">{{  $Cargarventa -> saldo}}</td> 
                                        @else
                                        <td class="text-center">no tiene deuda pendiente</td> 
                                        @endif
                                          {{-- proveedires esta vacio debe validar eso  --}}
                                        @if( $Cargarventa -> cliente() != "" || $Cargarventa -> cliente() != null )
                                        <td class="text-center">{{ $Cargarventa -> cliente()-> name }}</td>
                                        @else 
                                        <td class="text-center">Sin Definir</td>
                                        @endif
                                        
                                         @if( $Cargarventa -> cliente() != "" || $Cargarventa -> cliente() != null )
                                        <td class="text-center">{{ $Cargarventa -> cliente()-> number_id }}</td>
                                        @else 
                                        <td class="text-center">Sin Definir</td>
                                        @endif
                                        @if($Cargarventa->total != null ||$Cargarventa->total != "")                                           
                                        <td class="text-center">{{ $Cargarventa -> total }}</td>
                                        @else
                                        <td class="text-center">0</td>
                                        @endif

                                        
                                    </tr>
                                    @endforeach
                  
                   
                </div>
         
              
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" cellspacing="0" id="tableCompras">
                            <thead class=" text-primary">
                                    <th class="text-center">
                                            Ref-Canasta
                                        </th>
                                
                                <th class="text-center">
                                    Producto
                                </th>
                                <th class="text-center">
                                    Cantidad
                                </th>                  
                                   
                                <th class="text-center">
                                    Precio Venta
                                </th>
                                <th class="text-center">
                                    SubTotal
                                </th>                            
                               
                            </thead>                       
    
                            <tbody>
                                   <?php                                
                             $IdCompra =0; 
                            $subtotal=0;
                            $total=0;      
                         ?>
                        @foreach( $Detalle_ventas as $Detalles_venta )
                            <tr>
                               <?php
                                   
                                    $NombreProducto =  $Detalles_venta->producto();
                                    $PrecioProducto = $Detalles_venta->producto();
                                    $envase=$Detalles_venta->empaque();
                                    $marca=$Detalles_venta->productoMarca();
                                     $IdVenta =$Detalles_venta ->fk_factura; 
                                     $subtotal=$Detalles_venta->precio * $Detalles_venta->cantidad;
                                     $total=$total+$subtotal;
                                     $canasta= $Detalles_venta->Numero_canasta;
                                     if($canasta==null || $canasta==0 || $canasta==-1 || $canasta==-2 )
                                     {
                                        $canasta=0;
                                     }                                                                          
                                ?>
                                {{-- {{$marca->nombre}} --}}
                                <input type="text" id="idfac" value="{{$IdVenta}}" name="idfac" hidden="true">

                                @if($Detalles_venta->Numero_canasta !=null && $Detalles_venta->Numero_canasta != 0 && $Detalles_venta->Numero_canasta != -1 && $Detalles_venta->Numero_canasta != -2)
                                
                                <th class="text-center">{{  $Detalles_venta -> Numero_canasta }}</td>                               
                                @else                                
                                    <th class="text-center"> </td>                                 
                                @endif
                               
                                  @if($Detalles_venta->Numero_canasta ==-1)
                                 <th class="text-center">{{  $envase -> nombre.'-'.$marca->nombre}}</td>
                                  
                                  @elseif($Detalles_venta->Numero_canasta >0 || $Detalles_venta->Numero_canasta ==-2)
                                 <th class="text-center">{{  $NombreProducto -> nombre.'-'.$marca->nombre }}</td>
                                  @elseif($Detalles_venta->Numero_canasta ==0 )
                                  <th class="text-center">{{'envases-'.$marca->nombre}}</td>
                                  @endif
                                    
                                
                                 @if($Detalles_venta->Numero_canasta ==null || $Detalles_venta->Numero_canasta == -2 || $Detalles_venta->Numero_canasta == -1)
                                 
                                    <th class="text-center"><input name='{{$Detalles_venta -> id}}' type="number" value='{{$Detalles_venta -> cantidad}}' class="number"  MIN="1" STEP="1" SIZE="6" id="number" disabled></td>
                                 
                                 @else
                                 <th class="text-center"><input name='{{$Detalles_venta -> id}}' type="number" value='{{$Detalles_venta -> cantidad}}' class="number "  MIN="1" STEP="1" SIZE="6" id="number"  style="background-color:#ff0000" disabled></td>
                                 @endif
                                    
                                    <th class="text-center">{{ $Detalles_venta-> precio }}</td>
                                    <th class="text-center">{{ $Detalles_venta-> precio * $Detalles_venta-> cantidad }} </td>
                                    
                                  
                                    </td>
                                </tr>
                                @endforeach
                           
                        </tbody>
                        </table>
                        <hr>
                        <h3 class="text-center"><strong>Total:{{$total}}</strong></h3>
                         

                         <div class="col-md-4">
                            <div class="form-group">
                               
                            <a href="{{URL::previous()}}"  class="btn btn-success btn-round">Regresar</a>
                           </div>
                        </div>
                       
                    </div>
                </div>
        
            </div>


        
    </div>
    
    
    
    
   
@endsection



@section('scripts')


    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('/js/typeahead.bundle.min.js')}}"></script>
 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

   

    
    
@endsection