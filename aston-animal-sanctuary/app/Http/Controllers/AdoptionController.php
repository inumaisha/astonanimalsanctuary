<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adopt;
use DB;

class AdoptionController extends Controller
{
    

    public function index()
    {
        //return Adopt::all();
        //$adopts=\DB::table('adopts')->get();
       // return view('adopts.index');
      //$adopts = DB::select('SELECT * FROM posts');
       $adopts = Adopt::all();
        return view('adopts.index')->with('adopts', $adopts);
    }

    public function create()
    {
        //return view('createpost');
        return view('adopts.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'animal' => 'required',
            'animalName' => 'required',
            'age' => 'required'
            ]);

            
        //Create Animal adoption request
        $adopt = new Adopt;
        $adopt->name = $request->input('name');
        $adopt->animal = $request->input('animal');
        $adopt->animalName = $request->input('animalName');
        $adopt->age = $request->input('age');
        //$adopt->user_id = Auth::user()->id;
       
        $adopt->save();

        return redirect('/adopts')->with('success', 'Adoption Submitted');
      //$adopt=new Adopt();
        //$adopt->name=$request->get('name');
       // $adopt->animal=$request->get('animal');
       //$adopt->animalName=$request->get('animalName');
       // $adopt->age=$request->get('age');
       //$adopt->save();
        //return redirect('adopt')->with('success', 'Adopt has been successfully submited pending for approval');
    }

    public function show($id)
    {
        $adopt = Adopt::find($id);
        return view('adopts.show')->with('adopt', $adopt);
    }

    public function edit($id)
    {
        $adopt = Adopt::find($id);
        //check for correct user
        if(auth()->user()->id !==$adopt->user_id){
            return redirect('/adopts')->with('error', 'Unauthorised Page');
        }
        return view('adopts.edit')->with('post', $post);
    }
    

    public function update(Request $request, $id)
    {
           //Create Animal adoption request
           $adopt = new Adopt;
           $adopt->name = $request->input('name');
           $adopt->animal = $request->input('animal');
           $adopt->animalName = $request->input('animalName');
           $adopt->age = $request->input('age');
           //$adopt->user_id = Auth::user()->id;
          
           $adopt->save();
        return redirect('/adopts')->with('success', 'Request Updated');
        
    }

    public function adoptApprove($id) {
        $adopt = Adopt::where('id', '=', e($id))->first();
        if($adopt)
        {
            $adopt->approved = 1;
            $adopt->save();
            //return a view 
            return redirect('adopts');
        }
    }

    public function adoptReject($id) {
        $adopt = Adopt::where('id', '=', e($id))->first();
        if($adopt)
        {
            $adopt->reject = 0;
            $adopt->save();
            //return a view 
            return redirect('adopts');
        }
    }
    
}
