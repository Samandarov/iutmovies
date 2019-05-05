@php
  $lk = '';
  if(Route::getCurrentRoute()->uri() != '/movies')
   $lk = '/movies';
@endphp

 <style type="text/css">
 	.nav-link{
 		width: max-content;
 	}
 </style>
   <div class="top-heading">
    <a class="top-link" href="/"><img src="data/img/logo.png" width="40" alt=""> IUT Movies</a> 
  </div>


  <nav class="navbar navbar-expand-sm bg-dark navbar-dark moviesNav">
     <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/"><i class="fas fa-home"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{$lk}}#movies"><i class="fas fa-film"></i> Movies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{$lk}}#series"><i class="fas fa-tv"></i> Series</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{$lk}}#animes"><i class="fas fa-film"></i> Animes</a>
        </li>
      </ul>

      <div class="collapse navbar-collapse container" id="navbarTogglerDemo03">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item">
            <form action="/search" method="POST" class="form-inline ml-auto">
              @csrf
              @method('POST')
          <div class="md-form my-0">
            <input class="form-control" name="query" type="text" placeholder="Search" aria-label="Search">
          </div>
          <button href="#!" class="btn btn-light  btn-md my-0 ml-sm-2" type="submit">Search</button>
        </form>
      </li>
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