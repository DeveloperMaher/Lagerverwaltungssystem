<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materials;
use App\Models\Users;
use App\Models\Deletedmaterial;
use App\Models\Rememberlist;
use App\Http\Controllers\TotalPageController;
use Illuminate\Support\Facades\DB;

class MaterialsController extends Controller
{

    public function index(){
        // Call the getTotalPage method from TotalPageController
        $totalPageController = new TotalPageController();
        $totalRecordsPerPage = $totalPageController->getTotalPage();
        $materials = Materials::paginate($totalRecordsPerPage);
        $deletedItems = Deletedmaterial::count();
        
        $rememberItems = Rememberlist::count();
        $rememberListCount = Rememberlist::where('status', 0)->count();
       
        $lager = Materials::where('zweck','Lager')->count();
        $kunden = Materials::where('zweck','Kunden')->count();
        $countAllMaterial = Materials::count();
        $count = Users::where('status_user', 'online')->where('user_type', 'benutzer')->count();

        return view('home', [

            'rememberListCount' => $rememberListCount, 
            'rememberItems' => $rememberItems, 
            'deletedItems' => $deletedItems, 
            'materials' => $materials, 
            'lager'=> $lager,
            'kunden'=> $kunden,
            'totalRecordsPerPage' => $totalRecordsPerPage,
            'count'=> $count,
            'countAllMaterial'=> $countAllMaterial
        ]);
    }
    
    public function add(Request $request){
        $this->validate($request, [
            'material' => 'required',
            'farbe' => 'required',
            'höhe' => 'required',
            'paket' => 'required|numeric',
            'stück' => 'required|numeric',
            'zweck' => 'nullable|string',
            'anmerkungen' => 'required', 
        ]);

        $material = $request->get('material');
        $farbe = $request->get('farbe');
        $höhe = $request->get('höhe');
        $paket = $request->input('paket');
        $stück = $request->input('stück');
        $zweck = $request->input('zweck');
        $anmerkungen = $request->input('anmerkungen');
        $date = date('Y-m-d');

        $data=array(
            'material'=>$material,
            'farbe'=>$farbe,
            'höhe'=>$höhe,
            'paket'=>$paket,
            'stück'=>$stück,
            'zweck'=>$zweck,
            'anmerkungen'=>$anmerkungen,
            'date'=>$date,
        );

        DB::table("lager_matieral")->insert($data);
        session()->flash('success', 'Das Material wurde erfolgreich hinzugefügt..');
        sleep(3);
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $material = $request->get('material');
        $farbe = $request->get('farbe');
        $höhe = $request->get('höhe');
        $paket = $request->input('paket');
        $stück = $request->input('stück');
        $zweck = $request->input('zweck');
        $anmerkungen = $request->input('anmerkungen');
        $date = date('Y-m-d');

        $data=array(
            'material'=>$material,
            'farbe'=>$farbe,
            'höhe'=>$höhe,
            'paket'=>$paket,
            'stück'=>$stück,
            'zweck'=>$zweck,
            'anmerkungen'=>$anmerkungen,
            'date'=>$date
        );
        Materials::where('id', $id)->update($data);

        session()->flash('success', 'Dieses Material wurde erfolgreich aktualisiert.');
    
        sleep(2);
        return redirect()->back();
     
    }

    public function deleteMaterial(Request $request, $id){
        
        // Retrieve the row from lager_matieral table
        $material = DB::table('lager_matieral')->find($id);

        // Create a new record in Deletedmaterial table
        Deletedmaterial::create([
            'id' => $id,
            'material' => $material->material,
            'farbe' => $material->farbe,
            'höhe' => $material->höhe,
            'paket' => $material->paket,
            'stück' => $material->stück,
            'zweck' => $material->zweck,
            'date' =>  $material->date,
            'anmerkungen' => $material->anmerkungen
        ]);

        // Delete the row from lager_matieral table
        $deleted = DB::table('lager_matieral')->where('id', $id)->delete();

        session()->flash('delete', 'Das Material wurde erfolgreich gelöscht..');

        return redirect()->back();
    }
    
    public function delete($id){
        // Retrieve the row from lager_matieral table
        $material = Materials::find($id);
    
        // Check if the record exists
        if (!$material) {
            return response()->json(['message' => 'Record not found.'], 404);
        }
    
        // Delete the row from lager_matieral table
        $material->delete();
    
        return back()->with('success', 'Record deleted successfully.');
    }

    public function rechner(Request $request){
       
        // Check if the form was submitted
        if ($request->has('submit')) {
            // Validate the form data
            $request->validate([
                'material' => 'required',
                'farbe' => 'required',
                'höhe' => 'required',
                'zweck' => 'required',
            ]);

            // Retrieve the input data
            $material = $request->input('material');
            $farbe = $request->input('farbe');
            $höhe = $request->input('höhe');
            $zweck = $request->input('zweck');

            // Create the SELECT query with the WHERE clause
            $result = DB::table('lager_matieral')
                ->select(DB::raw('SUM(stück) as total_stück'))
                ->where('material', $material)
                ->where('farbe', $farbe)
                ->where('höhe', $höhe)
                ->where('zweck', $zweck)
                ->first();

            // Check if the query was successful
            if ($result) {
                $total_stück = $result->total_stück ?? 0;

                // You can return $total_stück or perform other actions here
                return response()->json(['total_stück' => $total_stück]);
            } else {
                // Handle the error
                return response()->json(['error' => 'Query failed'], 500);
            }
        } else {
            // Form was not submitted
            sleep(3);
        }
    }

    public function search(Request $request){
        
        $search   = $request->input('search');
        $category = $request->input('suchkategorie');
        
        $validCategories = ['material', 'zweck', 'anmerkungen'];

        $query = Materials::query(); 
    
        if (!empty($category) && in_array($category, $validCategories)) {
            $query->where($category, 'like', '%' . $search . '%');
        } else {
            $query->where('material', 'like', '%' . $search . '%')
                  ->orWhere('farbe', 'like', '%' . $search . '%')
                  ->orWhere('höhe', 'like', '%' . $search . '%')
                  ->orWhere('zweck', 'like', '%' . $search . '%')
                  ->orWhere('date', 'like', '%' . $search . '%')
                  ->orWhere('anmerkungen', 'like', '%' . $search . '%');
        }
    
        $results = $query->get();

        if($results && $results->count() > 0){
            $output = "
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Material</th>
                    <th>Farbe</th>
                    <th>Höhe</th>
                    <th>Paket</th>
                    <th>Stück</th>
                    <th>Zweck</th>
                    <th>Datum</th>
                    <th>Anmerkungen</th>
                    <th>bearbeiten</th>
                    <th>löschen</th>
                </tr>
            </thead>
            <tbody id='tbody'>"; 
            foreach ($results as $result){
                $output .= "
                <form action='" . url('home', $result['id']) . "' method='POST'>
                    <input type='hidden' name='_token' value='" . csrf_token() . "'>
                    <input type='hidden' name='_method' value='POST'>
                    <tr>
                        <td>".$result['id']."</td>
                        <td>".$result['material']."</td>
                        <td>".$result['farbe']."</td>
                        <td>".$result['höhe']."</td>
                        <td>".$result['paket']."</td>
                        <td>".$result['stück']."</td>
                        <td>".$result['zweck']."</td>
                        <td>".$result['date']."</td>
                        <td>".$result['anmerkungen']."</td>
                        <td>
                            <a href='" . url('edit', ['id' => $result['id']]) . "' id='aktualisieren'
                                data-toggle='tooltip' data-placement='top' title='Reihe bearbeiten'>
                                <i class='fa fa-edit'></i>
                            </a>
                        </td>
                            
                        <td>
                            <button type='submit' class='btn bg-transparent border-transparent'>
                                <a id='löschen' data-toggle='tooltip' data-placement='top' title='Reihe löschen'>
                                    <i class='fa fa-trash-alt'></i>
                                </a>
                            </button>
                        </td>    
                    </tr>
                </form>";
            }
            
            $output .="</tbody>";
            echo $output;
        } else {
            echo " 
                <h6 class='m-3'>Es wurden <strong class='text-danger'>keine Ergebnisse</strong> gefunden !</h6>
            ";
        }
    }
   
}
