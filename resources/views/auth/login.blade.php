@extends('app')

@section('content')

    <div class="form">
        <form method="POST" action="/auth/login" class="form-horizontal">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">E-mail:</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="E-mail">
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="checkbox" name="remember"> Remember Me
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Login</button>
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