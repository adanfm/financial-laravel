<?php

namespace CodeFin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BillReceive
 * @package CodeFin\Models
 * @author Adan Felipe Medeiros <adan.grg@gmail.com>
 */
class BillReceive extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'date_due',
        'value',
        'done'
    ];
}
