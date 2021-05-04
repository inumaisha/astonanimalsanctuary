@extends('layouts.app')
@section('content')
<h1>Edit Item</h1>
<br>
<form  method="POST"
action="{{ action('AnimalsController@update',$animal['id']) }} "
enctype="multipart/form-data">
     <!-- CSRF Token -->
    @csrf
      <!-- Shows original category selected and options in dropdown version -->
    <div class="card">
        <div class="form-group-row col-md-4">
            <br>
            <label>Animal</label>
            <select name="animal" >
                <option value="{{$item['animal']}}">Previously: {{$animal['animal']}}</option>
                <option value="cat">Cat</option>
                <option value="dog">Dog</option>
                <option value="rabbit"> Rabbit</option>
                <option value="exotic"> Exotic</option>
            </select>
            </select>
        </div>
        <div class="col-md-4">
            <!-- Shows original dob-->
        <div class="col-md-4">
            <label>Date of Birth</label>
            <input type="date" name="date_birth" value={{ $animal['date_birth'] }} placeholder="date_birth" />
        </div>
           <!-- Shows original name-->
         <div class="col-md-4">
            <label>Name</label>
            <input type="text" name="name" value={{ $animal['name'] }} placeholder="Name" />
        </div>
        <!-- option to change image-->
        <div class="form-group col-md-4">
            <label>Image</label>
            <input type="file" name="cover_image[]"  multiple="true" placeholder="Image file" />
        </div>
        <br>
        <!-- Buttons to submit or reset the form -->
        <div class="col-md-6 col-md-offset-4">
            <input type="submit" class="btn btn-primary" />
            
            <input type="reset" class="btn btn-primary" />
        </div>
        <br>
    </div>
</form>
@endsection