@extends('layouts.app')

@section('content')
    <div class="conatiner">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card bg-white border">
                    {{-- <div class="card-header bg-transparent border-0">{{__('Login')}}</idv> --}}
                    <div class="card-body">
                        <form action="{{route('login')}}" method="post" aria-label="{{__('Login')}}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="email" class="col-sm-12 col-form-label pl-0">{{__('E-mail Address')}}</label>
                                    <br>
                                    <input type="email" name="email" id="email" class="form-control {{$errors->has('email') ? 'is-invalid':'' }}" value="{{old('email')}}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('email')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password" class="col-md-4 col-form-label text-md-left pl-0">{{__('Password')}}</label>
                                    <input type="password" name="password" id="password" class="form-control {{$errors->has('password') ? 'is-invalid':'' }}" value="{{old('email')}}" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('password')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <input type="checkbox" name="remember" id="remember" {{old('remember') ? 'checked':''}}>
                                        <label for="remember">{{__('Remember Me')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-block btn-primary">{{__('Login')}}</button>
                                    <br>
                                    <a href="{{route('password.request')}}" class="btn btn-link pl-0">{{__('Forgot your password?')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
