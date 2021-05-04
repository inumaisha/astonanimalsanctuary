<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Animal;
use DB;
use File;

class AnimalController extends Controller
{    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //sortable animals and ensure there is no more than 10 animals on a page 
		$animals = Animal::all();
        return view('animals.index', compact('animals'));
       


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ensure that the user is not an admin 
        if(auth()->user()->role ==1){
            return redirect('/animals')->with('error','Unauthorized page');
        }
        //return view to create an animal
        else return view ('animals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        //messages if the image does not meet the requirments 
        $messages = [    
			'cover_image.max' => 'you have reached the maximium image uplaod.upload 3 images only!!.',
			'cover_image.*.mimes' => 'Invalid file formats.check the format.jpeg,png,jpg,gif,svg!',
			'cover_image.*.max' => 'Image size must be 1mb at max',
		];
        //valdidation rules
       $validator = Validator::make($request->all(), [
        'animal'=>'required',
        'date_birth'=>'required',
        'name'=>'required',
        'cover_image*'=>'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:1999',
        'cover_image'=>'sometimes|max:3 images'
        ], $messages);
        //check if the validation fails then show errors 
        if ($validator->fails()) {
            return redirect('animals')
                        ->withErrors($validator)
                        ->withInput();
        }
     //handle file upload
        if($request->hasFile('cover_image')){
            //get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //GET just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/storage/cover_image', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
      //create animal
      $animal = new Animal;
      $animal->animal=$request->input('animal');
      $animal->date_birth=$request->input('date_birth');
      $animal->name=$request->input('name');
      $animal->user_id= auth()->user()->id;
      $animal->cover_image=$fileNameToStore;
     $animal->save();
     return redirect('/dashboard')->with('success', 'animal Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $animal= Animal::find($id);
        
        return view('animals.show')->with('animal',$animal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $animal= Animal::find($id);
        //check for correct user
        if(auth()->user()->role !==1){
            return redirect('/animals')->with('error','Unauthorized page');
        }
        return view('animals.edit')->with('animal',$animal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //messages if the image does not meet the requirments 
        $messages = [    
			'cover_image.max' => 'you have reached the maximium image uplaod.upload 3 images only!!.',
			'cover_image.*.mimes' => 'Invalid file formats.check the format.jpeg,png,jpg,gif,svg!',
			'cover_image.*.max' => 'Image size must be 1mb at max.',
        ];
        //valdidation rules
       $validator = Validator::make($request->all(), [
        'animal'=>'required',
        'date_birth'=>'required',
        'name'=>'required',
        'cover_image*'=>'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:1999',
        'cover_image'=>'sometimes|max:3 images'
        ], $messages);
        //check if the validation fails then show errors 
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }   
        
          //handle file upload
        $cover_images_to_store=array('');
        //handle file upload 
        if($request->hasFile('cover_image')){
            foreach($request->file('cover_image') as $image){
            //Gets the filename with the extension
            $fileNameWithExt = $image->getClientOriginalName();
            //replaces spaces in file name with an underscore
            $fileNameWithExt = preg_replace('/\s+/','_', $fileNameWithExt);
             //just gets the filename
             $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
             //Just gets the extension
             $extension = $image->getClientOriginalExtension();
             //Gets the filename to store
             $fileNameToStore = $filename.'_'.time().'.'.$extension ;
             //Uploads the image
             $path =$image->storeAs('public/cover_images', $fileNameToStore);
             array_push($cover_images_to_store, $fileNameToStore );
            }
         }
            else {
            $input_image="";
            }
            $input_image=implode(" ",$cover_images_to_store);
            $input_image=ltrim($input_image);   


          //create animal and save the object
          $animal = new Animal;
          $animal->category=$request->input('animal');
          $animal->date_found=$request->input('date_birth');
          $animal->description=$request->input('name');
          $animal->user_id= auth()->user()->id;
          $animal->cover_image=$input_image;
         $animal->save();
          //redirect HTTP response with success message
         return redirect('animals')->with('success', 'animal Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('user_requests')->where('animal_id', $id)->delete();
        $animal=Animal::find($id);
        //check for correct user
        if(auth()->user()->role !==1){
            return redirect('/animals')->with('error','Unauthorized page');
        }
        if($animal->cover_image !='noimage.jpg'){
            //Delete image
            Storage::delete('public/cover_images/'.$animal->cover_image);
        }
        $animal->delete();
        return redirect('/animals')->with('success', 'animal Removed');
    
    }
}

