@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Change password</div>

                    <div class="card-body">
	                    @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                            {{ csrf_field() }}
                            
                            
                            <div class="form-group row">
	                            <label for="current-password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>
	
	                            <div class="col-md-6">
	                                <input id="current-password" type="password" class="form-control{{ $errors->has('current-password') ? ' is-invalid' : '' }}" name="current-password" required>
	
	                                @if ($errors->has('current-password'))
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('current-password') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group row">
	                            <label for="new-password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
	
	                            <div class="col-md-6">
	                                <input id="new-password" type="password" class="form-control{{ $errors->has('new-password') ? ' is-invalid' : '' }}" name="new-password" required>
	
	                                @if ($errors->has('new-password'))
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('new-password') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        
	                        <div class="form-group row">
	                            <label for="new-password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
	
	                            <div class="col-md-6">
	                                <input id="new-password-confirm" type="password" class="form-control{{ $errors->has('new-password-confirm') ? ' is-invalid' : '' }}" name="new-password_confirmation" required>
	
	                                @if ($errors->has('new-password-confirm'))
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('new-password-confirm') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

                            <div class="form-group row mb-0">
	                            <div class="col-8 offset-md-4">
	                                <button type="submit" class="btn btn-primary login-button">
	                                    {{ __('Change Password') }}
	                                </button>
	                            </div>
	                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection