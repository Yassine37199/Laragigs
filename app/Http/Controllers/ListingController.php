<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function index(){
        $listings = Listing::latest()->filter(
            request(['tag' , 'search'])
        )->paginate(4);
        return view('listings.index' , ['listings' => $listings]);
    }

    public function show($id){
        $listing = Listing::find($id);
        return view('listings.show' , ['listing' => $listing]); 
    }

    public function create(){
        return view('listings.create'); 
    }

    public function store(Request $req){
    
        $formFields = $req -> validate([
            'title' => 'required',
            'company' => ['required' , Rule::unique('listings' , 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required' , 'email'],
            'tags' => 'required',
            'description' => 'required',

        ]); 

        if($req -> hasFile('logo')){
            $formFields['logo'] = $req -> file('logo') -> store('logos' , 'public');
        }

        Listing::create($formFields);

        return redirect('/') -> with('message' , 'Listing created successfully' );
    }

    public function edit($id){
        $listing = Listing::find($id);
        return view('listings.edit' , ['listing' => $listing]);
    }

    public function update(Request $req , Listing $listing ){
    
        $formFields = $req -> validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required' , 'email'],
            'tags' => 'required',
            'description' => 'required',

        ]); 

        if($req -> hasFile('logo')){
            $formFields['logo'] = $req -> file('logo') -> store('logos' , 'public');
        }

        $listing -> update($formFields);

        return redirect('/') -> with('message' , 'Listing updated successfully' );
    }

    public function destroy(Listing $listing) {
        $listing -> delete();
        return redirect('/') -> with('message' , 'Listing deleted successfully' );
    }

}
