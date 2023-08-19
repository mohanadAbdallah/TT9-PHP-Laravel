@extends('layouts.master')

@section('content')
    <div class="container" style="padding: 20px;">

        <h1 class="mt-4 mb-5">Topics List</h1>

        <div class="mb-5">
            <a href="{{route('topics.index')}}" class="btn btn-primary">All Topics</a>
        </div>

        <x-alert/>

        <div class="row">
            @foreach($topics as $topic)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$topic->name}}</h5>

                            <div class="form-group">

                            <a href="{{route('topics.show',$topic->id)}}"
                               class="btn btn-secondary mt-4">Show</a>
                            <form method="post" action="{{route('topics.restore',$topic->id)}}" >
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>

                            <a href="javascript:void(0)"
                               onclick="delete_item({{$topic->id}})"
                               data-bs-toggle="modal" data-bs-target="#delete_modal"
                               class="btn btn-danger mt-4">
                                delete </a>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <ul>

        </ul>

    </div>

    <!-- Modal -->
    {{--    Delete Modal--}}
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="delete_form" method="post" action="">
                    @csrf
                    @method('Delete')
                    <input name="id" id="topic_id" class="form-control" type="hidden">
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



@endsection
<script>
    function delete_item(id) {
        $('#topic_id').val(id);
        var url = "{{url('/topics/trashed')}}/" + id;
        $('#delete_form').attr('action', url);
    }
</script>

