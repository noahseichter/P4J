@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="container-fluid">
                    <div class='row student-info'>
                        <div class='col-3'>
                            <h2>{{ $student->first_name . ' ' . $student->last_name }}</h2>
                             <div class="form-check">
								<input disabled class="form-check-input" type="checkbox" {{ ($student->EC==1) ? 'checked' : '' }} value="" id="defaultCheck1">
								<label class="form-check-label" for="defaultCheck1">
							    EC
								</label>
							</div>
							<div class="form-check">
								<input disabled class="form-check-input" type="checkbox" {{ ($student->IEP_Speech==1) ? 'checked' : '' }} value="" id="defaultCheck1">
								<label class="form-check-label" for="defaultCheck1">
							    Speech
								</label>
							</div>
							<div class="form-check">
								<input disabled class="form-check-input" type="checkbox" {{ ($student->EL==1) ? 'checked' : '' }} value="" id="defaultCheck1">
								<label class="form-check-label" for="defaultCheck1">
							    EL
								</label>
							</div>
                        </div>
                        <div class='col-3'>
	                        <br>
	                        <p><strong>Birthday:</strong> {{ date('M d, Y', strtotime($student->birth_date)) }}</p>
                            <p><strong>Site:</strong> {{ $student->site }}</p>
                        </div>
                        <div class='col-3'>
	                        <br>
                            <p><strong>Start Date:</strong> {{ $student->start_date }}</p>
	                        <p><strong>Class Period:</strong> {{ $student->class }}</p>
                        </div>
                        <div class='pull-right col-3'>
	                        @if ( Auth::user() && Auth::user()->isAdmin() )
                            <form class='float-right' method="POST" action="{{route('student.destroy', $student->id)}}"> 
                            @csrf 
                            {{ method_field('DELETE') }} 
                            <input class="btn btn-outline-danger confirm-delete delete-user" data-name="{{ $student->first_name . ' ' . $student->last_name }}" value="DELETE" type="submit" style="width:100px">
                            </form>
                            <a role='button' class='btn btn-outline-primary float-right' href="{{route('student.edit', $student->id)}}">Edit</a>
                            @endif
                        </div>
                    </div>

                    <ul id='tabs' class="nav nav-tabs">
                        @for($i = 1; $i <= 5; $i++) 
                            <li class="{{($i == $domain_number) ? 'active' : ''}}"><a href="/student/{{$student->id}}/domain/{{$i}}">Domain {{$i}}</a></li>
                        @endfor
                        @if ( Auth::user() && Auth::user()->isAdmin() )
                            <li class=""><a href="/student/{{$student->id}}/user">Teachers</a></li>
                        @endif
                    </ul>

                    <div class="tab-content">
                        <div id="domain_{{$domain_number}}" class="tab-pane active">
                            <div class='row'>
                                <div class='col-12'>
                                    <a class='btn btn-secondary btn-lg btn-block' href="/student/{{$student->id}}/domain/{{$domain_number}}">{{$form_array['domain_name']}}</a>
                                </div>
                            </div>
                            <div class='row button-row'>
                                <div class='col-4'>
                                   <a role='button' class='btn btn-danger eval-button' href="/student/{{$student->id}}/domain/{{$domain_number}}/create/fall">Create Fall Evaluation</a>
                                </div>
                                <div class='col-4'>
                                @if ($domain_number != 1 && $domain_number != 4)
                                  <a role='button' class='btn btn-primary eval-button' href="/student/{{$student->id}}/domain/{{$domain_number}}/create/winter">Create Winter Evaluation</a>
                                @endif
                                </div>
                                <div class='col-4'>
                                  <a role='button' class='btn btn-success eval-button' href="/student/{{$student->id}}/domain/{{$domain_number}}/create/spring">Create Spring Evaluation</a><br>
                                </div>
                            </div>
                            <div class='row domain-info-row'>
                                <div class='col-4 domain-info'><div class='domain-info-container'>
                                    @if($fall_all)
                                    <strong>Teacher:</strong> {{ $fall_all->user_name }} ({{$fall_all->class}})<br>
                                    <strong>Created:</strong> {{ date('M d, Y', $fall_all->created_at->timestamp) }}<br>
                                    <strong>Status:</strong> {{ ($fall_all->status === 1) ? 'Complete' : 'In Progress' }}
                                    <a href="/student/{{$student->id}}/domain/edit/{{$fall_all->id}}">(edit)</a><br>
                                    <form method="POST" action="{{route('student.domain.destroy', [$student->id, $fall_all->id])}}"> 
                                        @csrf 
                                        {{ method_field('DELETE') }} 
                                        <input class="btn btn-outline-danger delete-user" value="Delete" type="submit" style="width:100px">
                                    </form>
                                    @endif
                                </div></div>
                                <div class='col-4 domain-info'><div class='domain-info-container'>
                                @if ($domain_number != 1 && $domain_number != 4)
                                    @if($winter_all)
                                    <strong>Teacher:</strong> {{ $winter_all->user_name }} ({{$winter_all->class}})<br>
                                    <strong>Created:</strong> {{ date('M d, Y', $winter_all->created_at->timestamp) }}<br>
                                    <strong>Status:</strong> {{ ($winter_all->status === 1) ? 'Complete' : 'In Progress' }}<br>
                                    <a href="/student/{{$student->id}}/domain/edit/{{$winter_all->id}}">(edit)</a>
                                    <form method="POST" action="{{route('student.domain.destroy', [$student->id, $winter_all->id])}}"> 
                                        @csrf 
                                        {{ method_field('DELETE') }} 
                                        <input class="btn btn-outline-danger delete-user" value="Delete" type="submit" style="width:100px">
                                    </form>
                                    @endif
                                @endif
                                </div></div>
                                <div class='col-4 domain-info'><div class='domain-info-container'>
                                    @if($spring_all)
                                    <strong>Teacher:</strong> {{ $spring_all->user_name }} ({{$spring_all->class}})<br>
                                    <strong>Created:</strong> {{ date('M d, Y', $spring_all->created_at->timestamp) }}<br>
                                    <strong>Status:</strong> {{ ($spring_all->status === 1) ? 'Complete' : 'In Progress' }}
                                    <a href="/student/{{$student->id}}/domain/edit/{{$spring_all->id}}">(edit)</a>
                                    <form method="POST" action="{{route('student.domain.destroy', [$student->id, $spring_all->id])}}"> 
                                        @csrf 
                                        {{ method_field('DELETE') }} 
                                        <input class="btn btn-outline-danger delete-user" value="Delete" type="submit" style="width:100px">
                                    </form>
                                    @endif
                                </div></div>
                            </div>
                            <div class='container-fluid'>
                            @foreach ( $form_array['Criteria'] as $index => $value)
                                @include('domain.domain_templates.'.$value['type'], [
                                    'fall' => $fall_all,
                                    'winter' => $winter_all,
                                    'spring' => $spring_all
                                ])
                            @endforeach
                            </div>
                            <br>
                            <div class='container'>
                            @if ($fall_all && $fall_all->comments != '' )
                                <strong>Fall Comments:</strong> <p>{{ $fall_all->comments}}</p>
                            @endif
                            @if ($domain_number != 1 && $domain_number != 4)
	                            @if ($winter_all && $winter_all->comments != '' )
	                                <strong>Winter Comments:</strong> <p>{{ $winter_all->comments}}</p>
	                            @endif
                            @endif
                            @if ($spring_all && $spring_all->comments != '' )
                                <strong>Spring Comments:</strong> <p>{{ $spring_all->comments}}</p>
                            @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
