@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="container-fluid">
                	<table class="table @if(count($users) > 0) table-hover @endif container">
					    <thead>
					      <th>Name</th>
					      <th>Site</th>
					    </thead>

					    <tbody>
					   	@if(count($users) > 0)
						@foreach($users as $user)
					        <tr class='table-tr' data-url="/user/{{$user->id}}">
					          <td>{{$user->last_name}}, {{$user->first_name}}</td>
					          <td>{{$user->site}} </td>
					        </tr>
					    @endforeach
					    @else
					    	<tr>
					    		<td colspan="2">No Users.</td>
					    	</tr>
						@endif
					    </tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.table-tr {
	cursor: pointer;
}
</style>
@endsection



