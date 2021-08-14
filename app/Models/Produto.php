<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'descricao', "status_id"
    ];


    public static function getProdutoAll()
    {
        return self::where('status_id', "A")->simplePaginate(15);
    }

    public static function getProduto($id)
    {
        return self::where('id', $id)->where('status_id', "A")->first();
    }

    public static function getProdutoSearch($filter = null)
    {
        return self::where('id', $filter )->orWhere('nome', 'LIKE', "%{$filter}%")->where('status_id', "A")->simplePaginate(15);
    }

    public static function getSerchProduto($nome = null)
    {
        return self::where('nome', 'LIKE', "%{$nome}%")->where('status_id', "A")->get();
    }
}
