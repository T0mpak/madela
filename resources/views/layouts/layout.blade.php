<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/favicons/site.webmanifest') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicons/madela_icon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hepta+Slab:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cantarell:wght@700&display=swap" rel="stylesheet">

    @yield('custom-css')

    <title>MADELA SHOP</title>
</head>
<body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $( document ).ready(function() {
        var url = window.location.href;
        console.log( url );
        $( ".first-navbar-items-list a" ).each(function() {
            if (url === (this.href)) {
                $(this).css("color", "#FFFFFF");
                $(this).css("opacity", "1");
            }
        });
        $( ".second-navbar-items-list a" ).each(function() {
            if (url === (this.href)) {
                $(this).css("color", "#FFFFFF");
                $(this).css("opacity", "1");
                $(this).css("text-decoration", "underline");
            }
        });
    });
</script>

@yield('custom-js')

@include('layouts.header')

@if (session()->has('success'))
    <div style="margin: 20px; background-color: lightcyan; color: greenyellow; text-align: center;">
        <b>{!! session('success') !!}</b>
    </div>
@endif

@yield('content')

@include('layouts.footer')

</body>
</html>
