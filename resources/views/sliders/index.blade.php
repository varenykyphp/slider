@extends('varenykyAdmin::app')

@section('title', __('VarenykySlider::admin.slider.index.title'))

@section('content_header')
    <strong>{{ __('VarenykySlider::admin.sliders.index.title') }}</strong>
@stop

@section('create-btn', route('admin.sliders.create'))

@section('content')
    <div class="card border p-3">
        <table class="table table-striped">
            <thead>
                <tr class="table-dark">
                    <th>{{ __('VarenykySlider::labels.name') }}</th>
                    <th>{{ __('VarenykySlider::labels.slug') }}</th>
                    <th width="350"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sliders as $slider)
                    <tr>
                        <td>{{ $slider->name }}</td>
                        <td>{{ $slider->slug }}</td>
                        <td align="right">
                            <a href="{{ route('admin.items.index', $slider->id) }}" class="btn btn-sm btn-dark me-1">
                                <i class="fa-solid fa-bars"></i> {{ __('VarenykySlider::labels.items') }}
                            </a>
                            @include('varenykyAdmin::actions', ['route' => 'admin.sliders', 'entity' => $slider])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">{{ __('VarenykySlider::labels.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
