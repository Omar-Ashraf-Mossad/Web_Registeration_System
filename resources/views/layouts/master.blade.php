<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  


    @section('CSS')
        
    <link href={{ asset('css/main.css') }} rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    @show

    
    @yield('JS')
   

    <title> @yield('title','unkown')  </title>
</head>
<body>
    @include("layouts/header")


        

    @if ($errors->any())
        @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
                @endforeach
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif


    @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif

    @yield('content')

    @include("layouts/footer")
</body>
</html>