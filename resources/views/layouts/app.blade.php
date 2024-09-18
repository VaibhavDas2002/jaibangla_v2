<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>JB | Jai Bangla</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("images/favicon.ico") }}">
    <link href="{{ asset("css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("css/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />   
    <link href="{{ asset("css/fonts/fontawsome.css")}}" rel="stylesheet" type="text/css" /> 
    <link href="{{ asset('css/styles/main.css') }}" rel="stylesheet"  type="text/css" />
    <link href="{{ asset('css/fontawsome/css/all.css') }}" rel="stylesheet"  type="text/css" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <x-layouts.header />
    <x-layouts.sidebar />
    <div class="content-wrapper">
        <section class="content-header">
            {{$title ?? ''}}
            <x-layouts.datetime />
        </section>
        {{$content ?? ''}}
        {{ $scripts ?? '' }}
        
    </div>
    <x-layouts.footer/>
    @livewireScripts
</body>
</html>