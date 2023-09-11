<?php

namespace VarenykySlider\Models\Slider;

use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    protected $table = 'slider_items';

    protected $fillable = [
        'slider_id',
        'image',
        'content'
    ];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}
