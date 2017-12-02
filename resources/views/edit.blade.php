@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit the Link</h1>

        <form method="POST" action="/link/{{ $link->id }}">

            <div class="form-group">
                <textarea name="description" class="form-control">{{$link->description }}</textarea>
            </div>


            <div class="form-group">
                <button type="submit" name="update" class="btn btn-primary">Update link</button>
            </div>
            {{ csrf_field() }}
        </form>



    </div>

@stop