@extends('layouts.app')

@section('title', ' | Tags')

@section('stylesheets')

@endsection

@section('content')

    <div class="container">
        <h3>Tag: <div class="label label-primary">{{ $tag->name }}</div></h3>

        <form action="/tag/{{ $tag->id }}/delete" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="form-group">
                <button class="btn btn-danger pull-right clearfix">Delete</button>
            </div>
            <a href="/tag/{{ $tag->id }}/edit" class="btn btn-warning pull-right" style="margin-right:5px">Edit</a>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Tags</th>
            </tr>
            </thead>
            <tbody>
                @forelse($tag->posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><a href="/blog/{{ $post->slug }}">{{ $post->title }}</a></td>
                        <td>
                            @foreach($post->tags as $post_tag)
                                <a href="/tag/{{ $post_tag->name }}"><div class="label label-default">{{ $post_tag->name }}</div></a>
                            @endforeach
                        </td>
                    </tr>
                @empty
                    There are no posts.
                @endforelse
            </tbody>
        </table>
    </div>

@endsection

@section('javascripts')
    <script src="{{ asset('js/parsley.min.js') }}"></script>
@endsection



