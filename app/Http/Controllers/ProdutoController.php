<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function index()
    {
        $produtos = $this->produto->getProdutoAll();

        return view('admin.produto.index', compact('produtos'));
    }

    public function create()
    {
        return view('admin.produto.create');
    }


    public function store(StoreUpdateProdutoRequest $request)
    {
        $data = $request->all();

        $this->produto->create($data);

        return redirect()->route("produto.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = $this->produto->getProduto($id);

        if (!$produto) {
            return redirect()->route("produto.index");
        }

        return view('admin.produto.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = $this->produto->getProduto($id);

        if (!$produto) {
            return redirect()->route("produto.index");
        }

        return view('admin.produto.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProdutoRequest $request, $id)
    {
        $data = $request->all();
        $produto = $this->produto->getProduto($id);
        $produto->update($data);

        return redirect()->route("produto.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = $this->produto->getProduto($id);

        if (!$produto) {
            return redirect()->route("produto.index");
        }

        $produto->update([
            "status_id" => "I",
        ]);

        return redirect()->route("produto.index");

    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');
        $produtos = $this->produto->getProdutoSearch($request->filter);
        //dd($filters);

        return view('admin.produto.index', compact('produtos', 'filters'));
    }
}
