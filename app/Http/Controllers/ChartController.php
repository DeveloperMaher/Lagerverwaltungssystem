<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    
   public function index(){
       $threshold_one = Settings::findOrFail(3)->wert; 
       $threshold_two = Settings::findOrFail(4)->wert; 
       $threshold_three = Settings::findOrFail(5)->wert; 
       return view('diagramme/chart', 
       ['threshold_one' =>  $threshold_one,
       'threshold_two' =>  $threshold_two,
       'threshold_three' => $threshold_three
        ]);
   }

   public function changeAndResetPfostenValue(Request $request){
        if ($request->has('reset_one')) {
            DB::table('settings')
            ->where('id', 3)
            ->update(['wert' => 10]);

        } elseif ($request->has('submit_one')) {
            $newValue = $request->get('chart_one');
            // Update the 'wert' column in the 'settings' table
            $settings = Settings::findOrFail(3);
            $settings->wert = $newValue;
            $settings->save();
        }
        return redirect()->back();
   }

   public function changeAndResetMattenValue(Request $request){
        if ($request->has('reset_two')) {
            DB::table('settings')
            ->where('id', 4)
            ->update(['wert' => 10]);

        } elseif ($request->has('submit_two')) {
            $newValue = $request->get('chart_two');
            // Update the 'wert' column in the 'settings' table
            $settings = Settings::findOrFail(4);
            $settings->wert = $newValue;
            $settings->save();
        }
        return redirect()->back();
   }

   public function changeAndResetEckValue(Request $request){
        if ($request->has('reset_three')) {
            DB::table('settings')
            ->where('id', 5)
            ->update(['wert' => 3]);

        } elseif ($request->has('submit_three')) {
            $newValue = $request->get('chart_three');
            // Update the 'wert' column in the 'settings' table
            $settings = Settings::findOrFail(5);
            $settings->wert = $newValue;
            $settings->save();
        }
        return redirect()->back();
   }

}
