<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\FetchController;
class AuthManager extends Controller
{

    function registerUser(Request $request){

       
        $request->validate([
            'fullName' =>array(
                                'required',
                                'string',
                                'regex:/^[A-Za-z]+(\s[A-Za-z]+)+/i'
                            ),
            'userName' =>'required|string|unique:users,user_name',
            'email' =>'required|email',
            'birthDate' =>'required|date',
            'address' =>'required|string',
            'phone' => array(
                                'required',
                                'string',
                                'regex:/^01[0 1 2][0-9]{8}/'
                            ),
            'password' => array(
                'required',
                'string',
                'min:8',
                'regex: /[^\w\d]|_/'
            ),
            'userImage' =>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $user = new User();
        if($request->hasFile('userImage')){
                $image = $request->file('userImage');
                $name= $request->userName.'.'.$image->getClientOriginalExtension();
                $user->user_image = $image->storeAs('images',$name);
        }
        $user->full_name = $request->fullName;
        $user->user_name = $request->userName;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birthdate = $request->birthDate;

        if ($user->save()) {
            $email=new FetchController();
            $email->sendEmail($user->user_name." has succefully signed up"); 
            return redirect()->route('Home')->with('success', 'insertion performed successfully');

        
        } else {
            return back()->withInput()->with('error', 'Failed to register user');
        }
    }

    function checkuser($name) {

        $user = User::where('user_name', $name)->first();

        if ($user) {
            return "Invalid username";
        } else {
            return "Valid";
        }
    }
}
