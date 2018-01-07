@extends('layouts.skarla')

@section('content')
<div class="main-wrap">

    <div class="content">
        <div class="container-fluid">
            <a class="btn btn-default m-t-2 m-b-1 action-navigate-back" href="#" role="button"><i class="fa fa-angle-left m-r-1"></i> Back</a>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default b-a-0 shadow-box">
                        <div class="panel-heading text-center">
                            <h3 class="text-center m-b-0">Register</h3>
                        </div>
                        <div class="panel-body">
                            <form class="" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label>Username</label>
                                    <input name="username" class="form-control" value="{{ old('username') }}" placeholder="Enter a Username...">

                                    @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
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
                                <div class="form-group {{ $errors->has('student_number') ? ' has-error' : '' }}">
                                    <label>Student Number</label>
                                    <input name="student_number" class="form-control" value="{{ old('student_number') }}" placeholder="Enter your student number...">

                                    @if ($errors->has('student_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('student_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control" value="{{ old('password') }}" placeholder="Enter a Password...">

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
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
                        <div class="panel-footer b-a-0 b-r-a-0">
                            <!--<a href="../pages/forgot-password.html">Forgot Password?</a>-->
                            <a href="{{url('/login')}}" class="pull-right">Login</a>
                            <div class="clearfix"></div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>

    </div>

    @endsection
