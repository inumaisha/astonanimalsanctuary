@extends('layouts.app')
@section('content')
<!--ensures that the admin cannot request an animal -->
@if(!Auth::user()->role==1)
<a href="{{ route('requests', $animal['id']) }}" class="btn btn-primary float-right">Request</a>
@endif
<!--the view the user will see when viewing animal details -->
<br>
<br>
<h1>Our Animal</h1>
<br>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
<!-- carousel for mutilple images-->
<?php 
$image=$animal['cover_image'];
$image =ltrim($image);
if($image == ""){ ?>
<!-- if users do not upload image then upload auto image-->
<img style= "width:100%"src="../storage/cover_images/noimage.jpg">
<?php } 
// show mutiple images or an image in a carousel
else{
    $new = explode(" ",$image);?>
    @foreach ($new as $n)
    <div data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></div>
    @endforeach
    <div class="carousel-inner" role="listbox">
        @foreach( $new as $n )
        <div class="carousel-animal {{ $loop->first ? 'active' : '' }}">
      <img class="d-block img-fluid"  src="{{asset('../storage/cover_images/'.$n)}}">
        </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><?php }?>
<br>
<div class="card">
    
        <div class="card-header">Display Animals </div>
    
    <div class="card-body">
        <table class="table table-hover">
            <!-- Display associated data for specified animal -->
            <tr>
                <th> id</th>
                <td> {{$animal->id}} </td>
            </tr>
            <tr>
                <th> Animals</th>
                <td> {{$animal->animal }} </td>
            </tr>
            <tr>
                <th> Date of Birth </th>
                <td> {{$animal->date_birth}} </td>
            </tr>
            <tr>
                <th> Name </th>
                <td> {{$animal->name}} </td>
            </tr>
   
            
    </div>
</div>

</table>
<small>Added on {{$animal->created_at}} by {{$animal->user->name}}</small>
<!--Checks if user is admin; only allows admin to delete and edit animals -->
@if(!Auth::guest())
@if(Auth::user()->role==1)
<hr>
<a href="{{ route('edit', $animal['id'])}}" class="btn btn-primary">Edit</a>
<a type="button" class="btn btn-danger float-right"
href="{{ route('destroy',  $animal['id']) }}">Delete</a>
@endif
@endif
@endsection