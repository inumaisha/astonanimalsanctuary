@extends('layouts.app')

@section('content')
<h1>Add Animal Post</h1>
<p>Please fill out the required fields.</p>

{!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group-row col-md-4">
        <br>
        <label>Animal</label>
        <br>
        <select name="animal">
            <option value="cat">Cat</option>
            <option value="dog">Dog</option>
            <option value="rabbit">Rabbit</option>
            <option value="exotic">Exotic</option>
        </select>
    </div>
    
    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body','', ['class' => 'ckeditor form-control', 'placeholder' => 'Body Text'])}}
    </div>
<div class="form-group">
{{Form::file('cover_image')}}
</div>

    {{Form::submit('Submit', ['class' =>'btn btn-primary'] )}}
{!! Form::close() !!}
@endsection 