@extends('layouts.global')


@section('title')
Create Book
@endsection

@section('header-script')
<link rel="stylesheet" href="{{asset('node_modules/select2/dist/css/select2.min.css')}}">
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
</script>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <form action="{{route('books.store')}}" method="POST" class="shadow-sm p-3 bg-white"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="book title">
            </div>
            <div class="form-group">
                <label for="categories">Categories</label>
                <select name="categories[]" id="categories" class="form-control" multiple></select>
            </div>
            <div class="form-group">
                <label for="cover">Cover</label>
                <input type="file" name="cover" id="cover" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control"
                    placeholder="give a description about this book"></textarea>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" min="0" value="0">
            </div>
            <div class="form-group">
                <label for="author">author</label>
                <input type="text" name="author" id="author" class="form-control" placeholder="Book Author">
            </div>
            <div class="form-group">
                <label for="publisher">Publiser</label>
                <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Book Publisher">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" placeholder="Book Price">
            </div>
            <div class="ml-0">
                <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
                <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as Draft</button>
            </div>
        </form>
    </div>
</div>
@endsection

