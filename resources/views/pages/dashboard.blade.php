@extends('app')

@section('content')

    <header>
        <div class="container"></div>
    </header>

    <main>
        <div class="container">
            <div class="">
                <p>In this example, we’ll use weather data collected by the US Navy from Lake Pend Oreille in Northern Idaho and JavaScript to visualize and query the date from an API.</p>
            </div>

            <div id="form-wrapper" class="center">
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
            </div>

            <!-- Errors output -->
            <div id="form-errors"></div>

            <div id="chart">

            </div>

        </div>
    </main>

    <footer>
        <div class="social">

        </div>
    </footer>
@stop
