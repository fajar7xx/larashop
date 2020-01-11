@extends('layouts.global')

@section('title')
    Detail User
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                Name : {{$user->name}} <br>
                @if ($user->avatar)
                    <img src="{{asset('public/storage/' . $user->avatar)}}" width="128px">
                @else
                    No Avatar
                @endif
                <br>
                username : {{$user->username}}
                <br>
                Phone Number : {{$user->phone}}
                <br>
                address : {{$user->address}}
                <br>
                roles : 
                @foreach (json_decode($user->roles) as $role)
                    &middot; {{$role}} <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection