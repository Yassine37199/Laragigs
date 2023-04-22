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
        )->get();
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

        return redirect('/');
    }

}
