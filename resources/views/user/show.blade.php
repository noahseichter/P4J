@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="container-fluid">
                    <div class='row user-info'>
                        <div class='col-6'>
                            <h2>{{ $user->first_name . ' ' . $user->last_name }}</h2>
                            <p><strong>Site:</strong> {{ $user->site }}</p>
                        </div>
                        <div class='col-6'>
	                        @if ( Auth::user()->isAdmin() )
                            <form class='float-right' method="POST" action="{{route('user.destroy', $user->id)}}"> 
                            @csrf 
                            {{ method_field('DELETE') }} 
                            <input class="btn btn-outline-danger confirm-delete delete-user" data-name="{{ $user->first_name . ' ' . $user->last_name }}" value="DELETE" type="submit" style="width:100px">
                            </form>
                            <a role='button' class='btn btn-outline-primary float-right' href="{{route('user.edit', $user->id)}}">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <h3 class='text-center'>Students</h3>  
                    <table class="table @if(count($students) > 0) table-hover @endif container">
                        <thead>
                          <th>Name</th>
                          <th>Site</th>
                          <th></th>
                        </thead>

                        <tbody>
                        @if(count($students) > 0)
                        @foreach($students as $student)
                            <tr class='table-tr' data-url="/student/{{$student->id}}">
                              <td>{{$student->last_name}}, {{$student->first_name}}</td>
                              <td>{{$student->site}} </td>
                              <td>
                              <form method="POST" class='float-right' action="{{route('user.student.destroy', [$user->id, $student->id])}}"> 
                                @csrf 
                                {{ method_field('DELETE') }} 
                                <input class="btn btn-outline-danger confirm-delete" data-name="{{ $student->first_name . ' ' . $student->last_name }}""  value="REMOVE" type="submit" style="width:100px">
                                </form>
                            </td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="2">No Students.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <form method="POST" action="{{ route('user.student.store', [$user->id]) }}">
                    @csrf

                    <div class="form-group row">
                        <div class='col-2'></div>
                        @if(count($all_students) > 0)
                        <div class="col-md-6">
                            <select id="student" class="form-control{{ $errors->has('student') ? ' is-invalid' : '' }}" name="student">
                            @foreach($all_students as $student)
                                <option value="{{$student->id}}">{{$student->first_name.' '.$student->last_name}}</option>
                            @endforeach
                            </select> 

                            @if ($errors->has('student'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('student') }}</strong>
                                </span>
                            @endif
                        </div>
                        @else
                        <div class="col-6">
                            <select class="form-control" disabled>
                                <option>No Students</option>
                            </select>
                        </div>
                        @endif

                        <div class="col-3">
                            <button type="submit" class="btn btn-primary" {{ (count($all_students) > 0) ? '' : 'disabled' }}>
                                {{ __('Assign Student') }}
                            </button>
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
