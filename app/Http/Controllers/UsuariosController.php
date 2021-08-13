<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUsuarioRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    protected $usuario;

    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
    }


    public function index()
    {
        $usuarios = User::getUserAll();

        return view('admin.usuario.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuario.create');
    }

    public function store(StoreUpdateUsuarioRequest $request)
    {

        $data = $request->all();

        $this->usuario->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route("usuario.index");
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = $this->usuario->getUser($id);

        if (!$usuario) {
            return redirect()->route("usuario.index");
        }

        return view('admin.usuario.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = $this->usuario->getUser($id);

        if (!$usuario) {
            return redirect()->route("usuario.index");
        }

        return view('admin.usuario.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUsuarioRequest $request, $id)
    {
        $data = $request->all();
        $usuario = $this->usuario->getUser($id);
        $data = $request->only(['name', 'email']);


        if (!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }
        $usuario->update($data);

        return redirect()->route("usuario.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = $this->usuario->getUser($id);

        if (!$usuario) {
            return redirect()->route("usuario.index");
        }

        $usuario->update([
            "status_id" => "I",
        ]);

        return redirect()->route("usuario.index");

    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');
        $usuarios = $this->usuario->getUserSearch($request->filter);
        //dd($filters);

        return view('admin.usuario.index', compact('usuarios', 'filters'));
    }
}
