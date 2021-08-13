@extends('layouts.app')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{-- <h1 class="m-0">Dashboard</h1> --}}
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route("usuario.index") }}">Listagem de usuario</a></li>
                <li class="breadcrumb-item"><a href="{{ route("usuario.show", $usuario->id)}}">Dados do usuario</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Dados do usuario</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <p><strong>Usuario</strong>: {{$usuario->name}}</p>
                </div>
                <div class="col-sm-6">
                    <strong>Email</strong>: {{$usuario->email}}
                </div>
            </div>
        </div>
        <div class="card-footer clearfix">
            <form action="{{route('usuario.destroy', $usuario->id)}}" method="post">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger"  onclick="return confirm('Tem certeza que deseja excluir?')">
                    <i class="fas fa-trash-alt"></i> Excluir
                </button>
            </form>
        </div>
    </div>
@endsection
