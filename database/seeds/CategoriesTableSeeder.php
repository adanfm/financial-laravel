<?php

class CategoriesTableSeeder extends \Illuminate\Database\Seeder
{
    use \CodeFin\Repositories\GetClientsTrait;

    public function run()
    {
        $clients = $this->getClients();

        factory(\CodeFin\Models\CategoryRevenues::class, 30)
            ->make()
            ->each(function ($category) use($clients){
                $client = $clients->random();

                $category->client_id = $client->id;
                $category->save();
            })
        ;

        $categoriesRoot = $this->getCategoriesRevenuesRoot();

        foreach ($categoriesRoot as $root) {
            factory(\CodeFin\Models\CategoryRevenues::class, 3)
                ->make()
                ->each(function ($child) use($root){
                    $child->client_id = $root->client_id;
                    $child->save();

                    $child->parent()->associate($root);
                    $child->save();
                })
            ;
        }

        factory(\CodeFin\Models\CategoryExpenses::class, 30)
            ->make()
            ->each(function ($category) use($clients){
                $client = $clients->random();

                $category->client_id = $client->id;
                $category->save();
            })
        ;

        $categoriesRoot = $this->getCategoriesExpensesRoot();

        foreach ($categoriesRoot as $root) {
            factory(\CodeFin\Models\CategoryExpenses::class, 3)
                ->make()
                ->each(function ($child) use($root){
                    $child->client_id = $root->client_id;
                    $child->save();

                    $child->parent()->associate($root);
                    $child->save();
                })
            ;
        }
    }

    private function getCategoriesExpensesRoot()
    {
        /** @var \CodeFin\Repositories\CategoryExpensesRepository */
        $repository = app(\CodeFin\Repositories\CategoryExpensesRepository::class);
        $repository->skipPresenter(true);
        return $repository->all();
    }

    private function getCategoriesRevenuesRoot()
    {
        /** @var \CodeFin\Repositories\CategoryRevenuesRepository */
        $repository = app(\CodeFin\Repositories\CategoryRevenuesRepository::class);
        $repository->skipPresenter(true);
        return $repository->all();
    }
}