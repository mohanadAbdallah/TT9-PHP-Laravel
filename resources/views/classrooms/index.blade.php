<x-main-layout title="Classroom-index">

    <div class="container" style="padding: 20px;">
        <h1 class="mt-4 mb-5">Classrooms List</h1>

        <x-alert name="success" id="success" class="alert-success"/>

        <div class="mb-5">
            <a href="{{route('classrooms.create')}}" class="btn btn-primary">Add Classroom</a>
        </div>

        <div class="mb-5">
            <a href="{{route('classrooms.trashed')}}" class="btn btn-success">Trashed</a>
        </div>

        <div class="row">
            @foreach($classrooms as $classroom)
                <div class="col-md-4 mb-4 " id="classroom_{{$classroom->id}}" style="display: block">
                    <div class="card" style="width: 18rem;">
                        <img src="/storage/{{$classroom->cover_image_path}}" class="card-img" width="50px;" height="150">
                        <div class="card-body">
                            <h5 class="card-title">{{$classroom->name}}</h5>
                            <p class="card-text">{{$classroom->subject}}</p>
                            <p class="card-text">{{$classroom->section}}</p>
                            <a href="{{route('classrooms.show',$classroom->id)}}"
                               class="btn btn-secondary mt-4">Show</a>
                            <a href="{{route('classrooms.edit',$classroom->id)}}" class="btn btn-primary mt-4">Edit</a>

                            <a href="javascript:void(0)"
                               onclick="delete_item({{$classroom->id}})"
                               data-bs-toggle="modal" data-bs-target="#delete_modal"
                               class="btn btn-danger mt-4">
                                delete </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <ul>

        </ul>

    </div>

    <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="delete_form" method="post" action="">
                    @csrf
                    @method('Delete')
                    <input name="id" id="classroom_id" class="form-control" type="hidden">
                    <input name="_method" type="hidden" value="DELETE">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Confirm delete classroom.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

    <script>
        function delete_item(id) {
            $('#classroom_id').val(id);

            var url = "{{url('classrooms')}}/" + id;
            $('#delete_form').attr('action', url);
        }
    </script>

</x-main-layout>

<!-- Modal -->
{{--    --}}{{--    Delete Modal--}}
{{--    <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <form id="delete_form" method="post" action="">--}}
{{--                    @csrf--}}
{{--                    @method('Delete')--}}
{{--                    <input name="id" id="classroom_id" class="form-control" type="hidden">--}}
{{--                    <input name="_method" type="hidden" value="DELETE">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>--}}
{{--                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <p>Confirm delete classroom.</p>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                        <button type="button" onclick="delete_item()" class="btn btn-primary">Delete</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}




