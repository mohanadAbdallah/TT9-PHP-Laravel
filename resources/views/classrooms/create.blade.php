@extends('layouts.master')
@section('content')
    <div class="container" style="padding: 20px;">
        <h1 class="mt-4 mb-5">Create Classroom</h1>

        <form action="{{ route('classrooms.store')}}" method="post">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Classroom Name">
                <label for="name">Classroom name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                <label for="subject">Subject</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="section" name="section" placeholder="Section">
                <label for="section">Section</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="room" name="room" placeholder="Room">
                <label for="room">Room</label>
            </div>

            <div class="form-floating mb-3">
                <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="Cover Image">
            </div>

            <button type="submit" class="btn btn-primary">Create Classroom</button>
        </form>
    </div>
@endsection
