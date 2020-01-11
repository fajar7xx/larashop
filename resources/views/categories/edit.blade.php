@extends('layouts.global')

@section('title')
    Edit Category
@endsection

@section('content')
    {{-- User yang akan di edit adalah {{$user->email}} --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    <form action="{{route('categories.update', [$category->id])}}" class="bg-white shadow-sm p-3" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="category name" value="{{$category->name}}">
        <br>

        <label for="slug">slug</label>
        <input type="text" name="slug" id="slug" class="form-control" placeholder="slug" value="{{$category->slug}}">
        <br>

        <label for="image">image</label>
        <br>
        @if ($category->image)
            <img src="{{asset('public/storage/'.$category->image)}}" width="120px" class="img-fluid"/>
        @else
            No image
        @endif
        <input type="file" name="image" id="image" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengganti image</small>
        <hr class="my-3">

        {{-- <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="user@mail.com" value="{{$user->email}}" disabled>
        <br>

        <label for="">Status</label>
        <br>
        <input type="radio" name="status" id="active" class="form-control" value="ACTIVE" {{$user->status == 'ACTIVE' ? 'checked':''}}>
        <label for="active">Active</label>
        <input type="radio" name="status" id="inactive" class="form-control" value="INACTIVE" {{$user->status == 'INACTIVE' ? 'checked':''}}>
        <label for="inactive">Active</label>
        <br><br> --}}
        
        <input type="submit" value="Save" class="btn btn-primary">

    </form>
@endsection