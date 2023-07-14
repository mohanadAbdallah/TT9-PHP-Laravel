@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>{{ $topic->title }} (#{{$topic->id}})</h1>
    </div>

@endsection
