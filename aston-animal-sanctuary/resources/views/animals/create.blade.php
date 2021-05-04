@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Animal </h2><br/>
    {!! Form::open(['action' => 'App\Http\Controllers\AnimalController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
       
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
    <div class="col-md-4">
            <label>Date of Birth</label>
            <input type="date" name="date_birth" placeholder="date_birth" />
        </div>

    <div class="form-group">
        {{Form::label('name', 'Name of Animal')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name of Animal'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
        </div>

    {{Form::submit('Submit', ['class' =>'btn btn-primary'] )}}
{!! Form::close() !!}
@endsection