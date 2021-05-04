@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="card">
			<div class="card-header">
				<!-- view the admin will see when request has been made -->
				<h1>Requested Animals</h1>
			</div>
			<div class="content">
				<!-- Show details of requested animal. -->
					<table class="table table-responsive">
						<tr>
							<th>Animal</th>
							<th>Animal Details</th>
							<th>Animal Name</th>
							<th>Requestee Name</th>
							<th>Requestee Email</th>
							<th>Status </th>
							<th>Actions</th>
						</tr>
						<!-- For loop of all requested animals. -->
						@foreach($animals as $animal)
						<tr>
							<td>{{$animalsRequested[$animal['id']]['animal']}}</td>
							<td> <a href="{{action('App\Http\Controllers\AnimalController@show', $animal['animal_id'])}}" class="btn btn-primary">View</a> </td>
							<td >{{$animal['name']}}</td>
							<td>{{$usersRequested[$animal['id']]['name']}}</td>
							<td>{{$usersRequested[$animal['id']]['email']}}</td>
							<!-- status of request -->
							@if($animal['accept'] == 1)
							<td>Approved</td>
							@elseif ($animal['accept'] == -1)
							<td>Declined</td>
							@else
							<td>Pending</td>
							@endif
							<!--form to allow admin to make a decision -->
							@if($animal['accept'] == 0)
							<td>

								<form method="post" action=" {{ route('requestsanimals', ['id'=>$animal['id']] ) }}">
									<button class="btn btn-success"type="submit" value=approved name=accept >Accept</button>
									<button class="btn btn-danger" type="submit" value=declined >Decline</button>
									@csrf
								</form>
							</td>
							<!-- if request has been made allow admin to remove the request from the table  -->
							@else
							
									
									<td>
										<!-- Option to delete request -->
										<a type="button" class="btn btn-outline-danger"
											href="{{ route('destroyrequest',  $animal['id']) }}">Delete</a>
									</td>
	
						
							@endif
							<td></td>
						</tr>
						@endforeach
					</table>
					{{$animals->links()}}
				@csrf
			</div>
		</div>

	</div>
</div>
@endsection