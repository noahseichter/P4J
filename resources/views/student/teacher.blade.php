@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="container-fluid">
                    <div class='row student-info'>
                        <div class='col-6'>
                            <h2>{{ $student->first_name . ' ' . $student->last_name }}</h2>
                            <p>Birthday: {{ date('M d, Y', strtotime($student->birth_date)) }}</p>
                            <p>Site: {{ $student->site }}</p>
                        </div>
                        <div class='pull-right col-6'>
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
                            <li class="{{(6 == $domain_number) ? 'active' : ''}}"><a href="">Teachers</a></li>
                        @endif
                    </ul>

                    <div class="tab-content">
                        <div id="teachers" class="tab-pane active">
                            <div class="container-fluid">
                                <h5 class='text-center'>Teachers</h5>  
                                <table class="table @if(count($teachers) > 0) table-hover @endif container">
                                    <thead>
                                      <th>Name</th>
                                      <th>Site</th>
                                      <th></th>
                                    </thead>

                                    <tbody>
                                    @if(count($teachers) > 0)
                                    @foreach($teachers as $teacher)
                                        <tr class='table-tr' data-url="/user/{{$teacher->id}}">
                                          <td>{{$teacher->last_name}}, {{$teacher->first_name}}</td>
                                          <td>{{$teacher->site}} </td>
                                          <td>
                                          <form method="POST" class='float-right' action="{{route('student.user.destroy', [$student->id, $teacher->id])}}"> 
                                            @csrf 
                                            {{ method_field('DELETE') }} 
                                            <input class="btn btn-outline-danger confirm-delete" data-name="{{ $teacher->first_name . ' ' . $teacher->last_name }}" value="REMOVE" type="submit" style="width:100px">
                                            </form>
                                        </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2">No Teachers.</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <form method="POST" action="{{ route('student.user.store', [$student->id]) }}">
                                @csrf

                                <div class="form-group row">
                                    <div class='col-2'></div>

                                    @if(count($all_users) > 0)
                                    <div class="col-md-6">
                                        <select id="user" class="form-control{{ $errors->has('user') ? ' is-invalid' : '' }}" name="user">
                                        @foreach($all_users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name.' '.$user->last_name}}</option>
                                        @endforeach
                                        </select> 

                                        @if ($errors->has('user'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('user') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    @else
                                    <div class="col-6">
                                        <select class="form-control" disabled>
                                            <option>No Teachers</option>
                                        </select>
                                    </div>
                                    @endif

                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary" {{ (count($all_users) > 0) ? '' : 'disabled' }}>
                                            {{ __('Assign Teacher') }}
                                        </button>
                                    </div>
                                </div>  
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
