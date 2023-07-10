@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>{{ $classroom->name }} (#{{$classroom->id}})</h1>
        <h3>{{$classroom->section}}</h3>
        <div class="row">

        </div>
    </div>

@endsection
