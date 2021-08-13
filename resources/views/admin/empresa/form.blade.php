<input type="hidden" name="tipo" value="{{$tipo}}">
<div class="col-md-6 my-1">
    <label for="nome" class="form-label">Nome*</label>
    <input type="text" class="form-control @error('nome') is-invalid @enderror" value="{{old('nome', $empresa->nome ?? '')}}" name="nome" id="nome">
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-6 my-1">
    <label for="razao_social" class="form-label">Razão Social</label>
    <input type="text" class="form-control @error('razao_social') is-invalid @enderror" value="{{old('razao_social', $empresa->razao_social ?? '')}}" name="razao_social" id="razao_social">
    @error('razao_social')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="documento" class="form-label">CNPJ/CPF*</label>
    <input type="text" class="form-control cpf_cnpj @error('documento') is-invalid @enderror" value="{{old('documento', $empresa->documento ?? '')}}" name="documento" id="documento">
    @error('documento')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="ie_rg" class="form-label">IE/RG*</label>
    <input type="text" class="form-control @error('ie_rg') is-invalid @enderror" value="{{old('ie_rg', $empresa->ie_rg ?? '')}}" name="ie_rg" id="ie_rg">
    @error('ie_rg')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-6 my-1">
    <label for="nome_contato" class="form-label">Nome do responsavel*</label>
    <input type="text" class="form-control @error('nome_contato') is-invalid @enderror" value="{{old('nome_contato', $empresa->nome_contato ?? '')}}" name="nome_contato" id="nome_contato">
    @error('nome_contato')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-6 my-1">
    <label for="email" class="form-label">Email*</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email', $empresa->email ?? '')}}" name="email" id="email">
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="celular" class="form-label">Celular*</label>
    <input type="text" class="form-control @error('celular') is-invalid @enderror" value="{{old('celular', $empresa->celular ?? '')}}" name="celular" id="celular">
    @error('celular')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="telefone" class="form-label">Telefone</label>
    <input type="text" class="form-control @error('telefone') is-invalid @enderror" value="{{old('telefone', $empresa->telefone ?? '')}}" name="telefone" id="telefone">
    @error('telefone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="cep" class="form-label">CEP*</label>
    <input type="text" class="form-control @error('cep') is-invalid @enderror" value="{{old('cep', $empresa->cep ?? '')}}" name="cep" id="cep">
    @error('cep')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="estado" class="form-label">Estado*</label>
    <input type="text" class="form-control @error('estado') is-invalid @enderror" value="{{old('estado', $empresa->estado ?? '')}}" name="estado" id="estado">
    @error('estado')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="cidade" class="form-label">Cidade*</label>
    <input type="text" class="form-control @error('cidade') is-invalid @enderror" value="{{old('cidade', $empresa->cidade ?? '')}}" name="cidade" id="cidade">
    @error('cidade')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="bairro" class="form-label">Bairro*</label>
    <input type="text" class="form-control @error('bairro') is-invalid @enderror" value="{{old('bairro', $empresa->bairro ?? '')}}" name="bairro" id="bairro">
    @error('bairro')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-7 my-1">
    <label for="endereco" class="form-label">Endereço*</label>
    <input type="text" class="form-control @error('endereco') is-invalid @enderror" id="endereco" value="{{old('endereco', $empresa->endereco ?? '')}}" name="endereco">
    @error('endereco')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-2 my-1">
    <label for="numero" class="form-label">Nº*</label>
    <input type="text" class="form-control @error('numero') is-invalid @enderror" value="{{old('numero', $empresa->numero ?? '')}}" name="numero" id="numero">
    @error('numero')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-3 my-1">
    <label for="complemento" class="form-label">Complemento</label>
    <input type="text" class="form-control @error('complemento') is-invalid @enderror" value="{{old('complemento', $empresa->complemento ?? '')}}" name="complemento" id="complemento">
    @error('complemento')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-12 my-1">
    <label for="observacao" class="form-label">Observação</label>
    <input type="text" class="form-control @error('observacao') is-invalid @enderror" value="{{old('observacao', $empresa->observacao ?? '')}}" name="observacao" id="observacao">
    @error('observacao')c
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
        $(document).ready(function() {
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
            }
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');
                //Verifica se campo cep possui valor informado.
                if (cep != "") {
                        //Expressão regular para validar o CEP.
                        var validacep = /^[0-9]{8}$/;
                        //Valida o formato do CEP.
                        if(validacep.test(cep)) {
                            //Preenche os campos com "..." enquanto consulta webservice.
                            $("#endereco").val("...");
                            $("#bairro").val("...");
                            $("#cidade").val("...");
                            $("#estado").val("...");
                            //Consulta o webservice viacep.com.br/
                            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                                if (!("erro" in dados)) {
                                    //Atualiza os campos com os valores da consulta.
                                    $("#endereco").val(dados.logradouro);
                                    $("#bairro").val(dados.bairro);
                                    $("#cidade").val(dados.localidade);
                                    $("#estado").val(dados.uf);
                                } //end if.
                                else {
                                    //CEP pesquisado não foi encontrado.
                                    limpa_formulário_cep();
                                    alert("CEP não encontrado.");
                                }
                            });
                        } //end if.
                        else {
                            //cep é inválido.
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>
@endpush
