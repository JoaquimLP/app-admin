@extends('layouts.app')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Listagem de Usuario</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route("usuario.index") }}">Listagem de Usuario</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title  col-md-6">
                <form action="{{route('usuario.search')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="filter" class="form-control" placeholder="Codigo ou nome" value="{{$filters['filter'] ?? ""}}">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="card-tools">
                <a href="{{ route("usuario.create") }}"  class="btn btn-primary">Novo Usuario</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->id}}</td>
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->email}}</td>
                            <td style="width: 200px">
                                <a href="{{route('usuario.show', $usuario->id)}}"  class="btn btn-success">Detalhes</a>
                                <a href="{{route('usuario.edit', $usuario->id)}}"  class="btn btn-warning">Editar</a>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td>#</td>
                        <td>#</td>
                        <td>Nenhum registro cadastrado</td>
                        <td>#</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="card-footer">
                @if (isset($filters))
                    {!! $usuarios->appends(['filter' => request('filter')])->links()!!}
                @else
                    {!! $usuarios->links()!!}
                @endif
            </div>
            {{-- {{$usuarios->links()}} --}}
        </div>
    </div>

@endsection
