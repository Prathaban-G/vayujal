<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vayujal')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.3/mqttws31.min.js"></script>
    
    <style>
        body {
            background-color: rgba(236, 234, 234, 0.877);
        }
        .nav-bar {
            font-size: 25px;
            color: white;
            display: none;
        }
        .aside-nav-bar:hover {
            background-color: rgb(0, 116, 170);
        }
        @media screen and (max-width: 800px) {
            .nav-bar {
                display: block;
            }
            .aside {
                display: none;
            }
            .main {
                padding-left: 0px;
            }
        }
        @media screen and (min-width: 1600px) {
            #chart1 {
                width: 100%;
                height: 420px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
