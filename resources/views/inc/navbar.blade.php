<div> 
  <img style="w-100" src="../public/storage/cover_images/Capture.JPG">
</div>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="{{ url('/services')}}" >TO_DO</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="{{ url('/posts')}}" >Blog</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="{{ url('/posts/create')}}">Vytvor prispevok</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="{{ url('/dashboard')}}">Nastenka</a>
                </li>
              </ul>
            </div>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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