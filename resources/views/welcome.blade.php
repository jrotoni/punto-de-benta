<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Punto de Benta</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
       <style>
           img[src*="https://cdn.rawgit.com/000webhost/logo/e9bd13f7/footer-powered-by-000webhost-white2.png"] {
            display: none;
        }
        
        @media(max-width: 767px) {
            .navbar-collapse > .navbar-right {
                display: block;
            }

            .navbar-collapse {
                background-color: #2ab27a;
            }

            .navbar-default {
                z-index: 999;
            }
        }  
         
        html {
            height: 100%;
        }
        body {
            background-color: #570063;
            color: #9aaebc;
            height: 100vh;
            display: flex;
            flex-direction: column;
       }
       .container {
           display: block;
           flex: 1 0 auto;
       }
       .icon-bar {
           background-color: white !important;
       }
        .navbar-default {
            background-color: transparent;
            border-color: transparent;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }

        .navbar {
            margin-top: 10px;
        }

        ul {
            display: flex;
            align-items: center;
        }

        ul > li > a {
            color: #ffcd81 !important;
        }

        ul > li > a:hover {
            color: #fff !important;
        }

        @media only screen and (min-width: 635px) {
            .row {
                padding: 50px 0 !important;
                
            }
            
        }

        @media only screen and (min-width: 992px) {
            .vcenter {
            display: flex;
            align-items: center;
            }
        }


        
        
       </style>
    </head>
    <body>
        
        <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" style="background-color: #ff652f;" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="font-family: 'Pacifico', cursive; color: #ffcd81; font-size: 3rem; margin-left: 0;" href="{{ url('/') }}">.dBenta</a>
      {{-- <img class="img-responsive" width="125" src="{{ asset('images/Punto-de-Benta.png') }}" alt="Punto de Benta"> --}}
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        @if (Route::has('login'))
                    <li><a href="#">Features</a></li>
                    <li><a href="#">About</a></li>
                    @auth
                        <li><a href="{{ url('/home') }}"><button type="button" class="btn btn-warning" style="background-color: #ff652f;">Home</button></a></li>
                    @else
                        <li><a href="{{ route('login') }}"><button type="button" class="btn btn-warning" style="background-color: #ff652f;">Login</button></a></li>
                    @endauth
            @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
                <div class="row vcenter">
                    <div class="col-lg-4 col-md-12 text-center">
                            <h1 style="font-family: 'Pacifico', cursive; color: #ffbd58; font-size: 9rem; margin-bottom:30px;">Punto de Benta</h1> 
                        <h3 style="margin-bottom:50px;">An online Point of Sale System build from Laravel framework</h3>                       
                    @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}"><button style="margin-bottom:50px;" type="button" class="btn btn-success btn-lg center-block">Record your sales now!</button></a>
                    @else
                        <a href="{{ route('register') }}"><button style="margin-bottom:50px;" type="button" class="btn btn-success btn-lg center-block">Signup - It's free!</button></a>
                    @endauth
                    @endif
                    </div>
                    <div class="col-lg-7 col-lg-offset-1 col-md-12" >
                        <img class="img-responsive" src="{{ asset('images/puntodebenta.png') }}" alt="Punto de Benta">
                    </div>
                </div>

            </div>
                <footer>
                    <p>Copyright © 2018 by Punto de Benta. Web design by <a href="https://jrotoni.github.io" target="_blank">jrotoni.</a></p>
                </footer>
        <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    </body>
</html>
