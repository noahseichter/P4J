@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
	            <div class="card-header">Students</div>
	            
	            <div class='container-fluid'>
	                           
	                <ul id='navigation-tabs' class="nav nav-tabs navigation-tabs">
	                    <li class="active"><a href="#fall">Fall</a></li>
	                    <li class=""><a href="#winter">Winter</a></li>
	                    <li class=""><a href="#spring">Spring</a></li>
	                </ul>
	
	                <div class="tab-content">
		                @php ($semesters = ['fall', 'winter', 'spring'])
		                @foreach($semesters as $semester)
		                <div id='{{ $semester }}' class='tab-pane {{ ($semester == "fall") ? "active" : "" }}'>
		                	<table id='student_list_{{$semester}}' class="table @if(count($students) > 0) table @endif container">
							    <thead>
								  <th>Class</th>
							      <th>Name</th>
							      <th class='text-center'>Domain 1</th>
							      <th class='text-center'>Domain 2</th>
							      <th class='text-center'>Domain 3</th>
							      <th class='text-center'>Domain 4</th>
							      <th class='text-center'>Domain 5</th>
							    </thead>
		
							    <tbody>
							   	@if(count($students) > 0)
								@foreach($students as $student)
							        <tr class=''>
								      <td>{{$student->class}}</td>
							          <td  class='table-td' data-url="/student/{{$student->id}}">{{$student->last_name}}, {{$student->first_name}}</td>
							          @for($i = 1; $i <= 5; $i++)
							          	<td  class='table-td text-center' data-url="/student/{{$student->id}}/domain/{{$i}}">{{ $student[$semester][$i] }}</td>
							          @endfor
							        </tr>
							    @endforeach
							    @else
							    	<tr>
							    		<td colspan="2">You have no students.</td>
							    	</tr>
								@endif
							    </tbody>
							</table>
		                </div>
		                @endforeach
	                </div>
	            </div>
            </div>
        </div>
    </div>
</div>
@endsection