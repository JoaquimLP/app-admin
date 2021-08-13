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
                <li class="breadcrumb-item"><a href="{{ route("empresa.$tipo.create") }}?tipo={{$tipo}}">Editar dados do {{$tipo}}</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Editar dados do {{$tipo}}</h2>
        </div>
        <div class="card-body">
            <form action="{{route('empresa.update', $empresa->id)}}" method="POST" class="row g-3">
                @method('PUT')
                @csrf
                @include('admin.empresa.form')
            </form>
        </div>
    </div>
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#cep').mask('00000-000');
            $('#telefone').mask('(00) 0000-0000');
            $('#celular').mask('(00) 0 0000-0000');

            var field = '.cpf_cnpj';

            $(field).keydown(function(){
                try {
                    $(field).unmask();
                } catch (e) {}

                var tamanho = $(field).val().length;

                if(tamanho < 11){
                    $(field).mask("999.999.999-99");
                } else {
                    $(field).mask("99.999.999/9999-99");
                }

                // ajustando foco
                var elem = this;
                setTimeout(function(){
                    // mudo a posição do seletor
                    elem.selectionStart = elem.selectionEnd = 10000;
                }, 0);
                // reaplico o valor para mudar o foco
                var currentValue = $(this).val();
                $(this).val('');
                $(this).val(currentValue);
            });
        });
    </script>
@endpush
@endsection
