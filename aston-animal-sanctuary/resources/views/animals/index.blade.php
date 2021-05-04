@extends('layouts.app')
@section('content')
<h1>Found animals</h1>
<br>
<!--ensure to check if there is any animals in the database -->
@if(count($animals)>0)
<table class="table">
        <thead>
                <tr>
                        <!--heading are sortable through kyslik link -->
                        <th> @sortablelink('id')</th>
                        <th> @sortablelink('animal')</th>
                        <th>@sortablelink ('date_birth') </th>
                        <th> @sortablelink('name') </th>
                        <th> </th>
                </tr>
        </thead>
        <tbody>
                <!--for loop to iterate through the data in the database -->
                @foreach($animals as $animal)
                <tr>
                        <td> {{$animal['id']}} </td>
                        <td> {{$animal['animal'] }} </td>
                        <td> {{$animal['date_birth']}} </td>
                        <td> {{$animal['name']}} </td>
                        <!--Checks to see if the users has loged in to access the button -->
                        @if(!Auth::guest())
                        <td> <a href="{{ route('animals.show', $animal['id'])}}"><button type="button" class="btn btn-primary">View More
                                        </button></a> </td>
                        @endif
                </tr>
                @endforeach
        </tbody>
</table>
<!-- Pagination link -->

@else
<h3> No Animals</h3>
@endif
@endsection