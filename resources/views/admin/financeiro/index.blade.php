@extends('layouts.app')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Lista de movimentação</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route("financeiro.index") }}">Lista de movimentação</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title row col-md-10">
                <form class="row col-md-12" action="{{route('financeiro.search')}}" method="post">
                    @csrf
                    <div class="input-group mb-3 col-md-5">
                        <input type="text" name="filter" class="form-control" placeholder="Descrição" value="{{$filters['filter'] ?? ""}}">
                    </div>
                    <div class="input-group mb-3 col-md-3">
                        <input type="text" name="filterDateInicial" class="form-control data" placeholder="Data inicial" value="{{$filters['filterDateInicial'] ?? ""}}">
                    </div>
                    <div class="input-group mb-3 col-md-3">
                        <input type="text" name="filterDateFinal" class="form-control data" placeholder="Data Final" value="{{$filters['filterDateFinal'] ?? ""}}">
                    </div>
                    <div class="input-group mb-3 col-md-1">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="card-tools">
                <a href="{{ route("financeiro.create") }}"  class="btn btn-primary">Novo Lançamento</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Tipo</th>
                        <th>Empresa</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($financeiros as $financeiro)
                        <tr>
                            <td>{{$financeiro->id}}</td>
                            <td><span class="badge badge-{{$financeiro->tipo == 'E' ? 'success' : 'danger'}}">{{tipo($financeiro->tipo)}}</span></td>
                            <td>{{$financeiro->empresa->nome}}</td>
                            <td>{{$financeiro->descricao}}</td>
                            <td>R$ {{maskDinheiro($financeiro->preco)}}</td>
                            <td>{{formatDateAndTime($financeiro->created_at)}}</td>
                            <td style="width: 200px">
                                <a href="{{route('financeiro.show', $financeiro->id)}}"  class="btn btn-success">Detalhes</a>
                                {{-- <a href="{{route('financeiro.edit', $financeiro->id)}}"  class="btn btn-warning">Editar</a> --}}
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
                    {!! $financeiros->appends(['filter' => request('filter'), 'filterDateInicial' => request('filterDateInicial'), 'filterDateFinal' => request('filterDateFinal')])->links()!!}
                @else
                    {!! $financeiros->links()!!}
                @endif
            </div>
            {{-- {{$financeiros->links()}} --}}
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function($){
        $('.data').mask('00/00/0000');
    });
</script>
@endpush
