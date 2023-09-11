@extends('varenykyAdmin::app')

@section('title', __('VarenykySlider::admin.sliderItems.create.title'))

@section('content_header')
    <strong>{{ __('VarenykySlider::admin.sliderItems.create.title') }}</strong>
@stop

@section('save-btn', route('admin.items.store', $sliderId))
@section('back-btn', route('admin.items.index', $sliderId))

@section('content')

    <form action="{{ route('admin.items.store', $sliderId) }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                    <div class="form-group mb-3">
                        <label for="image" class="@if ($errors->has('image')) text-danger @endif">{{ __('VarenykySlider::labels.image') }}</label>
                        <input id="image" type="file" placeholder="{{ __('VarenykySlider::labels.image') }}..." name="image" class="form-control @if ($errors->has('image')) is-invalid @endif" value="{{ old('image') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="content" class="@if ($errors->has('content')) text-danger @endif">{{ __('VarenykyECom::labels.content') }}</label>
                        <textarea id="content" class="tiny form-control" placeholder="{{ __('VarenykyECom::labels.content') }}..." name="content" @if ($errors->has('content')) is-invalid @endif" rows="4">{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        @php
            if (in_array(request()->server('REMOTE_ADDR'), ['127.0.0.1'])) {
                $plugins = '"link lists link table hr wordcount code"';
            } else {
                $plugins = "'link lists link table hr wordcount code'";
            }
        @endphp

        tinymce.init({
            selector: '.tiny',
            height: 250,
            plugins: {!! $plugins !!},
            toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link hr paste wordcount",
            paste_data_images: true,
            setup: function(editor) {
                editor.on("change keyup", function(e) {
                    tinyMCE.triggerSave();
                    editor.save();
                    window.$(editor.getElement()).trigger('change');
                });
            }
        });
    });
</script>
{{-- <script>
    $('document').ready(function () {
    $("#type").change(function () {
        var data = $(this).val();
        if (data == "cms") {
            $('#link_input').addClass('d-none');
            $('#page_input').removeClass('d-none');
            $('#category_input').addClass('d-none');
            document.getElementById("page").setAttribute("name", "link");
            document.getElementById("link").setAttribute("required", "");
            document.getElementById("category").removeAttribute("name");
        } else if (data == "category") {
            $('#link_input').addClass('d-none');
            $('#page_input').addClass('d-none');
            $('#category_input').removeClass('d-none');
            document.getElementById("category").setAttribute("name", "link");
            document.getElementById("link").removeAttribute("required");
            document.getElementById("page").removeAttribute("name");
        } else {
            $('#link_input').removeClass('d-none');
            $('#page_input').addClass('d-none');
            $('#category_input').addClass('d-none');
            document.getElementById("page").setAttribute("name", "");
            document.getElementById("link").removeAttribute("required");
            document.getElementById("category").removeAttribute("name");
        }
    });
    window.$('#type').trigger('change');
});


</script> --}}
@stop