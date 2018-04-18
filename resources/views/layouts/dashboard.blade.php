<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Punto de Benta') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:700, 600,500,400,300' rel='stylesheet' type='text/css'>
    @yield('style')

    {{-- fontawesome --}}
    {{-- <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</head>
<body>
		<div class="header">
			<div class="logo">
				<!-- <i class="fa fa-tachometer"></i> -->
				<a style="font-family: 'Pacifico', cursive; color: #ffcd81; text-decoration: none;" href="{{ url('/') }}">Punto de Benta</a>
			</div>
			<a href="#" class="nav-trigger"><span></span></a>
		</div>
		<div class="side-nav">
			<div class="logo">
			</div>
			<nav>
				<ul id="onmobile">
					<li id="logocontainer">
						<a style="font-family: 'Pacifico', cursive; color: #ffcd81;" href="{{ url('/') }}" id="textlogo">.dBenta</a>
					</li>
					@yield('sidebar')
					<li>
						<a href="{{ url('/home') }}">
							<span><i class="fa fa-arrow-left"></i></span>
							<span>Back</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="main-content">
			<div class="main-title">
				@yield('panel-title')
				
			</div>
			<div class="main">
                <div class="row" style="margin: 0; margin-top: 15px;">
                @yield('content')
				{{-- <div class="widget">
					<div class="title">Number of views</div>
					<div class="chart"></div>
				</div>
				<div class="widget">
					<div class="title">Number of likes</div>
					<div class="chart"></div>
				</div>
				<div class="widget">
					<div class="title">Number of comments</div>
					<div class="chart"></div>
                </div> --}}
                </div>
			</div>
		</div>  
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
	{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @yield('scripts')
</body>
</html>
