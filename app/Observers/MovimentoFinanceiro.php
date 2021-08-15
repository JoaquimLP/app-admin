<?php

namespace App\Observers;

use App\Models\Financeiro;
use App\Models\Saldo;

class MovimentoFinanceiro
{
    protected $saldo;

    public function __construct(Saldo $saldo)
    {
        $this->saldo = $saldo;
    }

    /**
     * Handle the Financeiro "created" event.
     *
     * @param  \App\Models\Financeiro  $financeiro
     * @return void
     */
    public function created(Financeiro $financeiro)
    {
        $saldo = $this->saldo->where('empresa_id', $financeiro->empresa_id)->where('status_id', "A")->latest()->first();
        $valor = $saldo->valor ?? 0;
        $financeiro->saldo()->create([
            'valor' =>  $valor - $financeiro->preco,
            'empresa_id' => $financeiro->empresa_id,
            'user_id' => $financeiro->user_id,
        ]);
    }

    /**
     * Handle the Financeiro "updated" event.
     *
     * @param  \App\Models\Financeiro  $financeiro
     * @return void
     */
    public function updated(Financeiro $financeiro)
    {
    }

    /**
     * Handle the Financeiro "deleted" event.
     *
     * @param  \App\Models\Financeiro  $financeiro
     * @return void
     */
    public function deleted(Financeiro $financeiro)
    {
        //
    }

    /**
     * Handle the Financeiro "restored" event.
     *
     * @param  \App\Models\Financeiro  $financeiro
     * @return void
     */
    public function restored(Financeiro $financeiro)
    {
        //
    }

    /**
     * Handle the Financeiro "force deleted" event.
     *
     * @param  \App\Models\Financeiro  $financeiro
     * @return void
     */
    public function forceDeleted(Financeiro $financeiro)
    {
        //
    }
}
