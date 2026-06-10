<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deletedmaterial;
use App\Models\Materials;
class DeletedDatenList extends Controller
{
    //
    public function index(){

        $deletedMaterials = Deletedmaterial::all();
        $count = Deletedmaterial::all()->count();
       
        return view(
            'datenbank\deteted_material',
             ['deletedMaterials' => $deletedMaterials,
             'count' => $count]

        );
    }

    public function restore(Request $request, $id){

        // Get the deleted material
        $deletedMaterial = Deletedmaterial::find($id);

        // Insert the material into the lager_material table
        Materials::create([
            'id' => $deletedMaterial->id,
            'material' => $deletedMaterial->material,
            'farbe' => $deletedMaterial->farbe,
            'höhe' => $deletedMaterial->höhe,
            'paket' => $deletedMaterial->paket,
            'stück' => $deletedMaterial->stück,
            'zweck' => $deletedMaterial->zweck,
            'date' => $deletedMaterial->date,
            'anmerkungen' => $deletedMaterial->anmerkungen
        ]);

        // Delete the material from the lager_deleted_material table
        $deletedMaterial->delete();
        $request->session()->flash('success', 'Das gelöschelte Material wurde erfolgreich wiederhergestellt');
       
        return redirect(
            'datenbank\deleted_material'
        );
     
    }


}
