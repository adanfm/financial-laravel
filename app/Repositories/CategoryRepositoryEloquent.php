<?php

namespace CodeFin\Repositories;

use CodeFin\Presenters\CategoryPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Repositories\CategoryRepository;
use CodeFin\Models\Category;
use CodeFin\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodeFin\Repositories;
 */
abstract class CategoryRepositoryEloquent extends BaseRepository
{
    public function presenter()
    {
        return CategoryPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {
        Category::$enabledTenant = false;
        if (isset($attributes['parent_id'])) {
            $skipPresenter = $this->skipPresenter;
            $this->skipPresenter(true);
            $parent = $this->find($attributes['parent_id']);
            $this->skipPresenter = $skipPresenter;
            $child = $parent->children()->create($attributes);
            $result =  $this->parserResult($child);
        } else {
            $result =  parent::create($attributes);
        }

        Category::$enabledTenant = true;
        return $result;
    }

    public function update(array $attributes, $id)
    {
        Category::$enabledTenant = false;

        if (isset($attributes['parent_id'])) {
            $skipPresenter = $this->skipPresenter;
            $this->skipPresenter(true);

            $child = parent::update($attributes, $id);
            $child->parent_id = $attributes['parent_id'];
            $child->fill($attributes);
            $child->save();
            $this->skipPresenter = $skipPresenter;
            $result = $this->parserResult($child);
        } else {
            $result =  parent::update($attributes, $id);
            $result->makeRoot()->save();
        }

        Category::$enabledTenant = true;
        return $result;
    }


}
