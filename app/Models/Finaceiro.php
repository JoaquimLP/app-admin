<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finaceiro extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao', 'preco', 'data_pagamento', 'tipo', 'empresa_id', 'user_id'
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
            return self::where('descricao', 'LIKE', "%{$filter}%")->with('empresa')->latest()->simplePaginate(15);
        }elseif(empty($filter)){
            return self::whereBetween('data_pagamento', [formatDateAndTimeIso($inicio), formatDateAndTimeIso($fim)])->with('empresa')->latest()->simplePaginate(15);
        }else{
            return self::whereBetween('data_pagamento', [formatDateAndTimeIso($inicio), formatDateAndTimeIso($fim)])->where('descricao', 'LIKE', "%{$filter}%")->with('empresa')->latest()->simplePaginate(15);
        }

    }
}
