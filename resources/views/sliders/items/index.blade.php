@extends('varenykyAdmin::app')

@section('title', __('VarenykySlider::admin.sliderItems.index.title'))

@section('content_header')
    <strong>{{ __('VarenykySlider::admin.sliderItems.index.title') }}</strong>
@stop

@section('create-btn', route('admin.items.create', $sliderId))
@section('back-btn', route('admin.sliders.index'))

@section('content')
<div class="card border p-3">
    <table class="table table-striped">
        <thead>
            <tr class="table-dark">
                <th>{{ __('VarenykySlider::labels.image') }}</th>
                <th>{{ __('VarenykySlider::labels.name') }}</th>
                <th>{{ __('VarenykySlider::labels.content') }}</th>
                <th width="350"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sliderItems as $sliderItem)
                <tr>
                    <td><img src="{{ $sliderItem->image }}" alt="image" style="width: 150px;"></td>
                    <td>{{ $sliderItem->slider->name }}</td>
                    <td>{{ $sliderItem->content }}</td>
                    <td align="right">
                        <a href="{{ route( "admin.items.edit", [$sliderId, $sliderItem]) }}" class="btn btn-sm btn-dark me-1">
                        <i class="fas fa-pencil me-2"></i>{{ __('VarenykySlider::labels.edit') }}
                        </a>
                        <form action="{{ route(  "admin.items.destroy", [$sliderId, $sliderItem]) }}" id="deleteform" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt me-2"></i>{{ __('VarenykySlider::labels.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">{{ __('varenyky::labels.empty') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
