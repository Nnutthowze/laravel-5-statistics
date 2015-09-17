@extends('app')

@section('content')

    <div class="form">
        <form method="POST" action="/auth/register" class="form-horizontal">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="John Doe">
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">E-mail:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="johndoe@index.com">
                </div>
            </div>


            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="col-sm-2 control-label" style="padding-top: 0px;">Confirm Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
            </div>
        </form>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

@stop