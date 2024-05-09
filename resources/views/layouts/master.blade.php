<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  


    @section('CSS')
        
    <link href={{ asset('css/main.css') }} rel="stylesheet" />

    @show

    
    @yield('JS')
   

    <title> @yield('title','unkown')  </title>
</head>
<body>
    @include("layouts/header")

    @yield('content')

    @include("layouts/footer")
</body>
</html>