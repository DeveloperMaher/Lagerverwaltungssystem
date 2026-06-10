<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
class StatusController extends Controller
{
    //
    public function index(){

        $users = Users::where('user_type', '=', 'benutzer')->get();
        $count = Users::count();
        
        return view('status.userstatus', ['users'=> $users, 'count'=> $count]);
    }

   
    public function changeActive($userId, $isActive){

        $cangeActive = Users::where('id', $userId)->update(['active_user' => $isActive]);

        if ($cangeActive) {
            return response()->json(['active_user' => $isActive]);
        } else {
            return response()->json(['error' => 'Failed to update user status'], 500);
        }
    }
    
    public function deleteUser(Request $request, $id){
        
        // Delete the row from lager_matieral table
        $deleted = Users::where('id', $id)->delete();
        $users = Users::where('user_type', '=', 'benutzer')->get();
        session()->flash('success', 'Der Benutzer wurde erfolgreich gelöscht');

        return view('status.userstatus',['users' =>  $users]);
    }
  
}
