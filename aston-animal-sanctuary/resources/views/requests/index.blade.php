@extends('layouts.app')
@section('content')
<br>
<br>
<!-- this is a view the user will see when requesting an animal-->
<h1>Animal Requests</h1>
<br>
<!-- carousel for mutilple images-->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
	<?php 
	$image=$animal['cover_image'];
	$image =ltrim($image);
	//if users do not upload image then upload auto image
	if($image == ""){ ?>
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
			<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
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
	<!-- view the information of item that is requested, so users can access the item they requestsed -->

		<div class="card-header">Request Animal </div>
	
	<div class="card-body">
		<table class="table table-hover">
			<tr>
				<th> id</th>
				<td> {{$animal['id']}} </td>
			</tr>
			<tr>
				<th> Animal</th>
				<td> {{$animal['animal'] }} </td>
			</tr>
			<tr>
				<th> Date of Birth</th>
				<td> {{$animal['date_birth']}} </td>
			</tr>
			<tr>
				<th> Name </th>
				<td> {{$animal['name']}} </td>
			</tr>
			
	</div>
</div>

</table>
<small>Added by: {{$user['name']}}</small>
<!-- Form to allow user to request an item-->
<form method="POST" action="{{route('requests',$animal['id']) }}" enctype="multipart/form-data">
	<!-- CSRF Token -->
	@csrf
	<div class="form-group row">
		<label for="name" class="col-md-12 col-form-label text-md-center">Name</label>
		<div class="col-md-12">
			<input id="name" type="text" class="form-control" name="name">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<input id="submit" type="submit" class="form-control">
		</div>
	</div>
</form>

@endsection