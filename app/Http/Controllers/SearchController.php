<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materials;
class SearchController extends Controller
{
    public function index(){
         // Call the search method to get the results
         $results = $this->search(request());

         return view('home', compact('results'));
    }
   
    public function search(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('suchkategorie');

        $query = Materials::query();  // Use query builder instead of all()


        if (!empty($category)) {
            $query->where($category, 'like', '%' . $search . '%');
        } else {
            $query->where('material', 'like', '%' . $search . '%')
                  ->orWhere('farbe', 'like', '%' . $search . '%')
                  ->orWhere('höhe', 'like', '%' . $search . '%')
                  ->orWhere('zweck', 'like', '%' . $search . '%')
                  ->orWhere('anmerkungen', 'like', '%' . $search . '%');
        }

        $results = $query->get();
       
        return view('home')->with('results', $results);
    }
}

