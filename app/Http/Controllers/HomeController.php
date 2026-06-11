<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materials;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    
    public function index()
    {
        return view('home');
    }

    public function homeUser()
    {
        $materials = Materials::paginate(10);

        $countAllMaterial = Materials::count();
        $lager = Materials::where('zweck', 'Lager')->count();
        $kunden = Materials::where('zweck', 'Kunden')->count();

        return view('homeUser', compact(
            'materials',
            'countAllMaterial',
            'lager',
            'kunden'
        ));
    }
}
