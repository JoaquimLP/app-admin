<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateFinanceiroRequest;
use App\Http\Resources\EmpresaResource;
use App\Models\Empresa;
use App\Models\Finaceiro;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    protected $financeiro;

    public function __construct(Finaceiro $financeiro)
    {
        $this->financeiro = $financeiro;
    }

    public function index()
    {
        $financeiros = $this->financeiro->with('empresa')->simplePaginate();

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
        $financeiro = $this->financeiro->find($id);

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
        $financeiro = $this->financeiro->find($id);
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
