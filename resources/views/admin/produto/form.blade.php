<div class="col-md-6 my-1">
    <label for="nome" class="form-label">Nome*</label>
    <input type="text" class="form-control @error('nome') is-invalid @enderror" value="{{old('nome', $produto->nome ?? '')}}" name="nome" id="nome">
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-6 my-1">
    <label for="razao_social" class="form-label">Descrição</label>
    <textarea name="descricao"  class="form-control @error('razao_social') is-invalid @enderror" id="descricao" cols="30" rows="3">{{old('descricao', $produto->descricao ?? '')}}</textarea>
    @error('descricao')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-12 my-1">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
