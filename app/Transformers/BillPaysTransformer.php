<?php

namespace CodeFin\Transformers;

use League\Fractal\TransformerAbstract;
use CodeFin\Models\BillPays;

/**
 * Class BillPaysTransformer
 * @package namespace CodeFin\Transformers;
 */
class BillPaysTransformer extends TransformerAbstract
{

    /**
     * Transform the BillPays entity
     * @param CodeFin\Models\BillPays $model
     *
     * @return array
     */
    public function transform(BillPays $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'date_due'   => (new \DateTime($model->date_due))->format('d/m/Y'),
            'value'      => $model->value,
            'done'       => (boolean) $model->done,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
