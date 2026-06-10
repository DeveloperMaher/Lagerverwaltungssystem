<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;
use App\Models\Users;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //
    public function login(Request $request) {
        $userData = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        $user = DB::table('user_table')
            ->where('email', $userData['email'])
            ->first();
    
        if ($user && Hash::check($userData['password'], $user->password)) {
            
            if($user->active_user == 'inactive'){
                return redirect('login')
                ->withErrors(['email' => 'The account has been suspended temporarily!'])
                ->withInput(['email' => $request->input('email')]);

            }else{

                if($user->status_user == 'online'){
                    return redirect('login')
                    ->withErrors(['email' => 'You are already logged in!'])
                    ->withInput(['email' => $request->input('email')]);
                }else{

                    $request->session()->regenerate();
                    $request->session()->put('LOGGED_IN', true);
                    $request->session()->put('Name', $user->name);
                    $request->session()->put('Email', $userData['email']);
                   
                    Users::where('email',  $userData['email'])->update(['last_seen' =>  Users::raw('CURRENT_TIMESTAMP')]);

                    Users::where('email', $userData['email'])->update(['status_user' => 'online']);

                    if ($user->user_type == 'administrator') {
                        return redirect()->intended('home');
                    } else {
                        return redirect()->intended('home');
                    }
                }
            }
        } else {
            return redirect('login')
            ->withErrors(['email' => 'Falsche Email oder Passwort!'])
            ->withInput(['email' => $request->input('email')]);
        }  
    }

    public function register(Request $request) {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $confirmPassword = $request->input('cpassword');
        $userType = $request->get('user_type');
        
        $data = array(
            'name'      => $name,
            "email"     => $email,
            "password"  => $password,
            "user_type" => $userType,
            "status_user" => 'offline',
            "active_user" => 'inactive'
        );

       
    
        $role = DB::table('user_table')->where('user_type', $data['user_type']);
        
        if ($role->count() > 0 && $data['user_type'] == 'administrator') {
            return redirect('register')->withErrors(['error' => 'Es gibt bereits einen Administrator auf der Website!']);
        } else {
            $emailExist = DB::table('user_table')
            ->where('email', $data['email'])
            ->get();
            
            if($emailExist->count() > 0){
                return redirect('register')->withErrors(['error' => 'Die Email existiert bereits!']);
               
            } else {
                if (!Hash::check($confirmPassword, $password)) {
                    return redirect('register')->withErrors(['error' => 'Passwort nicht abgeglichen!']);
                } else {
                    DB::table('user_table')->insert($data);
                    sleep(2);
                    return redirect('login');
                }
            }
        }
    }

    public function resetPassword(Request $request){
        $email = $request->input('email');
        $resetPassword = Hash::make($request->input('resetpass'));
        $confirmResetPassword = $request->input('resetpass_confirm');

        $emailExist = DB::table('user_table')->where('email', $email)->get();
        // dd($emailExist[0]);
        if ($emailExist->count() > 0 ) {
            // $id = $emailExist[0];
            if(!Hash::check($confirmResetPassword, $resetPassword)){
                return redirect('resetpassword')->withErrors(['error' => 'Passwort nicht abgeglichen!']);
            } else {
                DB::table('user_table')
                    ->where('email', $email)
                    ->update(['password' => $resetPassword]);
            }
                return redirect('resetpassword')->withErrors(['error' => 'Das Passwort wurde zurückgesetzt']);
               

        } else {
            return redirect('resetpassword')->withErrors(['error' => 'Falsche Email!']);
            
        }
        
    }

}