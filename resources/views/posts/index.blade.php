@extends('layouts.master')

@section('content')
    @forelse($posts as $post)

        <div class="well clearfix">

            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img src="/storage/cover_images/{{ $post->cover_image }}" alt="" style="width: 100%">
                </div>
                <div class="col-md-8 col-sm-8">

                    {{--//title--}}
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    <div class="pull-right">{{ $post->created_at->diffForHumans()  }}</div>

                    {{--Content--}}
                    <br>
                    {{ $post->content }}
                    <br><br>

                    {{--Footer--}}
                    <div class="pull-left">
                        Written by {{ $post->user->name }}
                    </div>

                    <div class="pull-right">
                        @if (!Auth::guest())
                            @if(auth()->user()->id == $post->user->id)
                                <form action="/posts/{{ $post->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <small><button class="btn btn-danger btn-sm" style="display:inline-block">Delete</button></small>
                                </form>

                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @empty
        No posts.
    @endforelse
        @if (!isset($links))
            {{ $posts->links() }}
        @endif
@endsection
@if($flash = session('message'))
    <div id="flash-message" class="alert alert-success" role="alert">
        {{ $flash }}
    </div>
@endif

