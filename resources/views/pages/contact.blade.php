@extends('layouts.app')

@section('title', ' | Contact')

@section('content')
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <form action="" method="POST">
                {{ csrf_field() }}
                <h3>Contact me</h3>
                <div class="form-group">
                    <label for="name">Full name</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" class="form-control" placeholder="Type here a message..."></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection