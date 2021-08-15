<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateEstoqueRequest;
use App\Http\Resources\ProdutoResource;
use App\Models\Empresa;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstoqueController extends Controller
{
    protected $estoque, $saldo;

    public function __construct(Estoque $estoque, Saldo $saldo)
    {
        $this->estoque = $estoque;
        $this->saldo = $saldo;
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
        $estoque = $this->estoque->find($id);

        // Atualiza as informações no saldo, apenas inativa o saldo selecionado
        $saldoDelete = $estoque->saldo;
        $valorMovimento = $estoque->qtd * $estoque->valor;
        $this->saldo->where('created_at', '>', $saldoDelete->created_at)->where('status_id', "A")
            ->update([
                'valor' => DB::raw("valor - $valorMovimento"),
            ]);

        $saldoDelete->update([
                "status_id" => "I",
            ]);

        $estoque->update([
            "status_id" => "I",
        ]);

        return redirect()->back();
    }
}
