@extends('layouts.global')

@section('title')
    Book List
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    {{-- daftar user disini --}}
    
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('books.index')}}">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="masukkan judul untuk filter.." value="{{Request::get('keyword')}}">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
                
            </form>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{route('books.index')}}" class="nav-link {{Request::get('status') === NULL && Request::path() === 'books' ? 'active':''}}">All</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('books.index', ['status' => 'publish'])}}" class="nav-link {{Request::get('status') === 'publish' ? 'active':''}}">Publish</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('books.index', ['status' => 'draft'])}}" class="nav-link {{Request::get('status') === 'draft' ? 'active':''}}">Draft</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('books.trash')}}" class="nav-link {{Request::path() === 'books/trash' ? 'active':''}}">Trash</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-4 offset-10">
            <a href="{{route('books.create')}}" class="btn btn-primary">Create Books</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped" width="100%">
            <thead>
                <tr>
                    <th class="font-weight-bold">Cover</th>
                    <th class="font-weight-bold">Title</th>
                    <th class="font-weight-bold">Author</th>
                    <th class="font-weight-bold">Status</th>
                    <th class="font-weight-bold">Categories</th>
                    <th class="font-weight-bold">Stock</th>
                    <th class="font-weight-bold">Price</th>
                    <th class="font-weight-bold">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>
                            @if ($book->cover)
                                <img src="{{asset('public/storage/'.$book->cover)}}" class="img-fluid" width="70px">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td>
                            @if ($book->status === "DRAFT")
                                <span class="badge badge-sm badge-pill badge-warning text-white">{{$book->status}}</span>
                            @else
                            <span class="badge badge-sm badge-pill badge-success text-white">{{$book->status}}</span>
                            @endif
                        </td>
                        <td>
                            <ul class="pl-3 list-unstyled">
                                @foreach ($book->categories as $item)
                                    <li>{{$item->name}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{$book->stock}}</td>
                        <td>{{$book->price}}</td>      
                        <td>
                            <a href="{{route('books.edit', [$book->id])}}" class="btn btn-info text-white btn-sm">Edit</a>
                            <form action="{{route('books.destroy', [$book->id])}}" class="d-inline" method="POST" onsubmit="return confirm('move book to trash')">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="Trash" class="btn btn-danger btn-sm">
                            </form>
                            <a href="{{route('books.show', [$book->id])}}" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                {{$books->appends(Request::all())->links()}}
            </ul>
        </nav>
    </div>
@endsection