<x-main-layout title="Classroom-Create">
    <div class="container" style="padding: 20px;">

        <x-validation/>
        <h1 class="mt-4 mb-5">Create Classroom</h1>

        <form action="{{ route('classrooms.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <x-form.floating-control name="name">
                <x-slot:label>
                    <label for="name">Classroom Name</label>
                </x-slot:label>
                <x-form.input name="name" value="{{$classroom->name}}" placeholder="Classroom Name" />
            </x-form.floating-control>

            <x-form.floating-control name="subject">
                <x-form.input name="subject" value="{{$classroom->subject}}" placeholder="Classroom subject" />
                <x-slot:label>
                    <label for="subject">Subject</label>
                </x-slot:label>
            </x-form.floating-control>


            <x-form.floating-control name="section">
                <x-form.input name="section" value="{{$classroom->section}}" placeholder="section" />
                <x-slot:label>
                    <label for="section">Classroom section</label>
                </x-slot:label>
            </x-form.floating-control>

            <x-form.floating-control name="room">
                <x-form.input name="room" value="{{$classroom->room}}" placeholder="Classroom room" />
                <x-slot:label>
                    <label for="room">Room</label>
                </x-slot:label>
            </x-form.floating-control>

            <div class="form-floating mb-3">
                <input type="file" class="form-control" style="height: 54px;font-size: 15px;padding: 16px 0px 0px 35px;" id="cover_image" name="cover_image" placeholder="Cover Image">
                <x-form.error name="cover_image"/>
            </div>

            <button type="submit" class="btn btn-primary">Create Classroom</button>
        </form>
    </div>
</x-main-layout>
