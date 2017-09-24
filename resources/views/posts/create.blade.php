@extends('layouts.app')

@section('title', ' | Blog')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zdl4t2duwz5huyy71iwu4w0h81b4ty3vwl9nvfw7h0ujatqn"></script>

    <script>
        tinymce.init({
            selector: "textarea",
            plugins: [
                " autoresize advlist autolink lists link image charmap print preview anchor textcolor",
                "searchreplace visualblocks code fullscreen emoticons",
                "insertdatetime media table contextmenu paste colorpicker hr visualblocks "
            ],
            toolbar: "paste insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | hr |  forecolor backcolor | emoticons | imagetools | visualblocks",
            paste_data_images: true,
            visualblocks_default_state: false
        });
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create a post
                </div>
                <div class="panel-body">
                    <form action="/posts" method="POST" enctype="multipart/form-data" data-parsley-validate="">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title" data-parsley-required>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control" ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control" data-parsley-required placeholder="Ex: my first blog post">
                        </div>

                        <div class="form-group">
                            <input type="file" name="cover_image">
                        </div>

                        <input type="submit" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script src="{{ asset('js/parsley.min.js') }}"></script>
@endsection