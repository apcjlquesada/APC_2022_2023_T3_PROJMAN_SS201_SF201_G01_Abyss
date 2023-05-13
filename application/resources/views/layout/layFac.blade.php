<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TAPM-Faculty') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="bg-image" style="background-image: url('/storage/test.png'); height: 100vh">
  <div id='app'>    
      <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #043877;">
          <div class="container-fluid">
              <a class="navbar-brand fw-bold text-white" href="{{ url('faculty/home') }}" >
                  {{ config('app.name', 'TAPM') }}
              </a>

              <ul class="navbar-nav ms-auto">
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                  </li>
              </ul>
          </div>
      </nav>
  </div>
  <main class="py-20">
      @yield('page-content')
  </main>
</div>
</body>
</html>