<?php

namespace App\Models;

use App\Http\Resources\ProdutoResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo', 'qtd', 'valor', 'status_id', 'empresa_id', 'produto_id', 'user_id'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function saldo()
    {
        return $this->morphOne(Saldo::class, 'movimento');
    }
}
