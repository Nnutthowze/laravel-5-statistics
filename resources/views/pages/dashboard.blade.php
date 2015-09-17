@extends('app')

@section('content')

    <h1>Sexy Dashboard!</h1>

    <!--<form method="POST" action="" class="form-inline">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="from" class="col-sm-2 control-label">from</label>
            <div class="col-sm-10">
                <input type="date" name="from" class="form-control" id="from" required>
            </div>
        </div>

        <div class="form-group">
            <label for="to" class="col-sm-2 control-label">to</label>
            <div class="col-sm-10">
                <input type="date" name="to" class="form-control" id="to" required>
            </div>
        </div>
        <button type="submit" class="btn btn-default">Send</button>

        min="2012-01-12"
        max="2015-08-06"

    </form>-->

    <div>
        <form id="dashboard-date" method="GET" action="{{ route('show') }}" class="form-inline">
            <div class="form-group">
                <label for="from" class="col-sm-2 control-label">from</label>
                <div class="col-sm-10">
                    <input type="date" name="from" class="form-control" id="from" value="2015-01-01">
                </div>
            </div>

            <div class="form-group">
                <label for="to" class="col-sm-2 control-label">to</label>
                <div class="col-sm-10">
                    <input type="date" name="to" class="form-control" id="to" value="2015-02-02">
                </div>
            </div>
        </form>

        <div id="form-errors">

        </div>
    </div>
    
@stop
