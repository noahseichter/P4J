@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Student') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('student.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" name="birth_date" required>

                                @if ($errors->has('birth_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birth_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="site" class="col-md-4 col-form-label text-md-right">{{ __('Site') }}</label>

                            <div class="col-md-6">
                                <input id="site" type="text" class="form-control{{ $errors->has('site') ? ' is-invalid' : '' }}" name="site" required>

                                @if ($errors->has('site'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('site') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>

                            <div class="col-md-6">
                                <input id="start_date" type="date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" required>

                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Class Period') }}</label>

                            <div class="col-md-6">
                                <select id="class" type="text" class="form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" required>
									<option value='AM'>AM</option>
									<option vlaue='PM'>PM</option>
                                </select>
                                @if ($errors->has('class'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="EC" class="col-md-4 col-form-label text-md-right">{{ __('EC') }}</label>

                            <div class="col-md-6">
                                <input id="EC" type="checkbox" class="form-control{{ $errors->has('EC') ? ' is-invalid' : '' }}" name="EC" >
									
                                @if ($errors->has('EC'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('EC') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="EL" class="col-md-4 col-form-label text-md-right">{{ __('EL') }}</label>

                            <div class="col-md-6">
                                <input id="EL" type="checkbox" class="form-control{{ $errors->has('EL') ? ' is-invalid' : '' }}" name="EL" >
									
                                @if ($errors->has('EL'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('EL') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="IEP_Speech" class="col-md-4 col-form-label text-md-right">{{ __('Speech') }}</label>

                            <div class="col-md-6">
                                <input id="IEP_Speech" type="checkbox" class="form-control{{ $errors->has('IEP_Speech') ? ' is-invalid' : '' }}" name="IEP_Speech" >
									
                                @if ($errors->has('IEP_Speech'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('IEP_Speech') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Student') }}
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
