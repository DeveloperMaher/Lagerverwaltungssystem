<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DB;
use App\Models\Users;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function logout(Request $request){

        $email = $request->session()->get('Email');
       
        Users::where('email', $email)->update(['status_user' => 'offline']);
        Users::where('email', $email)->update(['last_logged_out' =>  Users::raw('CURRENT_TIMESTAMP')]);

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        $request->session()->flash('logout', 'Sie haben sich erfolgreich abgemeldet');
        
        return redirect('/login');
    }
}
