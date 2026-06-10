<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //
    public function index() {
        $users = User::paginate(3);
        return view('example', compact('users'));
    }

    public function update($id){
        $user = User::find($id);

        if($user){
            if($user->status){
                $user->status=0;
            } else{
                $user->status=1;
            }
        $user->save();
        }
        return back();
    }
}
