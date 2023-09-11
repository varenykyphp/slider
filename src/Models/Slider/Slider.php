<?php

namespace VarenykySlider\Models\Slider;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function items()
    {
        return $this->hasMany(SliderItem::class, 'slider_id', 'id');
    }
}