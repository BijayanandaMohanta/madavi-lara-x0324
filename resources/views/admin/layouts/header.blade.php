<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $site_settings = \App\Models\Setting::find(1);
    @endphp
    <meta charset="utf-8" />
    <title>@yield('page_title', 'Admin Panel') | {{ $site_settings->site_name }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('site_settings') . '/' . $site_settings->favicon }}">


    <!-- App css -->
    <link href="{{ asset('admin_assets') . '/css/bootstrap.min.css' }}" rel="stylesheet" type="text/css"
        id="bootstrap-stylesheet" />
    <link href="{{ asset('admin_assets') . '/summernote/summernote-bs4.css' }}" rel="stylesheet" type="text/css" />

    @yield('csscodes')

    <link href="{{ asset('admin_assets') . '/css/icons.min.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets') . '/css/app.min.css' }}" rel="stylesheet" type="text/css" id="app-stylesheet" />



    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
        .invalid-feedback{
        display: block !important;
    }

    </style>

</head>

<body data-layout="horizontal">


    <!-- Begin page -->
    <div id="wrapper">
