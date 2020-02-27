@extends('layouts.app')

@section('content')
    <div class="d-flex flex-row justify-content-center">
        <div class="col-6 text-center">
            <div class="alert alert-danger">
                <h1>403</h1>
                <h4>{{$exception->getMessage()}}</h4>
                <a href="{{route('home')}}">Back to Home</a>
            </div>
        </div>
    </div>
@endsection