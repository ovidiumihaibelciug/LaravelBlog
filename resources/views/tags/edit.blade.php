@extends('layouts.app')

@section('title', ' | Tags')

@section('stylesheets')

@endsection

@section('content')
    {{--@foreach($tag->all() as $sTag)--}}
    {{----}}
    {{--@endforeach--}}
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <form action="/tag/{{ $tag->id }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" name="tag" id="tag" class="form-control" value="{{ $tag->name }}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success pull-right" value="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascripts')
    <script src="{{ asset('js/parsley.min.js') }}"></script>
@endsection