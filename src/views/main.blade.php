<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('vendor/xyrotech/css/sky.css') }}" rel="stylesheet ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.4.2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.min.css" />

    <!-- Custom Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body >
@if(Auth::check())
    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                Stratus
            </li>
            <li>
                <a href="#" style="text-decoration: none"  data-toggle="modal" data-target="#modal-0" onclick="sharing(0); return false;">
                    <i class="fa fa-lg fa-folder-o" aria-hidden="true" style="margin-left:-17px; padding-right:10px"></i>
                    Share My Folder
                </a>
            </li>
            @can('admin-access')
                <li>
                    <a href="/admin" >
                        <i class="fa fa-lg fa-database" aria-hidden="true" style="margin-left:-17px; padding-right:10px"></i>
                        Administrator Panel
                    </a>
                </li>
            @endcan
            <li>
                <a href="#" style="text-decoration: none"  data-toggle="modal" data-target="#modal-options" >
                    <i class="fa fa-lg fa-cog" aria-hidden="true" style="margin-left:-17px; padding-right:10px"></i>
                    Options
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lg fa-sign-out" aria-hidden="true" style="margin-left:-17px; padding-right:10px"></i>
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </nav>
@endif

<!-- Header -->
<header id="top" class="header">
    <div class="text-vertical-center">
        @yield('content')
    </div>
</header>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js"></script>
<script src="https://cdn.jsdelivr.net/sweetalert2/6.4.2/sweetalert2.min.js"></script>
<script src="{{ asset('vendor/xyrotech/js/sun.js') }}"></script>

@yield('custom_scripts')

</body>

</html>
