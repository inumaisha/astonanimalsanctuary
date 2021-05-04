@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Adoption Request</h2><br/>
    {!! Form::open(['action' => 'App\Http\Controllers\AdoptionController@store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    <div class="form-group-row col-md-4">
        <br>
        <label>Animal</label>
        <select name="animal">
            <option value="cat">Cat</option>
            <option value="dog">Dog</option>
            <option value="rabbit">Rabbit</option>
            <option value="exotic">Exotic</option>
        </select>
    </div>

    <div class="form-group">
        {{Form::label('animalName', 'Name of Animal')}}
        {{Form::text('animalName', '', ['class' => 'form-control', 'placeholder' => 'Name of Animal'])}}
    </div>
    <div class="form-group">
        {{Form::label('age', 'Age of Animal')}}
        {{Form::text('age', '', ['class' => 'form-control', 'placeholder' => 'Age of Animal'])}}
    </div>


    {{Form::submit('Submit', ['class' =>'btn btn-primary'] )}}
{!! Form::close() !!}
@endsection