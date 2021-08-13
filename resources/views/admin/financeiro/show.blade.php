@extends('layouts.app')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{-- <h1 class="m-0">Dashboard</h1> --}}
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route("financeiro.index") }}">Lista de movimentação</a></li>
                <li class="breadcrumb-item"><a href="{{ route("financeiro.show", $financeiro->id)}}">Detalhes da movimentação</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"> <i class="fas fa-globe"></i> {{$financeiro->empresa->nome}}</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <p><strong>Valor</strong>: R$ {{maskDinheiro($financeiro->preco)}}</p>
                    <p><strong>Tipo</strong>: <span class="badge badge-{{$financeiro->tipo == 'E' ? 'success' : 'danger'}}">{{tipo($financeiro->tipo)}}</span></p>
                    <p><strong>Descrição</strong>: {{$financeiro->descricao}}</p>
                </div>
                <div class="col-sm-6">
                    <strong>Data da movimentação</strong>: {{formatDateAndTime($financeiro->data_pagamento)}}
                </div>
            </div>
        </div>
        <div class="card-footer clearfix">
            <form action="{{route('financeiro.destroy', $financeiro->id)}}" method="post">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger"  onclick="return confirm('Tem certeza que deseja excluir?')">
                    <i class="fas fa-trash-alt"></i> Excluir
                </button>
            </form>
        </div>
    </div>
@endsection
