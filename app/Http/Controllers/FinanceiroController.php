<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateFinanceiroRequest;
use App\Http\Resources\EmpresaResource;
use App\Models\Empresa;
use App\Models\Financeiro;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceiroController extends Controller
{
    protected $financeiro, $saldo;

    public function __construct(Financeiro $financeiro, Saldo $saldo)
    {
        $this->financeiro = $financeiro;
        $this->saldo = $saldo;
    }

    public function index()
    {
        $financeiros = $this->financeiro->with('empresa')->where('status_id', "A")->latest()->simplePaginate();

        return view('admin.financeiro.index', compact('financeiros'));
    }

    public function create()
    {
        $empresas = Empresa::all();
        return view('admin.financeiro.create', compact('empresas'));
    }

    public function store(StoreUpdateFinanceiroRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $this->financeiro->create($data);

        return redirect()->route("financeiro.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $financeiro = $this->financeiro->where('status_id', "A")->find($id);

        if (!$financeiro) {
            return redirect()->route("financeiro.index");
        }

        return view('admin.financeiro.show', compact('financeiro'));
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $financeiro = $this->financeiro->where('status_id', "A")->find($id);
        $empresas = Empresa::all();
        if (!$financeiro) {
            return redirect()->route("financeiro.index");
        }

        return view('admin.financeiro.edit', compact('financeiro', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateFinanceiroRequest $request, $id)
    {
        $data = $request->all();
        $financeiro = $this->financeiro->find($id);
        $financeiro->update($data);

        return redirect()->route("financeiro.index");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $financeiro = $this->financeiro->find($id);

        if (!$financeiro) {
            return redirect()->route("financeiro.index");
        }

        // Atualiza as informações no saldo, apenas inativa o saldo selecionado
        $saldoDelete = $financeiro->saldo;
        $valorMovimento = $financeiro->preco ?? 0;
        $this->saldo->where('created_at', '>', $saldoDelete->created_at)->where('status_id', "A")
            ->update([
                'valor' => DB::raw("valor + $valorMovimento"),
            ]);

        $saldoDelete->update([
                "status_id" => "I",
            ]);

        $financeiro->update([
            "status_id" => "I",
        ]);

        return redirect()->route("financeiro.index");

    }

    public function search(Request $request)
    {
        $filters = $request->all();
        $data = $request->all();
        $financeiros = $this->financeiro->getFinanceiroSearch($data);
        //dd($filters);

        return view('admin.financeiro.index', compact('financeiros', 'filters'));
    }

    public function empresa(Request $request)
    {
        if ($request->tipo == "S") {
            $tipo = 'fornecedor';
        }else if($request->tipo == "E"){
            $tipo = 'cliente';
        }

        $empresas = Empresa::getSerchTipo($tipo, $request->nome);

        return EmpresaResource::collection($empresas);
    }
}
