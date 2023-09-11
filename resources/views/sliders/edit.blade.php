@extends('varenykyAdmin::app')

@section('title', __('VarenykySlider::admin.slider.edit.title'))

@section('content_header')
    <strong>{{ __('VarenykySlider::admin.slider.edit.title') }}</strong>
@stop

@section('save-btn', route('admin.sliders.update', $slider))
@section('back-btn', route('admin.sliders.index'))

@section('content')
    <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                    <div class="form-group mb-3">
                        <label for="name"
                            class="@if ($errors->has('name')) text-danger @endif">{{ __('VarenykySlider::labels.name') }}</label>
                        <input id="name" type="text" placeholder="{{ __('VarenykySlider::labels.name') }}..."
                            name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ $slider->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="slug"
                            class="@if ($errors->has('slug')) text-danger @endif">{{ __('VarenykySlider::labels.slug') }}</label>
                        <input id="slug" type="text" placeholder="{{ __('VarenykySlider::labels.slug') }}..."
                            name="slug" class="form-control @if ($errors->has('slug')) is-invalid @endif"
                            value="{{ $slider->slug }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
