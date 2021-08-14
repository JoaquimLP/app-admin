<div class="col-12 mt-2 mb-4">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Adicionar um novo produto
    </a>
    <div class="collapse mt-2" id="collapseExample">
        <div class="card card-body">
            <form action="{{ route('estoque.store', $empresa->id) }}" method="POST" class="row g-3">
                @method('POST')
                @csrf
                @include('admin.empresa.estoque.form')
            </form>
        </div>
    </div>

</div>
<div class="col-12 my-2">
    <h4 class="my-1">Últimos Lançamentos</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade em KG</th>
                <th scope="col">Valor por KG</th>
                <th scope="col">Total</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($empresa->estoque as $estoque)
                <tr>
                    <td>{{$estoque->produto->nome}}</td>
                    <td>{{maskDinheiro($estoque->qtd)}}</td>
                    <td>{{maskDinheiro($estoque->valor)}}</td>
                    <td>R$ 555,50</td>
                    <td>
                        <form action="{{route('estoque.destroy', $estoque->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="tipo" value="{{$tipo}}">
                            <button class="btn btn-danger"  onclick="return confirm('Tem certeza que deseja excluir?')">
                                <i class="fas fa-trash-alt"></i> Excluir
                            </button>
                        </form>
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

@push('scripts')
    <script>
        $('#id-botao').click(function(){
            $('#div-esconder').collapse('hide');
        });
    </script>
@endpush
