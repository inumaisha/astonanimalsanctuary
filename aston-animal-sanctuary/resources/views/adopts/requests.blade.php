@extends('layouts.app')

@section('content')
<a href="/" class="btn btn-outline-dark"> Go Back</a>
<h1>{{$adopt->name}}</h1>

<br><br>
<div>
    <p>{!! $adopt->animal !!}</p>
</div>

<hr>

<a href="/adopts/{{$adopt->name}}/'App\Http\Controllers\PostsController@adoptApprove" class="btn btn-outline-dark">Approve</a>
<a href="/adopts/{{$adopt->name}}/'App\Http\Controllers\PostsController@adoptReject" class="btn btn-outline-dark">Reject</a>





@endsection