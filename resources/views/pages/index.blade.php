<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>IUT Movies</title>
  <link rel="shortcut icon" href="data/img/logo.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="data/fonts/all.min.css">
  <link rel="stylesheet" href="data/css/style.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>
  <nav class="mainnavbar navbar navbar-expand-md fixed-top">
    <div class="container">
      <!-- Brand -->
      <a class="navbar-brand" href="#"><img src="data/img/logo.png" width="30" alt=""> IUT movie</a>
    
      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <i class="fas fa-bars"></i>
      </button>
    
      <!-- Navbar links -->
      <!-- <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/movies">Movies</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Register</a>
          </li> 
        </ul>
      </div>  -->

      <div class="collapse navbar-collapse container" id="navbarTogglerDemo03">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                      <li class="nav-item"><a class="nav-link" href="/movies">Movies</a></li>

        @if (Route::has('login'))
                    @auth
                      
                    @else
                      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
            @endif  
    </ul>

    
  </div>
@if (Route::has('login'))
        @auth
      <div class="dropdown">
        <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff">
           <img src="{{Cache::get('key')}}" class="mr-3 ml-3" style="width: 35px; height: 35px;">{{ Auth::user()->name }} <san class="caret"></span>
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @if(auth()->user()->type == "admin")

          <div class="dropdown-item">
            <a class="btn fa fa-btn" href="/dashboard">Dashboard</a>
          </div>
          @endif
          <a name="forms">
        <a name="csrf-field">
          <form class="dropdown-item" action="{{ url('/logout') }}" method="POST">
            @csrf
            <!-- @method('POST') -->
            <input type="submit" class=" btn fa fa-btn fa-sign-out" value="Logout">
          </form>
      </a>
    </a>
        </div>
      </div>
        @endauth
  @endif
    </div>
  </nav>

  <div class="overlay"></div>
  <video autoplay muted loop id="myVideo">
    <source src="data/img/main-bg.mp4" type="video/mp4">
  </video>
  <div class="container-fluid main">
    <div class="row">
      <form action="/search" class="main-search" method="POST">
        @csrf
        @method('POST')
        <input type="text" placeholder="Search" name="query" autofocus>
        <button><i class="fas fa-search"></i></button>
      </form>
    </div>
  </div>
</body>
</html>