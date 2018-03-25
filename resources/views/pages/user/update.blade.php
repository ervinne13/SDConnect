@extends('layouts.skarla')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> 

            <div class="panel panel-default b-a-0 shadow-box b-b-success">
                <div class="panel-heading">
                    Update User Account       
                </div>
                <div class="panel-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <form class="" method="post" action="{{ url('user/update-profile') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Avatar</label>
                            <div>
                                <div class="panel panel-default no-bg b-a-2 b-gray-lighter b-dashed m-b-0">
                                    <div class="panel-body">

                                        @if (Auth::user()->image_url)
                                        <div class="empty-avatar">
                                            <p class="text-center">
                                                <img width="250" src="{{url(Auth::user()->image_url)}}">
                                            </p>
                                            <h5 class="text-center">Update Your Avatar...</h5>
                                        </div>
                                        @else
                                        <div class="empty-avatar">
                                            <p class="text-center">
                                                <i class="fa fa-3x fa-user text-gray-light text-center m-t-2"></i>
                                                <br>
                                            </p>
                                            <h5 class="text-center">Upload Your Avatar...</h5>
                                        </div>
                                        @endif

                                        <div class="row">
                                            <p class="col-lg-4 col-lg-offset-4">
                                                <input type="file" name="image_url">
                                            </p>
                                        </div>

                                        <p class="small text-center">Recommended size is 250px by 250px</p>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>
                            Change Password
                            <small>Leave blank to retain old password</small>
                        </h3>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Password </label>
                            <input name="password" type="password" class="form-control" value="{{ old('password') }}" placeholder="Enter a Password...">

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label>Repeat Password</label>
                            <input name="password_confirmation" type="password" class="form-control" value="{{ old('password_confirmation') }}" placeholder="Repeat Password...">

                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                        <button id="action-register" type="submit" class="btn m-b-2 btn-block btn-primary">
                            Update Profile
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
