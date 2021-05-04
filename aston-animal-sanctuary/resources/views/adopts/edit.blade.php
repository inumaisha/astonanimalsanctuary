@extends('layouts.app')

@section('content')
<h1>Edit request</h1>


{!! Form::open(array('action' => array('App\Http\Controllers\AdoptionController@update', $adopt->id), 'method'=>'POST', 'multipart/form-data')) !!}.
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    
    <div class="form-group">
        {{Form::label('animal', 'Animal')}}
        {{Form::text('animal', '', ['class' => 'form-control', 'placeholder' => 'Animal'])}}
    </div>

    <div class="form-group">
        {{Form::label('animalName', 'Name of Animal')}}
        {{Form::text('animalName', '', ['class' => 'form-control', 'placeholder' => 'Name of Animal'])}}
    </div>
    <div class="form-group">
        {{Form::label('age', 'Age of Animal')}}
        {{Form::text('age', '', ['class' => 'form-control', 'placeholder' => 'Age of Animal'])}}
    </div>

    {{Form::hidden('_method', 'PUT')}}
    {{Form::adopApprove('Approve', ['class' =>'btn btn-primary'] )}}
{!! Form::close() !!}
@endsection 