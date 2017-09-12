@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>

                <div class="panel-body">
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>

                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
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

                    @endif
                </div>

            </div>
    </div>

@endsection
