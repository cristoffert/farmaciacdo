@extends('layouts.app')

@section('title','Buscar Orden de Compra')

@section('titulo-contenido','Resultado de busqueda')

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

            </div>
                     
                <div class="card-body">
                <form class="navbar-form navbar-left" role="search" action="{{url('ordencompra/searchredirect')}}">
                <div class="form-group">
                    <input type="text" class="form-control" name='search' placeholder="Buscar Orden de Compra"/>
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
                </form>    
        
                             
            <div class="card-body">
                <div class="table-responsive">
 
                    <table class="table" cellspacing="0" id="tableOrdenCompra">
                        <thead class=" text-primary">
                            
                            <th class="text-center">
                                ITEM
                            </th>
                            <th class="text-center">
                                Documento
                            </th>
                            <th class="text-center">
                                Material
                            </th>
                            <th class="text-center">
                                Descripción
                            </th>
                            <th class="text-center">
                                Cantidad Pedido
                            </th>                            
                            <th class="text-center">
                                Cantidad Recepcionada
                            </th>
                            <th class="text-center">
                                Saldo
                            </th>                            
                            <th class="text-center">
                                Opciones
                            </th>
                        </thead>
                        <tbody>
     
                        
                            @foreach($comments as $ekpo) 

                        <?php

                        ?>
                            
                                <tr>
                                   
                                    <td class="text-center">{{ $ekpo -> EBELP }}</td>
                                    <td class="text-center">{{ $ekpo -> EBELN }}</td>
                                    <td class="text-center">{{ $ekpo -> MATNR }}</td>
                                    <td class="text-center">{{ $ekpo -> MATNR }}</td>
                                    <td class="text-center">{{ $ekpo -> MENGE }}</td>
                                    <td class="text-center">{{ $cantidad2}}</td>
                                    <td class="text-center">{{ $cantidad2}}</td>

                                    <!-- ///////////////////numero de ferentecia -->

 
                                    <td class="td-actions text-right">
                                        <form method="post" class="delete">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
    
                                            <a href="{{ url('/ordencompra/'.$ekpo->EBELN,$ekpo->EBELP) }}" rel="tooltip" title="Ver compra{{ $ekpo -> EBELN}}" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-info"></i>
                                            </a>
                                           
                                            @if($ekpo->LOEKZ=="")
                                            <a href="{{ url('/ordencompra/'.$ekpo->EBELN,$ekpo->EBELP.'/edit') }}" rel="tooltip" title="Editar compra{{ $ekpo -> EBELN }}" class="btn btn-success btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endif
                                            @if($ekpo->fk_estado_compra==1)
                                            <a class='btn btn-danger btn-simple btn-xs' rel="tooltip" title="Eliminar compra {{ $ekpo -> EBELN }}" onclick="Delete('{{ $compra -> EBELN }}','{{ $ekko -> EBELN }}')">
                                                    <i class='fa fa-times'></i>
                                            </a>
                                          
                                          @else
                                          <a href="{{ action('ordencompraController@imprimir',['EBELN' => $ekpo -> EBELN,'estado'=>0 ]) }}"  class="btn btn-danger btn-xs" target="_blank()">PDF</a>
                            
                                          @endif
                                          @if($ekpo->fk_estado_compra==2)
                                          <a href="{{ action('ordencompraController@imprimir',['EBELN' => $ekpo -> EBELN,'estado'=>3 ]) }}" class="btn btn-success btn-xs"  class="btn btn-info btn-round" target="_blank()">PDF - Recibido</a>
                                          @endif


                                           
                                            <!-- <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button> -->
                                        </form>
                                    </td>
                                </tr>
                                
                        </tbody>
                        @endforeach

                     
                    </table>
                   
                </div>
            </div>
            
        </div>
        
    </div>
    
</div>
@endsection

@section('scripts')

    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables/dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables/responsive.bootstrap4.min.js') }}" type="text/javascript"></script>

    {{-- metodo jquery para usar la libreria de confirmar para eliminar --}}
    <script>
        function Delete( nameProduct , idDel ) {
            var pathname = window.location; //ruta actual
			$.confirm({
				theme: 'supervan',
				title: 'Eliminar Compra',
				content: 'Seguro(a) que deseas eliminar compra ' + nameProduct + '. <br> Click Aceptar or Cancelar',
				icon: 'fa fa-question-circle',
				animation: 'scale',
				animationBounce: 2.5,
				closeAnimation: 'scale',
				opacity: 0.5,
				buttons: {
					'confirm': {
						text: 'Aceptar',
						btnClass: 'btn-blue',
						action: function () {
							$.confirm({
								theme: 'supervan',
								title: 'Estas Seguro ?',
								content: 'Una vez eliminado debes volver a crear la compra',
								icon: 'fa fa-warning',
								animation: 'scale',
								animationBounce: 2.5,
								closeAnimation: 'zoom',
								buttons: {
									confirm: {
										text: 'Si, Estoy Seguro!',
										btnClass: 'btn-orange',
										action: function () {
                                            $('.delete').attr('action' , pathname + '/' + idDel );
                                            $('.delete').submit();
										}
									},
									cancel: {
										text: 'No, Cancelar',
										//$.alert('you clicked on <strong>cancel</strong>');
									}
								}
							});
						}
					},
					cancel: {
						text: 'Cancelar',
						//$.alert('you clicked on <strong>cancel</strong>');
					},
				}
			});
		}
    </script>
    <script>
        $(document).ready(function() {
            $('#tableOrdenCompra').DataTable({
                "language": {

                    "emptyTable": "Orden de Compra no encontrada , realice una nueva búsqueda",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "previous": "Anterior",
                        "next": "Siguiente",
                    },
                    "search": "Buscar: ",
                    "info": "Mostrando del _START_ al _END_, de un total de _TOTAL_ entradas",
                    "lengthMenu": "Mostrar _MENU_ compra por Página",
                    "zeroRecords": "No se encontro ningun resultado",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                },
                "responsive" : "true",
                "autoWidth": "true"
            });
        });
    </script>
@endsection
