@extends('layouts.global')

@section('title')
    Edit User
@endsection

@section('content')
    {{-- User yang akan di edit adalah {{$user->email}} --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    <form action="{{route('users.update', [$user->id])}}" class="bg-white shadow-sm p-3" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="fullname" value="{{$user->name}}">
        <br>

        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="username" value="{{$user->username}}" disabled>
        <br>


        <label for="">Roles</label>
        <input type="checkbox" {{in_array("ADMIN", json_decode($user->roles)) ? 'checked':''}} name="roles[]" id="ADMIN" value="ADMIN">
        <label for="ADMIN">administrator</label>
        <input type="checkbox" {{in_array("STAFF", json_decode($user->roles)) ? 'checked':''}} name="roles[]" id="STAFF" value="STAFF">
        <label for="STAFF">staff</label>
        <input type="checkbox" {{in_array("CUSTOMER", json_decode($user->roles)) ? 'checked':''}} name="roles[]" id="CUSTOMER" value="CUSTOMER">
        <label for="CUSTOMER">customer</label>
        <br><br>

        <label for="phone">Phone Number</label>
        <input type="text" name="phone" id="phone" class="form-control" value="{{$user->phone}}">
        <br>
    
        <label for="address">Address</label>
        <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{$user->address}}</textarea>
        <br>
        
        
        <label for="avatar">Avatar</label>
        <br>
        @if ($user->avatar)
            <img src="{{asset('storage/'.$user->avatar)}}" width="120px" class="img-fluid"/>
        @else
            No AVATAR
        @endif
        <input type="file" name="avatar" id="avatar" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin menbuah avatar</small>
        <hr class="my-3">

        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="user@mail.com" value="{{$user->email}}" disabled>
        <br>

        <label for="">Status</label>
        <br>
        <input type="radio" name="status" id="active" class="form-control" value="ACTIVE" {{$user->status == 'ACTIVE' ? 'checked':''}}>
        <label for="active">Active</label>
        <input type="radio" name="status" id="inactive" class="form-control" value="INACTIVE" {{$user->status == 'INACTIVE' ? 'checked':''}}>
        <label for="inactive">Active</label>
        <br><br>
        
        <input type="submit" value="Save" class="btn btn-primary">

    </form>
@endsection