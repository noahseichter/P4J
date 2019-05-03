@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="card-header text-center">{{$title}}</div>
				
                <form method="POST" action="{{ route('student.domain.store', ['student' => $student, 'domain' => $domain]) }}">
                    @csrf
                    <div class='container'>
                    <div class="form-group row">
	                    <div class='col-4 vertical-align' >
						<a role='button' class='btn btn-outline-primary go-back' href="/student/{{ $student->id }}/domain/{{$domain}}">Go Back To Student</a><br>
	                    </div>
	                    
                        <div class='col-4 text-center vertical-align'>
                            <h2>{{ $student->first_name . ' '. $student->last_name }}</h2>
                            <select id="class" type="text" class="student-class form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" required>
								<option {{($student->class === 'AM') ? 'selected' : ''}} value='AM'>AM</option>
								<option {{($student->class === 'PM') ? 'selected' : ''}} vlaue='PM'>PM</option>
                            </select>
                        </div>
                       
                        <div class="col-4 vertical-align">
                            <input id="date" type="date" class="date-input pull-right form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ date('Y-m-d') }}" required autofocus>

                            @if ($errors->has('date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    </div>
                    <div class='container-fluid eval-form'>
                    @foreach ( $criteria as $index => $value)
                    	@include('domain.domain_templates.'.$value['type'])
                    @endforeach
                	</div>
                	<br>
                	<div class='container'>
	                	<div class="form-group">
							<label for="comments"><strong>Comments:</strong></label>
							<textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
						</div>
                	</div>

                    <input id='semester' name='semester' value='{{$semester}}' hidden />

                    <div class="form-group domain-buttons ">
                        <div class="col-6">
                            <button type="submit" name='action' value='save' class="domain-button btn btn-primary">
                                {{ __('Save Evaluation') }}
                            </button>
                        </div>
                        <div class="col-6">
                            <button id='eval-submit' type="submit" name='action' value='submit' class="domain-button btn btn-success">
                                {{ __('Submit Evaluation') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/evaluation.js') }}"></script>
@endsection
 