<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use App\Models\UserRequest;
use Auth;
use DB;
use Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\DecisionMail;
use App\Mail\AcceptMail;

class UserRequestsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
       
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */


    public function index()
    {
        //
        $animals = UserRequest::all()->toArray();
		$animalsRequested = null;
        $usersRequested = null;
        if(auth()->user()->role !==0){
            return redirect('/animals')->with('error','Unauthorized page');
        }
		//For loop to search for the animals in the database
		foreach($animals as $animal) {
			$animalsRequested[$animal['id']] = Animal::find($animal['animal_id'])->toArray();
			$usersRequested[$animal['id']] = User::find($animal['user_id'])->toArray();
		}
		if($usersRequested == null) {
		    //If no requests uploaded then cant access the page.
			return redirect('/dashboard')->with('error','No requests made');
		}
		else {
            //show all request in the table and dont allow more than 5 per page.
            $animals= UserRequest::orderBy('id','asc')->paginate(5);
			return view('requests.show')->with(compact('animals', 'usersRequested', 'animalsRequested' ));
		}
       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $animal_id)
    {
       //validation rule 
         $this->validate($request,[
            'name' => 'required',
            
           ]);
		
		$user_id = Auth()->user()->id;
        $animal_id = $animal_id;
        //ensure an admin can not request 
        if(auth()->user()->role ==0){
            return redirect('/animals')->with('error','Unauthorized page');
        }
       
		//Check if the user requested before.
		$requestData = ['animal_id' => $animal_id, 'user_id' => $user_id];
		$userRequests = DB::table('user_requests')->where($requestData)->get();
		if($userRequests != null) {
			foreach ($userRequests as $requestUser) {
				if($requestUser->approved == 0) {
					return Redirect::back()
						->withErrors('You already have a pending request for this animal!');
						
                }
                
                else{
                    return Redirect::back()
                    ->withErrors('You cannot request the same animal more than once!');
                     }
                }
			}
		
    
        //store the data in an array in the user_request database.
		$name = $request->name;
        $data = array('name'=>$name, 'animal_id'=>$animal_id, 'user_id'=>$user_id);	       
		DB::table('user_requests')->insert($data);
        return redirect('/animals')->with('success', 'animal Requested ');
		
	}
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
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
        $animal = Animal::find($id)->toArray();
        $user = User::find($animal['user_id'])->toArray();
        // ensure the user is not an admin
        if(auth()->user()->role ==0){
            return redirect('/animals')->with('error','Unauthorized page');
        }
        // ensure the user cannot request an animal the user posted 
        if(auth()-> user()->id ==$animal['user_id']){
            
            return redirect('/animals')->with('error', 'You cannot request an animal you posted');
        }
		return view('requests.index', compact('animal'), compact('user'));
	  
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $value = $request->accept;
        $id = $request->id;
        //locate the user who requested the animal.
        $animalRequest = UserRequest::find($id);
        //make sure the user is an admin 
        if(auth()->user()->role !==0){
            return redirect('/animals')->with('error','Unauthorized page');
        }
		$user = User::find($animalRequest['user_id'])->toArray();
		//if request is approved or refused then send an email.
		if($value == 'approved') {
            $animalRequest->accept = 1;
            Mail::to($user['email'])->send(new AcceptMail());
			$animalRequest->save();
        }
        else {
            $animalRequest->accept= -1;
            $value == 'declined';
            Mail::to($user['email'])->send(new DecisionMail());
			$animalRequest->save();
			
		}
		return back();
	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete the request once decsion made 
        $request = UserRequest::find($id);
        $request->delete();
        return back()->with('success', 'Request has been deleted');
  
    }
}
