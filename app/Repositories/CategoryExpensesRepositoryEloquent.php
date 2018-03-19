<?php

namespace CodeFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Repositories\CategoryExpensesRepository;
use CodeFin\Models\CategoryExpenses;
use CodeFin\Validators\CategoryExpensesValidator;

/**
 * Class CategoryExpensesRepositoryEloquent
 * @package namespace CodeFin\Repositories;
 */
class CategoryExpensesRepositoryEloquent extends CategoryRepositoryEloquent implements CategoryExpensesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryExpenses::class;
    }

}
