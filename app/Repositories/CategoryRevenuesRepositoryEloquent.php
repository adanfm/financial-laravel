<?php

namespace CodeFin\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Models\CategoryRevenues;

/**
 * Class CategoryRevenuesRepositoryEloquent
 * @package namespace CodeFin\Repositories;
 */
class CategoryRevenuesRepositoryEloquent extends CategoryRepositoryEloquent implements CategoryRevenuesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryRevenues::class;
    }
}
