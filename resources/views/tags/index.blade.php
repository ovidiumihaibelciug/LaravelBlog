@extends('layouts.app')

@section('title', ' | Tags')

@section('stylesheets')

@endsection

@section('content')
    {{--@foreach($tag->all() as $sTag)--}}
        {{----}}
    {{--@endforeach--}}
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($tags as $sTag)
                            <tr>
                                <td>{{ $sTag->id }}</td>
                                <td>{{ $sTag->name }}</td>
                            </tr>
                        @empty
                            There are no tags. Add one to see it here.
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="col-md-2">
                bbbb
            </div>
            <div class="col-md-3">
                <form action="/tags" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <input type="text" name="tag" id="tag" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script src="{{ asset('js/parsley.min.js') }}"></script>
@endsection