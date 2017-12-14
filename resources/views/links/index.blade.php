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
                        <div class="links">
                            @if (Auth::check())
                                <h2>Your Links</h2>
                                <table class="table">
                                    <tbody>@foreach($user->links as $link)
                                        <tr>
                                            <td>
                                                <img src="https://www.google.com/s2/favicons?domain={{ $link->url }}">
                                                {{$link->title}}
                                            </td>
                                            <td>
                                                {{$link->description}}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <form action="/link/{{$link->id}}" style="display:inline-block">
                                                        <button type="submit" name="edit" class="btn btn-primary">Edit
                                                        </button>
                                                        {{ csrf_field() }}
                                                    </form>

                                                    <form action="/link/{{ $link->id }}" method="POST" style="display:inline-block">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button class="btn btn-danger">
                                                            <span>DELETE</span>
                                                        </button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach</tbody>
                                </table>
                                <a href="/link" class="btn btn-primary">Add new Link</a>
                            @else
                                <h3>You need to log in. <a href="/login">Click here to login</a></h3>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
