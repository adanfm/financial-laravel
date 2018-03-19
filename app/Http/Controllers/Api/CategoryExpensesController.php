<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Criteria\FindRootCategoriesCriteria;
use CodeFin\Criteria\WithDepthCategoriesCriteria;
use CodeFin\Repositories\CategoryExpensesRepository;
use CodeFin\Repositories\CategoryRevenuesRepository;
use Illuminate\Http\Request;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CodeFin\Http\Requests\CategoryRequest;
use CodeFin\Repositories\CategoryRepository;

class CategoryExpensesController extends CategoriesController
{

    /**
     * @var CategoryRepository
     */
    protected $repository;

    public function __construct(CategoryExpensesRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria(new WithDepthCategoriesCriteria());
    }
}
