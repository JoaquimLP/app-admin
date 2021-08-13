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
                <li class="breadcrumb-item"><a href="{{ route("empresa.show", $empresa->id) }}?tipo={{$tipo}}">Dados do {{$tipo}}</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"> <i class="fas fa-globe"></i> {{$empresa->nome}}</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <p><strong>Razão Social</strong>: {{$empresa->razao_social}}</p>
                    <p><strong>CNPJ|CPF</strong>: <span id="cpf_cnpj">{{maskCnpj($empresa->documento)}}</span></p>
                    <p><strong>IE/RG</strong>: {{$empresa->ie_rg}}</p>
                    <p><strong>Observação</strong>: {{$empresa->observacao}}</p>
                </div>
                <div class="col-sm-6">
                    <address>
                        {{$empresa->endereco}}, {{$empresa->bairro}} <br>
                        {{$empresa->cidade}}, {{$empresa->estado}}, {{maskCep($empresa->cep)}} <br>
                        <strong>Celular</strong>: {{maskTelCel($empresa->celular)}} | <strong>Telefone</strong>: {{maskTelCel($empresa->telefone)}}<br>
                        <strong>E-mail</strong>: {{$empresa->email}}
                    </address>
                </div>
            </div>
        </div>
        <div class="card-footer clearfix">
            <form action="{{route('empresa.destroy', $empresa->id)}}" method="post">
                @method('DELETE')
                @csrf
                <input type="hidden" name="tipo" value="{{$tipo}}">
                <button class="btn btn-danger"  onclick="return confirm('Tem certeza que deseja excluir?')">
                    <i class="fas fa-trash-alt"></i> Excluir
                </button>
            </form>
        </div>
    </div>
@endsection