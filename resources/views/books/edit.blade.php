@extends('layouts.global')


@section('title')
Create Book
@endsection

@section('header-script')
<link rel="stylesheet" href="{{asset('node_modules/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col">
        <form action="{{route('books.update', [$book->id])}}" method="POST" class="shadow-sm p-3 bg-white" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="book title" value="{{$book->title}}">
            </div>
            <div class="form-group">
                <label for="categories">Categories</label>
                <select name="categories[]" id="categories" class="form-control" multiple></select>
            </div>
            <div class="form-group">
                <label for="cover">Cover</label>
                @if ($book->cover)
                    <div class="my-1">
                        <img src="{{asset('public/storage/'.$book->cover)}}" class="img-fluid img-thumbnail" width="128px"><br>
                        <small class="text-muted">Current Cover</small>
                    </div>
                @endif
                <input type="file" name="cover" id="cover" class="form-control-file">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah cover</small>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control"
                    placeholder="give a description about this book">{{$book->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" min="0" value="{{$book->stock}}">
            </div>
            <div class="form-group">
                <label for="author">author</label>
                <input type="text" name="author" id="author" class="form-control" placeholder="Book Author" value="{{$book->author}}">
            </div>
            <div class="form-group">
                <label for="publisher">Publiser</label>
                <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Book Publisher" value="{{$book->publisher}}">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" placeholder="Book Price" value="{{$book->price}}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option {{$book->status === 'PUBLISH' ? 'selected':''}} value="PUBLISH">PUBLISH</option>
                    <option {{$book->status === 'DRAFT' ? 'selected':''}} value="DRAFT">DRAFT</option>
                </select>
            </div>
            <div class="ml-0">
                <button class="btn btn-primary" value="PUBLISH">UPDATE</button>
                <a href="{{route('books.index')}}" class="btn btn-warning text-white">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('footer-script')
<script src="{{asset('node_modules/select2/dist/js/select2.min.js')}}"></script>
<script>
    $('#categories').select2({
        ajax: {
            url : 'http://localhost/laraveldasar/larashop/ajax/categories/search',
            processResults: function(data){
                return{
                    results: data.map(function(item){
                        return{
                            id: item.id,
                            text: item.name
                        }
                    })
                }
            }
        }
    });

    let categories = {!! $book->categories !!}

    categories.forEach(function(category){
        let option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
    });
</script>
@endsection