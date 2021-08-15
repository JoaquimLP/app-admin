<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateEstoqueRequest;
use App\Http\Resources\ProdutoResource;
use App\Models\Empresa;
use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    protected $estoque;

    public function __construct(Estoque $estoque)
    {
        $this->estoque = $estoque;
    }

    public function produto(Request $request)
    {
        $produtos = Produto::getSerchProduto($request->nome);

        return ProdutoResource::collection($produtos);
    }

    public function store(StoreUpdateEstoqueRequest $request, $id)
    {
        $data = $request->all();
        $empresa = Empresa::find($id);
        if (!$empresa) {
            dd();
            return abort(404);
        }

        $data['empresa_id'] = $empresa->id;

        if ($empresa->tipo == "cliente") {
            $data['tipo'] = 'S';
        }else if($empresa->tipo == "fornecedor"){
            $data['tipo'] = 'E';
        }
        $data['user_id'] = auth()->user()->id;
        $this->estoque->create($data);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->estoque->destroy($id);

        return redirect()->back();
    }
}
