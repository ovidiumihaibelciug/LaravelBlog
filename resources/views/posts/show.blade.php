@extends('layouts.app')

@section('title', ' | Blog')

@section('content')
    <div class="container">
        @include('inc.messages')
        <a href="/posts" class="btn btn-default">Back</a>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @foreach($post->tags as $tag)
                    <a href="/posts/tags/{{ $tag->name }}"><div class="label label-primary">{{ $tag->name }}</div></a>
                @endforeach
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
                        <img src="/storage/cover_images/{{ $post->cover_image }}" alt="" style="width: 100%">
                        <br><br>
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
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if (!Auth::guest())
                <div class="well">
                    <h3>Add a comment</h3>
                    <form action="/posts/{{ $post->id }}/comments" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="body">Comment</label>
                            <textarea name="body" id="body" class="form-control"></textarea>
                        </div>

                        <div class="form-group clearfix">
                            <input type="submit" class="btn btn-success pull-right">
                        </div>

                    </form>
                </div>
                @else
                    <strong>You have to <a href="/login">login </a>to let a comment.</strong>
                @endif

                <ul class="list-group">
                    @forelse ($post->comments as $comment)
                        <li class="list-group-item clearfix">
                            <div class="pull-left">
                                <strong>{{ $comment->user->name }}</strong>:
                                {{ $comment->body }}
                            </div>
                            <div class="pull-right">
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                        </li>
                    @empty
                         There are no comments yet.
                     @endforelse
                </ul>
            </div>
        </div>
    </div>


@endsection