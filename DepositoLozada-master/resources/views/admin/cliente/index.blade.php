@extends('layouts.app')

@section('title','Clientes')

@section('styles')
    <style>
        /* estilo para que la imagen quede bien redonda */
        .resize-img {
            height: 80px;
            width: 80px;
        }
    </style>
@endsection

@section('titulo-contenido','Clientes')

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
                {{-- <h4 class="card-title"> Simple Table</h4> --}}
                <a href="{{ url('/cliente/create') }}" class="btn btn-warning btn-round">Nuevo Cliente</a>
            </div>
            <div class="card-body">
                <table class="display nowrap" cellspacing="0" width="100%" id="tableTiposMovimientos">
                    <thead class=" text-primary">
                        <th class="text-center">
                            Foto
                        </th>
                        <th class="text-left">
                            # Documento
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Correo
                        </th>
                        <th>
                            Bodega
                        </th>
                        <th>
                            Estado
                        </th>
                        <th class="text-center">
                            Opciones
                        </th>
                    </thead>
                    <tbody>
                        @foreach( $clientes as $cliente )
                            <tr>
                                <td class="text-left">
                                    @if( $cliente -> url_foto )
                                        <img class="rounded-circle mx-auto d-block resize-img" src="/imagenes/clientes/{{ $cliente -> url_foto }}" alt="">
                                    @else
                                        <img class="img-thumbnail mx-auto d-block resize-img" src="/imagenes/default.png" alt="">
                                    @endif
                                </td>
                                <td>{{ $cliente -> number_id }}</td>
                                <td>{{ $cliente -> name }}</td>
                                <td>{{ $cliente -> email }}</td>
                                <td>{{ $cliente -> bodega() -> nombre }}</td>
                                {{--<td>{{ $cliente -> ruta() -> nombre }}</td>--}}
                                <td>
                                    @if ( $cliente -> estado == 'A' )
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
                                </td>
                                <td class="td-actions text-right">
                                    <form method="post" class="delete">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <a href="{{ url('/cliente/'.$cliente->number_id) }}" rel="tooltip" title="Ver cliente {{ $cliente -> name }}" class="btn btn-info btn-icon btn-sm">
                                            <i class="fa fa-info"></i>
                                        </a>
                                        <a href="{{ url('/cliente/'.$cliente->number_id.'/edit') }}" rel="tooltip" title="Editar cliente {{ $cliente -> name }}" class="btn btn-success btn-icon btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class='btn btn-danger btn-icon btn-sm' rel="tooltip" title="Eliminar cliente {{ $cliente -> name }}" onclick="Delete('{{ $cliente -> name }}','{{ $cliente -> number_id }}')">
                                            <i class='fa fa-times'></i>
                                        </a>
                                        <!-- <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button> -->
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
                });
        });
    </script>
    <script>
        function Delete( nameProduct , idDel ) {
            var pathname = window.location.pathname; //ruta actual
			$.confirm({
				theme: 'supervan',
				title: 'Eliminar cliente',
				content: 'Seguro(a) que deseas eliminar el cliente' + nameProduct + '. <br> Click Aceptar or Cancelar',
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
								content: 'Una vez eliminado debes volver a crear el cliente',
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
            $('#tableTiposMovimientos').DataTable({
                "language": {

                    "emptyTable": "No hay clientes registrados , click en el boton <b>Nuevo cliente</b> para agregar uno nuevo",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "previous": "Anterior",
                        "next": "Siguiente",
                    },
                    "search": "Buscar: ",
                    "info": "Mostrando del _START_ al _END_, de un total de _TOTAL_ entradas",
                    "lengthMenu": "Mostrar _MENU_ clientes por Página",
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