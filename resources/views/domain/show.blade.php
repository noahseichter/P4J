@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="card-header">{{$title}}</div>
                <a href="/student/{{ $student->id }}">Go Back To student</a><br>
                <div class='container-fluid'>
                @foreach ( $criteria as $index => $value)
                	@include('domain.domain_templates.'.$value['type'])
                @endforeach
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection
 