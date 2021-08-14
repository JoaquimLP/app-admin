<div class="col-md-6 my-1">
    <label for="qtd" class="form-label">Produto*</label>
    <select name="produto_id" id="produto_id" class="form-control @error('produto_id') is-invalid @enderror">

    </select>
    @error('produto_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="qtd" class="form-label">Quantidade (KG)*</label>
    <input type="text" class="form-control @error('qtd') is-invalid @enderror" value="{{old('qtd', $empresa->qtd ?? '')}}" name="qtd" id="qtd">
    @error('qtd')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="preco" class="form-label">Valor (KG)*</label>
    <input type="text" class="form-control dinheiro @error('preco') is-invalid @enderror" value="{{old('preco', isset($financeiro->preco) ? maskDinheiro($financeiro->preco) : '')}}" name="preco" placeholder="00,00" id="preco">
    @error('preco')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-12 my-1">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>

@push('scripts')
<script>
    $(document).ready(function($){
        $('.dinheiro').mask('#.###,00', {reverse: true});

        /* $('#empresa_id').select2({
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
        }); */
});
</script>
@endpush
