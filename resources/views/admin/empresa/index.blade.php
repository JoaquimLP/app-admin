@extends('layouts.app')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{-- <h1 class="m-0">Dashboard</h1> --}}
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route("empresa.$tipo.index") }}?tipo={{$tipo}}">Listagem de {{$tipo}}</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Listagem de {{$tipo}}</h2>
            <div class="card-tools">
                <a href="{{ route("empresa.$tipo.create") }}?tipo={{$tipo}}"  class="btn btn-primary">Novo {{$tipo}}</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nome Empresa</th>
                        <th>Responsavel</th>
                        <th>Celular</th>
                        <th style="width: 40px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empresas as $empresa)
                        <tr>
                            <td>{{$empresa->id}}</td>
                            <td>{{$empresa->nome}}</td>
                            <td>{{$empresa->nome_contato}}</td>
                            <td class="celular">{{$empresa->celular}}</td>
                            <td style="width: 200px">
                                <a href="{{route('empresa.show', $empresa->id)}}?tipo={{$tipo}}"  class="btn btn-success">Detalhes</a>
                                <a href="{{route('empresa.edit', $empresa->id)}}?tipo={{$tipo}}"  class="btn btn-warning">Editar</a>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Nenhum registro cadastrado</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{$empresas->appends(['tipo' => request('tipo')])->links()}}
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.celular').mask('(00) 0 0000-0000');
        });
    </script>
@endpush
