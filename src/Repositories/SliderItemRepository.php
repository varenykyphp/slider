<?php

namespace VarenykySlider\Repositories;

use VarenykySlider\Models\Slider\SliderItem;
use Varenyky\Repositories\Repository;

class SliderItemRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     */
    public function __construct(SliderItem $model)
    {
        $this->model = $model;
    }
}
