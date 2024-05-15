@extends('layouts.master')

@section('title')
   Register
    
@endsection
{{-- using master layout css and appending index.css --}}
@section('CSS')
    @parent
    <link rel="stylesheet" href={{ asset('css/index.css') }} class="stylesheet">


@endsection
{{-- appending index.js --}}
@section('JS')
    <script src={{ asset('js/index.js') }}></script>

@endsection

@section('content')
<div class="container">



    <div class="formContainer">

        <div class="title">Registeration Form</div> <span class="error">*all fields are required except user image</span>


        <form class="registerForm" method="POST" action={{route("RegisterUser")}} enctype="multipart/form-data">
            @csrf

            <div class="inputComponent">
                <label for="fullName">Full Name:</label>
                <input type="text" name="fullName" onchange="validateFullName()" value="{{old("fullName")}}" placeholder="Enter your name" required><br>
                <span class="error" name="fullNameError"></span>
            </div>

            <div class="inputComponent">
                <label for="userName">User Name</label>
                <input type="text" name="userName" onchange="validateUserName()" value="{{old("userName")}}" placeholder="Enter your user name" required><br>
                <span class="error" name="userNameError"></span>
            </div>

            <div class="inputComponent">
                <label for="email">Email:</label>
                <input type="email" name="email" onchange="validateEmail()" value="{{old("email")}}" placeholder="Enter your email" required><br>
                <span class="error" name="emailError"></span>
            </div>

            <div class="inputComponent">
                <label for="birthDate">BirthDate:</label>
                <input type="date" name="birthDate" required onchange="validateDate()" value="{{old("birthDate")}}"><br>
                <span class="error" name="birthDateError" ></span>
                <button type="button" class="apiButton" onclick="getActors()">Get Actors</button> <!-- Call your API function here-->

            </div>

            <div class="inputComponent">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" placeholder="Enter your phone number" value="{{old("phone")}}" onchange="validatePhone()" required><br>
                <span class="error" name="phoneError"></span>
            </div>

            <div class="inputComponent">
                <label for="address">Address</label>
                <input type="text" name="address" placeholder="Enter your address" value="{{old("address")}}" required onchange="validateAddress()"><br>
                <span class="error" name="addressError"></span>
            </div>

            <div class="inputComponent">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Enter your password"  onchange="validatePassword()" minLength="8" required><br>
                <span class="error" name="passError"></span>
            </div>

            <div class="inputComponent">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" name="confirmPassword" placeholder="confirm your password" minLength="8" onchange="validateConfirmPassword()" required><br>
                <span class="error" name="confirmError"></span>
            </div>


            <div>
                <label for="userImage">User Image:</label>
                <input type="file" name="userImage"><br>
            </div>
            <div class="button">
                <input type="submit" onclick="validateAll()" value="Register">
            </div>


        </form>
        <span class="actor" name="actors">

            <div class="list-holder" name="list-holder">
                <div class="actors-name">Actors Name</div>
                <div class="listItems" name="listItems"></div>
            </div>
        </span>

    </div>
   
</div>
    
@endsection