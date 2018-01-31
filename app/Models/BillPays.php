<?php

namespace CodeFin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BillPays extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'date_due',
        'value',
        'done'
    ];

}
