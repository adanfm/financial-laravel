<?php

namespace CodeFin\Transformers;

use League\Fractal\TransformerAbstract;
use CodeFin\Models\BillReceive;

/**
 * Class BillReceiveTransformer
 * @package namespace CodeFin\Transformers;
 */
class BillReceiveTransformer extends TransformerAbstract
{

    /**
     * Transform the BillReceive entity
     * @param CodeFin\Models\BillReceive $model
     *
     * @return array
     */
    public function transform(BillReceive $model)
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
