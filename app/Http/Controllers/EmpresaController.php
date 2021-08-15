<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateEmpresaRequest;
use App\Models\Empresa;
use App\Models\Saldo;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    private $empresa;
    private $saldo;

    public function __construct(Empresa $empresa, Saldo $saldo)
    {
        $this->empresa = $empresa;
        $this->saldo = $saldo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipo = $request->tipo;

        if ($tipo != 'cliente' && $tipo != 'fornecedor') {
            return abort(404);
        }

        $empresas = Empresa::getTipo($tipo);
        return view('admin.empresa.index', compact('empresas', 'tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tipo = $request->tipo;

        if ($tipo != 'cliente' && $tipo != 'fornecedor') {
            return abort(404);
        }

        return view('admin.empresa.create', compact('tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateEmpresaRequest $request)
    {
        $data = $request->all();

        $this->empresa->create($data);
        $tipo = $request->tipo;


        return redirect()->route("empresa.$tipo.index", ["tipo" => $tipo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $empresa = $this->empresa->getClient($id);
        $tipo = $request->tipo;

        if ($tipo != 'cliente' && $tipo != 'fornecedor') {
            return abort(404);
        }

        if (!$empresa) {
            return redirect()->route("empresa.$tipo.index", ["tipo" => $tipo]);
        }

        $saldo = $this->saldo->where('empresa_id', $empresa->id)->where('status_id', "A")->latest()->first();
        $tipo = $empresa->tipo;
        return view('admin.empresa.show', compact('empresa', 'tipo', 'saldo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $empresa = $this->empresa->getClient($id);
        $tipo = $request->tipo;

        if ($tipo != 'cliente' && $tipo != 'fornecedor') {
            return abort(404);
        }

        if (!$empresa) {
            return redirect()->route("empresa.$tipo.index", ["tipo" => $tipo]);
        }

        return view('admin.empresa.edit', compact('empresa', 'tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateEmpresaRequest $request, $id)
    {
        $data = $request->all();
        $empresa = $this->empresa->getClient($id);
        $empresa->update($data);
        $tipo = $request->tipo;


        return redirect()->route("empresa.$tipo.index", ["tipo" => $tipo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $empresa = $this->empresa->getClient($id);
        $tipo = $empresa->tipo;

        if ($tipo != 'cliente' && $tipo != 'fornecedor') {
            return abort(404);
        }

        if (!$empresa) {
            return redirect()->route("empresa.$tipo.index", ["tipo" => $tipo]);
        }

        $empresa->update([
            "status_id" => "I",
        ]);

        return redirect()->route("empresa.$tipo.index", ["tipo" => $tipo]);

    }
}
