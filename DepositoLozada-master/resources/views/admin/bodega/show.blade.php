@extends('layouts.app')

@section('title','Bodegas')

@section('titulo-contenido','Bodegas')

@section('header-class')
<div class="panel-header panel-header-sm">
</div>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            {{-- <div class="image">
                <img src="../assets/img//bg5.jpg" alt="...">
            </div> --}}
            <div class="card-body">
                <div class="text-center">
                    <a href="#">
                        {{-- <img class="avatar border-gray" src="../assets/img//mike.jpg" alt="..."> --}}
                        <h5 class="title">{{ $bodega -> nombre }}</h5>
                    </a>
                </div>
                <p class="description text-center">
                    {{ $bodega -> direccion }}
                </p>
                <p class="description text-center">
                    {{ $bodega -> telefono }}
                </p>
                <p class="description text-center">
                    @if ( $bodega -> celular != 0 )
                        {{ $bodega -> celular }}
                    @endif
                </p>
                <p class="description text-center">
                    {{ $municipios[0] -> nombre }}
                </p>
                <div class="text-center">
                    <a href="{{ url('/bodega') }}" class="btn btn-info btn-round"><i class="now-ui-icons arrows-1_minimal-left"></i> Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection