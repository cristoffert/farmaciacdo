@extends('layouts.app')

@section('title','Compra')


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('titulo-contenido','Compra')

@section('header-class')

<div class="panel-header panel-header-sm">
</div>
@endsection


<style>




.custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding-top: 2px;
    padding-bottom: 5px;
    padding-right: 5px;
  }

  .enlace {
      border: 0;
      padding: 50px;
      background-color: transparent;    
      color: blue;
      border-bottom: 0px solid blue;
    }

    .ui-widget {

    font-size: 1.5em;
    }
</style>
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
                                   <h5 class="title">Crear Compra</h5>
                                  
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
                    <form  id="AgregarCabezeraCompra" action="{{url('/ordencompra')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="table-responsive">
                        <table class="table" cellspacing="0" id="tableOrdenCompra">
                            <thead class=" text-primary">
                            <th class="text-center">
                                    Orden de compra
                                </th>
                             <th class="text-center">
                                    Posicion
                                </th>
                                <th class="text-center">
                                    Pistolear
                                </th>
                                <th class="text-center">
                                    Lote
                                </th>
                                
                                <th class="text-center">
                                    Vencimiento
                                </th>                            
                                <th class="text-center">
                                    Cantidad Recepcionada
                                </th>
                                <th class="text-center">
                                    Acción
                                </th>
                            </thead>
                            <?php
                            $codigo="name";
                            $escaneo="";
                            
                            ?>
                                <tr>
                                        <td class="text-center">    
                                        <input id="dococ" type="text" class="form-control" name="dococ" readonly="readonly" value="{{$docordencompra}}">
                                        </td>
                                        <td class="text-center">    
                                        <input id="posicion" type="text" class="form-control" name="posicion" readonly="readonly" value="{{$ordenrecep}}">
                                        </td>
                                        <td class="text-center">
                                        <input id="escaneo" type="text" class="form-control" name="escaneo" value="{{$lote}}" required autofocus>
                                        </td>
                                        <td class="text-center">
                                        <input id="lote" type="text" class="form-control" name="lote" readonly="readonly"  value="{{substr($lote,10,9)}}">
                                        </td>
                                        <td class="text-center">
                                        <input id="vencimiento" type="text" class="form-control" name="vencimiento" readonly="readonly"  value="{{substr($lote, 21)}}">
                                        </td>
                                        <td class="text-center">
                                        <input id="cantidadrecepcion" type="text" class="form-control" name="cantidadrecepcion" value="{{ old('cantidadrecepcion') }}" required autofocus>
                                        </td>
                                        <td class="text-center">
                                        <button type="submit" class="btn btn-info btn-round"  onclick="Mostrar();">Agregar
                                        </button>
                                       
                                        </td>
                                        
                                    </tr>
                                  
                        </table>
                    </div>
                </form>
            </div>
    </div>
           
@endsection



@section('scripts')


    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('/js/typeahead.bundle.min.js')}}"></script>
     <script src="{{asset('/js/scriptcompraEditar.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

   

    
    
@endsection