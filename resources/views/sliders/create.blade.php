@extends('varenykyAdmin::app')

@section('title', __('VarenykySlider::admin.slider.create.title'))

@section('content_header')
    <strong>{{ __('VarenykySlider::admin.slider.create.title') }}</strong>
@stop

@section('save-btn', route('admin.sliders.store'))
@section('back-btn', route('admin.sliders.index'))

@section('content')

        <form action="{{ route('admin.sliders.store') }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card border p-3">
                        <div class="form-group mb-3">
                            <label for="name"
                                class="@if ($errors->has('name')) text-danger @endif">{{ __('VarenykySlider::labels.name') }}</label>
                            <input id="name" type="text" placeholder="{{ __('VarenykySlider::labels.name') }}..."
                                name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug"
                                class="@if ($errors->has('slug')) text-danger @endif">{{ __('VarenykySlider::labels.slug') }}</label>
                            <input id="slug" type="text" placeholder="{{ __('VarenykySlider::labels.slug') }}..."
                                name="slug" class="form-control @if ($errors->has('slug')) is-invalid @endif"
                                value="{{ old('slug') }}">
                        </div>
                    </div>
                </div>
            </div>
        </form>
@endsection
