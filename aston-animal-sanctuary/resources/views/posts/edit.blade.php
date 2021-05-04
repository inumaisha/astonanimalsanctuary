@extends('layouts.app')

@section('content')
<h1>Edit Post Submission</h1>


{!! Form::open(array('action' => array('App\Http\Controllers\PostsController@update', $post->id), 'method'=>'POST', 'multipart/form-data')) !!}.
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', $post->body, ['class' => 'ckeditor form-control', 'placeholder' => 'Body Text'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
        </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' =>'btn btn-primary'] )}}
{!! Form::close() !!}
@endsection 