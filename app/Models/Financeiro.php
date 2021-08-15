<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao', 'preco', 'tipo', 'empresa_id', 'user_id', "status_id"
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function getFinanceiroSearch($data)
    {
        $filter = $data['filter'] ?? null;
        $inicio = $data['filterDateInicial'] ?? null;
        $fim = $data['filterDateFinal'] ?? null;

        if (empty($inicio) && empty($fim)) {
            return self::where('descricao', 'LIKE', "%{$filter}%")->with('empresa')->where('status_id', "A")->latest()->simplePaginate(15);
        }elseif(empty($filter)){
            return self::whereBetween('created_at', [formatDateAndTimeIso($inicio), formatDateAndTimeIso($fim)])->with('empresa')->where('status_id', "A")->latest()->simplePaginate(15);
        }else{
            return self::whereBetween('created_at', [formatDateAndTimeIso($inicio), formatDateAndTimeIso($fim)])->where('descricao', 'LIKE', "%{$filter}%")->with('empresa')->where('status_id', "A")->latest()->simplePaginate(15);
        }

    }

    public function saldo()
    {
        return $this->morphOne(Saldo::class, 'movimento');
    }
}
