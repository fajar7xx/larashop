@extends('layouts.global')

@section('title')
    Trash Category
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <form action="{{route('categories.index')}}">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="masukkan kategori untuk filterr.." value="{{Request::get('keyword')}}">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
                
            </form>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link">Published</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('categories.trash')}}" class="nav-link active">Trash</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-12 text-right">
            <a href="{{route('categories.create')}}" class="btn btn-primary">Create Category</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th class="font-weight-bold">Name</th>
                    <th class="font-weight-bold">Slug</th>
                    <th class="font-weight-bold">Images</th>
                    {{-- <th class="font-weight-bold">Avatar</th>
                    <th class="font-weight-bold">Status</th> --}}
                    <th class="font-weight-bold">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            @if ($category->image)
                                <img src="{{asset('public/storage/'.$category->image)}}" class="img-fluid" width="70px">
                            @else
                                No image
                            @endif
                        </td>
                        <td>
                            <a href="{{route('categories.restore', [$category->id])}}" class="btn btn-success text-white btn-sm">Restore</a>
                            <form action="{{route('categories.delete-permanent', [$category->id])}}" method="GET" class="d-inline" onsubmit="return confirm(`Delete this category permantly ?`)">
                                @csrf
                                @method('delete')
                                {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                {{$categories->appends(Request::all())->links()}}
             
            </ul>
          </nav>
    </div>
@endsection