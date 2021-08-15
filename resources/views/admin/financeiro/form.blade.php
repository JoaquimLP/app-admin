<div class="col-md-12 my-1">
    <label for="descricao" class="form-label">Descrição*</label>
    <input type="text" class="form-control @error('descricao') is-invalid @enderror" value="{{old('descricao', $financeiro->descricao ?? '')}}" name="descricao" id="descricao">
    @error('descricao')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="preco" class="form-label">Valor*</label>
    <input type="text" class="form-control dinheiro @error('preco') is-invalid @enderror" value="{{old('preco', isset($financeiro->preco) ? maskDinheiro($financeiro->preco) : '')}}" name="preco" placeholder="00,00" id="preco">
    @error('preco')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
{{-- <div class="col-md-3 my-1">
    <label for="data_pagamento" class="form-label">Data*</label>
    <input type="text" class="form-control date @error('data_pagamento') is-invalid @enderror" value="{{old('data_pagamento', isset($financeiro->data_pagamento) ? formatDateAndTime($financeiro->data_pagamento) : '')}}" placeholder="00/00/0000" name="data_pagamento" id="data_pagamento">
    @error('data_pagamento')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}
<div class="col-md-3 my-1">
    <label for="tipo" class="form-label">Tipo de movimentação*</label>
    <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror">
        <option value="E"  @if(old('tipo', !empty($financeiro->tipo) ? $financeiro->tipo : '') == "E") selected="" @endif>Entrada</option>
        <option value="S"  @if(old('tipo', !empty($financeiro->tipo) ? $financeiro->tipo : '') == "S") selected="" @endif>Saida</option>
    </select>
    @error('tipo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-6 my-1">
    <label for="empresa_id" class="form-label">Empresa*</label>
    <select name="empresa_id" id="empresa_id" class="form-control @error('empresa_id') is-invalid @enderror">
        @if (isset($financeiro->empresa_id))
            <option value="{{$financeiro->empresa_id}}">{{$financeiro->empresa->nome}}</option>
        @endif
    </select>
    @error('empresa_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-12 my-1">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
@push('scripts')
<script>
    $(document).ready(function($){
        $('.dinheiro').mask('#.###,00', {reverse: true});
        $('.date').mask('00/00/0000');

        $('#empresa_id').select2({
            ajax: {
                type: 'post',
                url: '{{ route("financeiro.empresa") }}',
                dataType: "json",
                delay: 250,
                data: function (params) {
                    var query = {
                        nome: params.term,
                        type: 'public',
                        tipo: $('[name=tipo]').val(),
                    }
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    console.log(data.data);
                    return {
                        results: data.data
                    };
                },
            }
        });
});
</script>
@endpush
