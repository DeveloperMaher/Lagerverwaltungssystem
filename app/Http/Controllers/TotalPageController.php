<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;

class TotalPageController extends Controller
{
    public function getTotalPage(){
        // get the value from the Database for select the numbers of rows in the page 
        // $total_records_per_page = DB::table('settings')->where('id', 6)->value('wert');
        // echo "$total_records_per_page";
        // return view('home', 
        // ['total_records_per_page' => $total_records_per_page]);
        try {
            // get the value from the Database for selecting the number of rows per page
            $totalRecordsPerPage = Settings::findOrFail(6)->wert;

            return $totalRecordsPerPage;
        } catch (ModelNotFoundException $e) {
            // Handle the model not found exception
            return redirect()->back()->withErrors(['error' => 'Settings with ID 6 not found.']);
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., log, redirect, or show a general error page)
            return redirect()->back()->withErrors(['error' => 'Error retrieving total records per page: ' . $e->getMessage()]);
        }
        
    }

    public function changeTotalPage(Request $request){
        // dd($request->all());
        // Set the new value in the Database about the numbers of rows in the page 
        $total_records_per_page = $request->get('seite');
            DB::table('settings')
                ->where('id', 6)
                ->update(['wert' => $total_records_per_page]);

       return redirect('home');         
    }
        
}
