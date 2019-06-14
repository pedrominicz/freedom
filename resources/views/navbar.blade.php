<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}"> Freedom </a>

    <button class="navbar-toggler mb-2 mb-sm-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="text-align: center;">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto" style="float: none;">

        <li class="nav-item">
          <form method="GET" action="/s" class="form-inline">
            <div class="input-group mx-auto">
              <input id="query" name="q" minlength="3" maxlength="20" class="form-control" type="search" value="{{ request()->input('q') }}" placeholder="Search">
              <div class="input-group-append">
                <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </li>

        <li class="nav-item inactive my-auto">
          <a class="nav-link" href="/about">About</a>
        </li>

      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest

          <li class="nav-item active">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>

          @if (Route::has('register'))
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
          @endif

          <!-- User Already Logged In -->
        @else
          <li class="nav-item active">
            <a class="nav-link" href="/favorites"> Favorites </a>
          </li>

          <li class="nav-item active dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
              @if(Auth::user()->is_admin == true)
                <a class="dropdown-item" href="/a"> Add Book </a>
              @endif

              <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>

        @endguest

      </ul>
    </div>
  </div>
</nav>
