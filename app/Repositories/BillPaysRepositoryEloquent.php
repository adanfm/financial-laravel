<?php

namespace CodeFin\Repositories;

use CodeFin\Presenters\BillPaysPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Repositories\BillPaysRepository;
use CodeFin\Models\BillPays;
use CodeFin\Validators\BillPaysValidator;

/**
 * Class BillPaysRepositoryEloquent
 * @package namespace CodeFin\Repositories;
 */
class BillPaysRepositoryEloquent extends BaseRepository implements BillPaysRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BillPays::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return BillPaysPresenter::class;
    }
}
