@extends('layouts.global')

@section('title')
    Users List
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    {{-- daftar user disini --}}
    {{-- <div class="row">
        <div class="col-md-6">
            <form action="{{route('users.index')}}">
                <div class="input-group mb-3">
                    <input type="text" name="keyword" value="{{Request::get('keyword')}}" class="form-control col-md-10" placeholder="Filter berdasarkan email">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div> --}}

    <form action="{{route('users.index')}}">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control" placeholder="masukkan email untuk filterr.." value="{{Request::get('keyword')}}">
            </div>
            <div class="col-md-6">
                <input type="radio" name="status"  id="ACTIVE" class="form-control" value="ACTIVE" {{Request::get('status')=='ACTIVE' ? 'checked':''}} > 
                <label for="ACTIVE">ACTIVE</label>
                <input type="radio" name="status"  id="INACTIVE" class="form-control" value="INACTIVE" {{Request::get('status')=='INACTIVE' ? 'checked':''}} > 
                <label for="INACTIVE">INACTIVE</label>

                <input type="submit" value="Filter" class="btn btn-primary">
            </div>
        </div>
    </form>

    <div class="row mb-2">
        <div class="col-md-12 text-right">
            <a href="{{route('users.create')}}" class="btn btn-primary">Create User</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th class="font-weight-bold">Name</th>
                    <th class="font-weight-bold">Username</th>
                    <th class="font-weight-bold">Email</th>
                    <th class="font-weight-bold">Avatar</th>
                    <th class="font-weight-bold">Status</th>
                    <th class="font-weight-bold">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->avatar)
                                <img src="{{asset('public/storage/'.$user->avatar)}}" class="img-fluid" width="70px">
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($user->status == "ACTIVE")
                                <span class="badge badge-success">
                                    {{$user->status}}
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    {{$user->status}}
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('users.edit', [$user->id])}}" class="btn btn-info text-white btn-sm">Edit</a>
                            <form action="{{route('users.destroy', [$user->id])}}" class="d-inline" method="POST" onsubmit="return confirm('Delete This User Permanently')">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            </form>
                            <a href="{{route('users.show', [$user->id])}}" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                {{$users->appends(Request::all())->links()}}
             
            </ul>
          </nav>
    </div>
@endsection