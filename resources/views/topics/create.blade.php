@extends('layouts.master')
@section('content')
    <div class="container" style="padding: 20px;">

        <x-validation/>

        <h1 class="mt-4 mb-5">Create Topic</h1>

        <form action="{{ route('topics.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Topic Name">
                <label for="name">Topic name</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" name="classroom_id">
                    <option disabled>Choose the Classroom</option>
                    @foreach(\App\Models\Classroom::all() as $classroom)
                    <option value="{{$classroom->id}}"> {{$classroom->name}}</option>
                    @endforeach
                </select>
                <label for="classroom">Select Classroom</label>
            </div>


            <button type="submit" class="btn btn-primary">Create Topic</button>
        </form>
    </div>
@endsection
