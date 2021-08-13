@extends('layouts.app')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{-- <h1 class="m-0">Dashboard</h1> --}}
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route("produto.index") }}">Listagem de Produtos</a></li>
                <li class="breadcrumb-item"><a href="{{ route("produto.create") }}">Cadastrar um novo Produtos</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Cadastrar um novo Produtos</h2>
        </div>
        <div class="card-body">
            <form action="{{route('produto.store')}}" method="POST" class="row g-3">
                @method('POST')
                @csrf
                @include('admin.produto.form')
            </form>
        </div>
    </div>
@endsection
