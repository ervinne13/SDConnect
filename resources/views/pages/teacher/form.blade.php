@extends('layouts.skarla')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> 

            <div class="panel panel-default b-a-0 shadow-box b-b-success">
                <div class="panel-heading">
                    Create new Teacher Account                    
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

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <form class="" method="POST" action="{{ route('teachers.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('user_account_username') ? ' has-error' : '' }}">
                            <label>Username</label>
                            <input name="user_account_username" class="form-control" value="{{ old('user_account_username') }}" placeholder="Enter a Username...">

                            @if ($errors->has('user_account_username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user_account_username') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('display-name') ? ' has-error' : '' }}">
                            <label>Display Name</label>
                            <input name="display_name" class="form-control" value="{{ old('display_name') }}" placeholder="Enter your full name...">

                            @if ($errors->has('display_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('display_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('about') ? ' has-error' : '' }}">
                            <label>About (Position / Subjects / etc.)</label>
                            <textarea class="form-control" name="about"></textarea>                           

                            @if ($errors->has('about'))
                            <span class="help-block">
                                <strong>{{ $errors->first('about') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Password (Temporary only, Teacher should change this immidiately after first log in)</label>
                            <input name="password" type="password" class="form-control" value="{{ old('password') }}" placeholder="Enter a Password...">

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user_account_username') }}</strong>
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
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
