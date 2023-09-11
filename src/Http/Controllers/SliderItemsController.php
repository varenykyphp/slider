<?php

namespace VarenykySlider\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Varenyky\Http\Controllers\BaseController;
use VarenykySlider\Models\Slider\SliderItem;
use VarenykySlider\Repositories\SliderItemRepository;

class SliderItemsController extends BaseController
{
    public function __construct(SliderItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(int $id): View
    {
        $sliderItems = SliderItem::where('slider_id',$id)->get();
        $sliderId = $id;

        return view('VarenykySlider::sliders.items.index', compact('sliderItems','sliderId'));
    }

    public function create(int $id): View
    {
        $sliderItems = SliderItem::where('slider_id',$id)->get();
        $sliderId = $id;

        return view('VarenykySlider::sliders.items.create',compact('sliderId', 'sliderItems'));

    }

    public function store(Request $request,int $id): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ]);
        
        $create = $request->except(['_token']);
        $create['slider_id'] = $id;

        if ($request->image !== null) {
            $file = $request->image;
            $filename = date('Y_m_d_His').'_'.str_replace(' ', '', $file->getClientOriginalName());
            $file->move(public_path('images/sliders/'), $filename);
            unset($create['image']);
            $create['image'] = '/images/sliders/' .$filename;
        }

        $sliderItems = $this->repository->create($create);

        return redirect()->route('admin.items.index',$id)->with('success', __('VarenykySlider::labels.added'));
    }

    public function edit(int $id, SliderItem $item): View
    {

        $sliderItems = SliderItem::where('slider_id',$id)->get();

        return view('VarenykySlider::sliders.items.edit', compact('item','id', 'sliderItems'));

    }

    public function update(Request $request,int $id, SliderItem $item): RedirectResponse
    {
        if(!$item->image){
            $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ]);
        }
        
        $update = array_filter($request->except(['_token', '_method','image']));

        if ($request->image !== null) {
            $file = $request->image;
            $filename = date('Y_m_d_His').'_'.str_replace(' ', '', $file->getClientOriginalName());
            $file->move(public_path('images/sliders/'), $filename);
            unset($update['image']);
            $update['image'] = '/images/sliders/' .$filename;
        }
        $this->repository->update($item->id, $update);

        return redirect()->route('admin.items.edit',[$id,$item])->with('success', __('VarenykySlider::labels.updated'));
    }

    public function destroy(int $id,SliderItem $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('admin.items.index',$id)->with('error', __('VarenykySlider::labels.deleted'));
    }
}
