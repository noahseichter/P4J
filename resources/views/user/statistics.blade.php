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
                    
                    <ul id='tabs' class="nav nav-tabs">
                        @for($i = 1; $i <= 5; $i++) 
                            <li class="{{($i == $domain_number) ? 'active' : ''}}"><a href="/user/{{$user->id}}/statistics/{{$i}}">Domain {{$i}}</a></li>
                        @endfor
                    </ul>

                    <div class="tab-content">
                        <div id="domain_{{$domain_number}}" class="tab-pane active">
                            <div class='row'>
                                <div class='col-12'>
                                    <a class='btn btn-secondary btn-lg btn-block' href="/user/{{$user->id}}/statistics/{{$domain_number}}">{{$form_array['domain_name']}}</a>
                                </div>
                            </div>
                          
                            <div class='container-fluid'>
                            @foreach ( $form_array['Criteria'] as $index => $value)
                                @include('domain.statistics_templates.'.$value['type'])
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
