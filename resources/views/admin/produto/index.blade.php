@extends('layouts.app')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Listagem de Produto</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route("produto.index") }}">Listagem de Produto</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title  col-md-6">
                <form action="{{route('produto.search')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="filter" class="form-control" placeholder="Codigo ou nome" value="{{$filters['filter'] ?? ""}}">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="card-tools">
                <a href="{{ route("produto.create") }}"  class="btn btn-primary">Novo Produto</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produtos as $produto)
                        <tr>
                            <td>{{$produto->id}}</td>
                            <td>{{$produto->nome}}</td>
                            <td>{{$produto->descricao}}</td>
                            <td style="width: 200px">
                                <a href="{{route('produto.show', $produto->id)}}"  class="btn btn-success">Detalhes</a>
                                <a href="{{route('produto.edit', $produto->id)}}"  class="btn btn-warning">Editar</a>
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
                    {!! $produtos->appends(['filter' => request('filter')])->links()!!}
                @else
                    {!! $produtos->links()!!}
                @endif
            </div>
            {{-- {{$produtos->links()}} --}}
        </div>
    </div>

@endsection
