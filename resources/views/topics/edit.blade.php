@extends('layouts.master')
@section('content')
    <div class="container" style="padding: 20px;">
        <h1 class="mt-4 mb-5">Create Topic</h1>

        <form action="{{ route('topics.update',$topic->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" name="title" value="{{$topic->title}}" placeholder="Topic Name">
                <label for="title">Topic title</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Topic</button>
        </form>
    </div>
@endsection
