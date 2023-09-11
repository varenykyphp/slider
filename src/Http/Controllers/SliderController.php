<?php

namespace VarenykySlider\Http\Controllers;

use VarenykySlider\Repositories\SliderRepository;
use Varenyky\Http\Controllers\BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use VarenykySlider\Models\Slider\Slider;
use VarenykySlider\Models\Slider\SliderItem;

class SliderController extends BaseController
{
    public function __construct(SliderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $sliders = $this->repository->getAllPaginated();

        return view('VarenykySlider::sliders.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('VarenykySlider::sliders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $create = $request->except(['_token']);

        $sliders = $this->repository->create($create);

        return redirect()->route('admin.sliders.index')->with('success', __('VarenykySlider::labels.added'));
    }

    public function edit(Slider $slider): View
    {
        return view('VarenykySlider::sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($slider->id, $update);

        return redirect()->route('admin.sliders.edit', $slider->id)->with('success', __('VarenykySlider::labels.updated'));
    }

    public function destroy(Slider $slider): RedirectResponse
    {
        $sliderItem = SliderItem::where('slider_id',$slider->id)->get();
        foreach( $sliderItem  as $item){
            $item->delete();
        }
        
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('error', __('VarenykySlider::labels.deleted'));
    }
}
