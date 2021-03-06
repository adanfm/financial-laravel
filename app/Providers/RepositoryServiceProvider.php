<?php

namespace CodeFin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\CodeFin\Repositories\BankRepository::class, \CodeFin\Repositories\BankRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\BankAccountRepository::class, \CodeFin\Repositories\BankAccountRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\BillReceiveRepository::class, \CodeFin\Repositories\BillReceiveRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\BillPaysRepository::class, \CodeFin\Repositories\BillPaysRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\ClientRepository::class, \CodeFin\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\CategoryRepository::class, \CodeFin\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\CategoryExpensesRepository::class, \CodeFin\Repositories\CategoryExpensesRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\CategoryRevenuesRepository::class, \CodeFin\Repositories\CategoryRevenuesRepositoryEloquent::class);
        //:end-bindings:
    }
}
