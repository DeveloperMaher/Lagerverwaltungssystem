<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialList;
use App\Models\Materials;

use Illuminate\Support\Facades\DB;

class MaterialListController extends Controller
{
    public function index($id){
        $material = Materials::find($id);
          // If the material is not found, you can handle it accordingly (e.g., redirect or show an error message)
          if (!$material) {
            return redirect()->route('home')->with('error', 'Material not found.');
        }

        $materialList = MaterialList::all();
        return view('edit', [
            'materialList' => $materialList,
            'material' => $material
        ]); 
    }
    public function viewAdd(){
        $materialList = MaterialList::orderBy('name_material')->get();
        return view('add.add', ['materialList' =>  $materialList]);
    }
          

    
    public function addToList(Request $request){

        $newMaterialList = $request->input('newMaterialList');
        $data=array('name_material'=>$newMaterialList);
        DB::table("add_to_matieral_list")->insert($data);
        $materialList = MaterialList::all();
        return view('add.add', ['materialList' =>  $materialList]);
    
    }

    public function deleteFromList(Request $request, $id){
        $deleted = DB::table('add_to_matieral_list')->where('id', $id)->delete();
        $materialList = MaterialList::all();
        return view('add.add', ['materialList' =>  $materialList]);
    }
    
}
