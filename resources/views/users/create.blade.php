@extends('layouts.global')

@section('title')
    Create New User
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="fullname" value="{{old('name')}}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="username" value="{{old('username')}}">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="">Roles</label>
            <input class="form-control @error('roles') is-invalid @enderror" type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
            <label for="ADMIN">administrator</label>
            <input class="form-control @error('roles') is-invalid @enderror" type="checkbox" name="roles[]" id="STAFF" value="STAFF">
            <label for="STAFF">staff</label>
            <input class="form-control @error('roles') is-invalid @enderror" type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER">
            <label for="CUSTOMER">customer</label>

            @error('roles')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <br>
            <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror">
            @error('avatar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <hr class="my-3">
        </div>

        <div class="form-group">    
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="user@mail.com" value="{{old('email')}}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        
        <div class="form-group">
            <label for="password_confirmation">password confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="password confirmation">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <input type="submit" value="Save" class="btn btn-primary">
        <a href="{{route('users.index')}}" class="btn btn-outline-warning">Cancel</a>
    </form>
@endsection