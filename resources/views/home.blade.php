@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="welcome-msg">
                            @if (Auth::check())
                                <h1>Hello {{ Auth::user()->name }}!</h1>
                                <p>
                                    Nice to see you on {{ Carbon\Carbon::now()->toFormattedDateString() }}.
                                    @if (Auth::user()->last_login )
                                        Last time we saw you was
                                        on {{ date('F d, Y', strtotime(Auth::user()->last_login)) }} at
                                        around {{ date('h', strtotime(Auth::user()->last_login)) }} o'clock!
                                    @else
                                        As this is your first login here would be some information!
                                    @endif
                                </p>
                            @else
                                <h3>You need to log in. <a href="/login">Click here to login</a></h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <comment-list></comment-list>
    </div>
@endsection
