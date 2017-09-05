@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/posts" class="btn btn-default">Back</a>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ $post->title }}
                        @if (!Auth::guest())
                            @if(auth()->user()->id == $post->user->id)
                                <small><a href="/posts/{{ $post->id }}/edit">Edit</a></small>
                            <div class="pull-right clearfix btn-group">
                                <form action="/posts/{{ $post->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <small><button class="btn btn-danger btn-sm" style="display:inline-block">Delete</button></small>
                                </form>
                            </div>
                            @endif
                        @endif

                    </div>

                    <div class="panel-body">
                        {{ $post->content }}
                    </div>

                    <div class="panel-footer clearfix">
                        <div class="pull-left">
                            Written by {{ $post->user->name }}
                        </div>
                        <div class="pull-right">
                            {{ $post->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection