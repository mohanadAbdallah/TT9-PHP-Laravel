<x-main-layout title="Classroom-index">

<div class="container" style="padding: 20px;">
        <h1 class="mt-4 mb-5">Create Classroom</h1>

        <form action="{{ route('classrooms.update',$classroom->id)}}" method="post">
            @csrf
            @method('PUT')
{{--            <input type="hidden" name="_method" dirname="put">--}}
{{--            {{method_field('put')}}--}}

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" value="{{$classroom->name}}" placeholder="Classroom Name">
                <label for="name">Classroom name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="subject" name="subject" value="{{$classroom->subject}}" placeholder="Subject">
                <label for="subject">Subject</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="section" name="section" value="{{$classroom->section}}" placeholder="Section">
                <label for="section">Section</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="room" name="room" value="{{$classroom->room}}" placeholder="Room">
                <label for="room">Room</label>
            </div>

            <div class="form-floating mb-3">
                <input type="file" class="form-control" id="cover_image" name="cover_image"  placeholder="Cover Image">
            </div>

            <button type="submit" class="btn btn-primary">Update Classroom</button>
        </form>
    </div>
</x-main-layout>
