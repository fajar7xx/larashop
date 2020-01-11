@extends('layouts.global')

@section('title')
    Create Category
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <form action="{{route('categories.store')}}" class="bt-white shadow-sm p-3" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" class="form-control">
        <br>

        <label for="image">Category Image</label>
        <input type="file" name="image" id="image" class="form-control">
        <br>

        <input type="submit" value="Save" class="btn btn-primary">
    </form>
@endsection