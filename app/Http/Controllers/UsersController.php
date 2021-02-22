<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    function login(Request $req){
        // get the data from the email
        $data = User::where('email', '=', $req->email)->first();
        // check if the passwords match
        if (Hash::check($req->password,$data->password)) {
            $req->session()->put('user',$data);
            return redirect('/');
        }
        else{
            return "incorrect username  or password";
        }
    }
    // register new user
    function register(Request $req){
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return redirect('/logins');
    }
}
