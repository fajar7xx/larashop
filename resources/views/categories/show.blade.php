@extends('layouts.global')

@section('title')
    Detail Category
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                Name : {{$category->name}} <br>
                @if ($category->image)
                    <img src="{{asset('public/storage/' . $category->image)}}" width="128px">
                @else
                    No images
                @endif
                <br>
                category clug : {{$category->slug}}
                <br>
            </div>
            <div class="card-footer">
                <a href="{{route('categories.index')}}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
@endsection