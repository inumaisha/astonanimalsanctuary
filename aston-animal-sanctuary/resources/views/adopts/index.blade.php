@extends('layouts.app')

@section('content')
<h1> Adoption Requests</h1>
@if(count($adopts) > 0)

<div class ="card card-body bg-light">
<div class="row">
    <br />
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Animal</th>
        <th>Animal Name</th>
        <th>Animal Age</th>
        <th>Status</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach($adopts as $adopt)
      <tr>
        <td>{{$adopt->id}}</td>
        <td>{{$adopt->name}}</td>
        <td>{{$adopt->animal}}</td>
        <td>{{$adopt->animalName}}</td>
        <td>{{$adopt->age}}</td>
        <td>
        @if($adopt->status == 0)
        <span class="label label-primary">Pending</span>
        @elseif($adopt->status == 1)
        <span class="label label-success">Approved</span>
        @elseif($adopt->status == 2)
        <span class="label label-danger">Rejected</span>
        @else
        <span class="label label-info">Postponed</span>
       @endif
        </td>
       
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>

@else
<p> No requests found </p>
    
@endif

@endsection