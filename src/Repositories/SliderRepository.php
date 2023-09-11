<?php

namespace VarenykySlider\Repositories;

use VarenykySlider\Models\Slider\Slider;
use Varenyky\Repositories\Repository;

class SliderRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     */
    public function __construct(Slider $model)
    {
        $this->model = $model;
    }
}
