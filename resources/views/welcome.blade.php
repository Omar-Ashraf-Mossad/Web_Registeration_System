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
    <script>
     empty_error = "@lang('messages.field_cannot_be_empty')";
     fullname_error= "@lang('messages.invalid_full_name')";
     email_error = "@lang('messages.invalid_email')";
     phone_error = "@lang('messages.phone_requirements')";
     pass_error = "@lang('messages.password_requirements')";
     confirm_error = "@lang('messages.passwords_not_match')";
     username_error = "@lang('messages.username_exists')";
     date_error = "@lang('messages.invalid_date')";
     </script>
    <script src={{ asset('js/index.js') }}></script>

@endsection

@section('content')
<div class="container">



    <div class="formContainer">

        <div class="title">@lang('messages.registration_page')</div> <span class="error">@lang('messages.all_fields_required')</span>


        <form class="registerForm" method="POST" action={{route("RegisterUser")}} enctype="multipart/form-data">
            @csrf

            <div class="inputComponent">
                <label for="fullName">@lang('messages.full_name')</label>
                <input type="text" name="fullName" onchange="validateFullName()" value="{{old("fullName")}}" placeholder="@lang('messages.holder_full_name')" required><br>
                <span class="error" name="fullNameError"></span>
            </div>

            <div class="inputComponent">
                <label for="userName">@lang('messages.user_name')</label>
                <input type="text" name="userName" onchange="validateUserName()" value="{{old("userName")}}" placeholder="@lang('messages.holder_user_name')" required><br>
                <span class="error" name="userNameError"></span>
            </div>

            <div class="inputComponent">
                <label for="email">@lang('messages.email')</label>
                <input type="email" name="email" onchange="validateEmail()" value="{{old("email")}}" placeholder="@lang('messages.holder_email')" required><br>
                <span class="error" name="emailError"></span>
            </div>

            <div class="inputComponent">
                <label for="birthDate">@lang('messages.birth_date')</label>
                <input type="date" name="birthDate" required onchange="validateDate()" value="{{old("birthDate")}}"><br>
                <span class="error" name="birthDateError" ></span>
                <button type="button" class="apiButton" onclick="getActors()">Get Actors</button> <!-- Call your API function here-->

            </div>

            <div class="inputComponent">
                <label for="phone">@lang('messages.phone')</label>
                <input type="tel" name="phone" placeholder="@lang('messages.holder_phone')" value="{{old("phone")}}" onchange="validatePhone()" required><br>
                <span class="error" name="phoneError"></span>
            </div>

            <div class="inputComponent">
                <label for="address">@lang('messages.address')</label>
                <input type="text" name="address" placeholder="@lang('messages.holder_address')" value="{{old("address")}}" required onchange="validateAddress()"><br>
                <span class="error" name="addressError"></span>
            </div>

            <div class="inputComponent">
                <label for="password">@lang('messages.password')</label>
                <input type="password" name="password" placeholder="@lang('messages.holder_password')"  onchange="validatePassword()" minLength="8" required><br>
                <span class="error" name="passError"></span>
            </div>

            <div class="inputComponent">
                <label for="confirmPassword">@lang('messages.confirm_password')</label>
                <input type="password" name="confirmPassword" placeholder="@lang('messages.holder_confirm')" minLength="8" onchange="validateConfirmPassword()" required><br>
                <span class="error" name="confirmError"></span>
            </div>


            <div>
                <label for="userImage">@lang('messages.user_image')</label>
                <input type="file" name="userImage"><br>
            </div>
            <div class="button">
                <input type="submit" onclick="validateAll()" value="@lang('messages.register_submit')">
            </div>


        </form>
        <span class="actor" name="actors">

            <div class="list-holder" name="list-holder">
                <div class="actors-name">@lang('messages.actors_name')</div>
                <div class="listItems" name="listItems"></div>
            </div>
        </span>

    </div>
   
</div>
    
@endsection