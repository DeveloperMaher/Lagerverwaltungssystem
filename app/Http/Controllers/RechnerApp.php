<?php

namespace App\Http\Controllers;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\MaterialList;
use App\Models\Materials;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Input;
use App\Services\RechnerService;

class RechnerApp extends Controller
{
    protected $rechnerService;
    public function __construct(RechnerService $rechnerService) {
        $this->rechnerService = $rechnerService;
    }
    
    public function viewRechner(Request $request){
        $materials = Materials::all();
        $materialList = MaterialList::all();
        $rechnerValue = $this->rechnerService->getRechnerValue();
        $total_stück = $this->calculate($request);
        // $rechnerValue = Settings::findOrFail(2)->wert;
    
        return view('rechner.rechner', [
            'materialList' => $materialList, 
            'materials' => $materials, 
            'rechnerValue' => $rechnerValue,
            'total_stück' => $total_stück,
            'material' => old('material', $request->input('material')),
            'farbe' => old('farbe', $request->input('farbe')),
            'höhe' => old('höhe', $request->input('höhe')),
            'zweck' => old('zweck', $request->input('zweck')),
        ]);
    }

    // public function getRechnerValue(){
    //     $rechnerValue = Settings::findOrFail(2)->wert;
    //         return $rechnerValue;
    // }

    public function changeRechnerValue(Request $request){
        $newRechnerValue = $request->get('wert-app');
        try {
            // Update the 'wert' column in the 'settings' table
            $settings = Settings::findOrFail(2);
            $settings->wert = $newRechnerValue;
            $settings->save();
    
            return redirect()->back()->with('success', 'Rechner value updated successfully!');
        } catch (\Exception $e) {
            // Handle the exception (e.g., log, redirect, or show an error message)
            return redirect()->back()->withErrors(['error' => 'Error updating Rechner value.']);
        }
    }

    public function resetRechnerValue(){
       
            DB::table('settings')
                ->where('id', 2)
                ->update(['wert' => 10]);

       return redirect('rechner/rechner'); 
    }

    public function changeOrResetRechnerValue(Request $request){
        $action = $request->input('action');
    
        if ($action == 'set') {
            // Code to handle changing the value
            $newRechnerValue = $request->get('wert-app');
            try {
                // Update the 'wert' column in the 'settings' table
                $settings = Settings::findOrFail(2);
                $settings->wert = $newRechnerValue;
                $settings->save();
        
                return redirect()->back()->with('success', 'Rechner value updated successfully!');
            } catch (\Exception $e) {
                // Handle the exception (e.g., log, redirect, or show an error message)
                return redirect()->back()->withErrors(['error' => 'Error updating Rechner value.']);
            }
        } elseif ($action == 'reset') {
            // Code to handle resetting the value

            DB::table('settings')
                ->where('id', 2)
                ->update(['wert' => 10]);

            return redirect('rechner/rechner'); 
        }
    }

    public function calculate(Request $request){
        $action = $request->input('action');
        // Check if the form was submitted
        if ($action == 'rechnen') {
            // Validate the form data
            $request->validate([
                'material' => 'required',
                'farbe'    => 'required',
                'höhe'     => 'required',
                'zweck'    => 'required',
            ]);

            // Retrieve the input data
            $material = $request->input('material');
            $farbe    = $request->input('farbe');
            $höhe     = $request->input('höhe');
            $zweck    = $request->input('zweck');

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
                // return $total_stück;
               
                session()->flash('success', 'Das Material wurde erfolgreich gerechnet..');
                return redirect()->back()
                ->with('total_stück', $total_stück)
                ->withInput(); // Ensure old input values are flashed
            } else {
                // Handle the error
                return response()->json(['error' => 'Query failed'], 500);
            }
        } else {
            $totalStück = ''; 
        }

        if ($action == 'rememberlist-btn') {
            $material = $request->input('material');
            $farbe = $request->input('farbe');
            $höhe = $request->input('höhe');
        
            // Check if the record already exists
            $existingRecord = DB::table('remember_list')
                ->where('material', $material)
                ->where('farbe', $farbe)
                ->where('höhe', $höhe)
                ->first();
        
            if ($existingRecord) {
                // Record already exists, handle accordingly (e.g., show a message)
                session()->flash('info', 'Das Material existiert bereits in der Merkliste.');
                return redirect()->back();
            }
        
            // If the record doesn't exist, proceed with inserting it
            $result = DB::table('lager_matieral')
                ->select(DB::raw('SUM(stück) as total_stück'))
                ->where('material', $material)
                ->where('farbe', $farbe)
                ->where('höhe', $höhe)
                ->first();
        
            $stück = $result->total_stück;
            $status = 0;
        
            $data = [
                'material' => $material,
                'farbe' => $farbe,
                'höhe' => $höhe,
                'stück' => $stück !== null ? $stück : 0, // Insert 0 if $stück is null
                'status' => $status
            ];
        
            DB::table("remember_list")->insert($data);
        
            session()->flash('add', 'Das Material wurde erfolgreich hinzugefügt.');
            
            return redirect()->back();
        }
        
    }

    // public function addToRememberList(Request $request){
       
    //         $item = Materials::find($id);
    //         // dd($item);
    //         $material = Input::get('material');;
           
    //         $farbe = $request->input('farbe');;
    //         $höhe = $request->input('höhe');;
    //         $stück = $request->input('stück');;
    //         $status = 'bestellt';

    //         dd($material, $farbe, $höhe, $stück, $status);

    //         $data = [
    //             'material' => $material,
    //             'farbe' => $farbe,
    //             'höhe' => $höhe,
    //             'stück' => $stück,
    //             'status' => $status
    //         ];
     
    //     // DB::table("remember_list")->insert($data);
    //     // $request->session()->flash('success', 'Das Material wurde erfolgreich hinzugefügt.');

    //     sleep(5);
    //     //  return view('rechner.rechner');

    // }
    
}
