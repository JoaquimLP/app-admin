<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo', 'nome', 'razao_social', 'documento', 'ie_rg', 'nome_contato', 'celular', 'telefone', 'email', 'endereco',
        'bairro', 'cidade', 'estado', 'cep', 'numero', 'complemento', 'observacao', 'status_id'
    ];

    public static function getTipo($tipo = null)
    {
        return self::where('tipo', $tipo)->where('status_id', "A")->latest()->simplePaginate(15);
    }

    public static function getClient($id)
    {
        return self::where('id', $id)->where('status_id', "A")
            ->with(['estoque' => function ($query){
                $query->where('status_id', "A")->latest()->take(5);
            },
            'estoque.produto'])->first();
    }

    public function estoque()
    {
        return $this->hasMany(Estoque::class);
    }

    public static function getSerchTipo($tipo = null, $nome = null)
    {
        return self::where('tipo', $tipo)->where('nome', 'LIKE', "%{$nome}%")->where('status_id', "A")->latest()->get();
    }

}
