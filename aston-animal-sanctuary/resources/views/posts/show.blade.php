@extends('layouts.app')

@section('content')
<a href="/" class="btn btn-outline-dark"> Go Back</a>
<h1>{{$post->title}}</h1>
<img style="width:50%" src="/storage/cover_image/{{$post->cover_image}}">
<br><br>
<div>
    <p>{!! $post->body !!}</p>
</div>
<small>Submitted on {{$post->created_at}} by {{$post->user->name}}</small>
<hr>
@if(!Auth::guest())
@if(Auth::user()->id == $post->user_id)
<a href="/posts/{{$post->id}}/edit" class="btn btn-outline-dark">Edit</a>

{!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 
'method' => 'POST', 'class' => 'float-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!}
@endif
@endif

@endsection