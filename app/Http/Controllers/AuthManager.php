<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthManager extends Controller
{

    function registerUser(Request $request){

        $messages = [
           'required' => 'The :attribute field is required.',
           'string' => 'The :attribute field must be a string.',
            'unique' => 'The :attribute field already exists.',
            'fullName.regex' =>   'Full name must contain at least two names spearated by space',
            'email.regex' => 'the email value is not valid',
            'date' => 'The :attribute field must be a valid date',
            'password.min' => 'The password field must be at least 8 characters long',
            'password.regex' => 'The password field must contain at least 1 number and 1 special character',
            'username.unique' => 'The username must be unique',
            'phone.regex' => 'phone number must be 11 digit and starts with either[011,010,012]',
        ];
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
            'userimage' =>'nullable|file/image'
        ],$messages);

        $user = new User();
        $user->full_name = $request->fullName;
        $user->user_name = $request->userName;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birthdate = $request->birthDate;

        if ($user->save()) {
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
