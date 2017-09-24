@extends('layouts.app')

@section('title', ' | Homepage')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>

                <div class="panel-body">
                    <a href="/posts/create" class="btn btn-primary" style="margin: 3px;">Create a post</a>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>

                            @foreach($posts as $post)
                                <tr>
                                    <td><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></td>
                                    <td><a href="posts/{{ $post->id }}/edit" class="btn btn-default">Edit</a></td>
                                    <td>
                                        <form action="/posts/{{ $post->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <small><button class="btn btn-danger btn-sm" style="display:inline-block">Delete</button></small>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else

                    @endif
                </div>

            </div>
    </div>

    @if ($flash = session('message'))
        <div id="flash-message" class="alert alert-success" role="alert">
            {{ $flash }}
        </div>
    @endif

@endsection
