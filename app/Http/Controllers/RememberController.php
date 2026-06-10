<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Rememberlist;
use App\Http\Controllers\RechnerApp;
use App\Services\RechnerService;
class RememberController extends Controller
{
    
    protected $rechnerService;
    public function __construct(RechnerService $rechnerService) {
        $this->rechnerService = $rechnerService;
    }
    //
    public function index(){
        $rememberList = Rememberlist::all();
        $rememberListCount = Rememberlist::count();
        $rememberListCountBestellt = Rememberlist::where('status', 1)->count();
        $rememberListCountNotBestellt = Rememberlist::where('status', 0)->count();

        $rechnerValue = $this->rechnerService->getRechnerValue();
        return view('remember.rememberlist', 
        ['rememberList' => $rememberList,
        'rememberListCount' => $rememberListCount,
        'rememberListCountBestellt' => $rememberListCountBestellt,
        'rememberListCountNotBestellt' => $rememberListCountNotBestellt,
        'rechnerValue'=> $rechnerValue]);
    }

    public function delete(Request $request){
       if ( $request->has("deleteItem") ) {
            $id = $request->input('id');
            $RememberItem = Rememberlist::find($id);
            // Check if the record exists
            if (!$RememberItem) {
                return response()->json(['message' => 'Record not found.'], 404);
            }
            $RememberItem->delete();

            session()->flash('delete', 'Das Material wurde erfolgreich gelöscht.');

        } elseif($request->has("deleteAllMerkliste")) {

            DB::table('remember_list')->delete();
            session()->flash('deleteAll', 'Die Merkliste wurde erfolgreich gelöscht.');
        }

        return redirect()->back();
    }

 
    public function update($id){
        $item = Rememberlist::find($id);
    
        if(!$item){
            // Handle case where item is not found
            return redirect()->back()->with('error', 'Das Material konnte nicht gefunden werden.');
        }
    
      
    
        if($item->status){
            return redirect()->back()->with('message', 'Die Id.Nr :'.$item->id.' wurde bereits bestellt.');
         
            
        } else{
            $item->status = 1;
        }
        // Set the updated_at timestamp
        $item->updated_at = now();
        $item->save();

        return redirect()->back()->with('message', 'Das Material wurde erfolgreich aktualisiert.');
       
    }
    

}
