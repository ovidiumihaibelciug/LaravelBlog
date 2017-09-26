@extends('layouts.app')

@section('title', ' | Tags')

@section('stylesheets')

@endsection

@section('content')

    <div class="container">
            <h3>Tags</h3>
             <a href="/tag/{{ $tag->id }}/edit" class="btn btn-warning pull-right">Edit</a>
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
                        There are no tags.
                    @endforelse
                </tbody>
            </table>
    </div>

@endsection

@section('javascripts')
    <script src="{{ asset('js/parsley.min.js') }}"></script>
@endsection



