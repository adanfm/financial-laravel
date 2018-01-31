<?php

namespace CodeFin\Presenters;

use CodeFin\Transformers\BillPaysTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BillPaysPresenter
 *
 * @package namespace CodeFin\Presenters;
 */
class BillPaysPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BillPaysTransformer();
    }
}
