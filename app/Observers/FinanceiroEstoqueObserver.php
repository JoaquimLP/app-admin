<?php

namespace App\Observers;

use App\Models\Estoque;
use App\Models\Saldo;
use Illuminate\Support\Facades\DB;

class FinanceiroEstoqueObserver
{
    protected $saldo;

    public function __construct(Saldo $saldo)
    {
        $this->saldo = $saldo;
    }
    public function created(Estoque $estoque)
    {
        $saldo = $this->saldo->where('empresa_id', $estoque->empresa_id)->where('status_id', "A")->latest()->first();
        $valor = $saldo->valor ?? 0;
        $estoque->saldo()->create([
            'valor' =>  $valor + ($estoque->qtd * $estoque->valor),
            'empresa_id' => $estoque->empresa_id,
            'user_id' => $estoque->user_id,
        ]);
    }

    public function deleted(Estoque $estoque)
    {

    }
}
