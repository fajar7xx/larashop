@extends('layouts.global')

@section('title')
    Book List | Trash
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-8">
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
                            <form action="{{route('books.restore', [$book->id])}}" class="d-inline" method="GET">
                                @csrf
                                <input type="submit" value="Restore" class="btn btn-success btn-sm">
                            </form>
                            <form action="{{route('books.delete-permanent', [$book->id])}}" class="d-inline" method="POST" onsubmit="return confirm(`Delete this book permanently?`)">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            </form>
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