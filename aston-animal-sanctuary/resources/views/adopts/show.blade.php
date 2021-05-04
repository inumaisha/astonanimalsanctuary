@extends('layouts.app')

@section('content')
<a href="/" class="btn btn-outline-dark"> Go Back</a>
<h1>{{$adopt->name}}</h1>

<br><br>
<div>
    <p>{!! $adopt->animal !!}</p>
</div>

<hr>

<a href="/adopts/{{$adopt->id}}/edit" class="btn btn-outline-dark">Edit</a>

{!!Form::open(['action' => ['App\Http\Controllers\AdoptionController@destroy', $adopt->id], 
'method' => 'POST', 'class' => 'float-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!}


@endsection