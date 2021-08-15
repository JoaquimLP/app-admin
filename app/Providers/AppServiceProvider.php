<?php

namespace App\Providers;

use App\Models\{
    Estoque,
    Financeiro
};
use App\Observers\{
    FinanceiroEstoqueObserver,
    MovimentoFinanceiro
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Estoque::observe(FinanceiroEstoqueObserver::class);
        Financeiro::observe(MovimentoFinanceiro::class);
    }
}
