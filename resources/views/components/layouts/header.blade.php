<link href="{{ asset('css/styles/layouts/header.css') }}" rel="stylesheet" type="text/css" />
<header class="main-header">
  <a href="{{ url('/') }}" class="logo">
    <span class="logo-mini"><b>J</b>B</span>
    <span class="logo-lg">Jai Bangla</span>
  </a>
  <nav class="navbar navbar-static-top custom-nav" role="navigation">
  <a href="#" class="sidebar-toggle" id="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav nav-pills ">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="{{ asset('/bower_components/AdminLTE/dist/img/user2-160x160.jpg') }}" class="user-image"
              alt="User Image">
            <span class="d-none d-sm-inline">
              {{ Auth::user()->username }}
            </span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="dropdown-item text-center">
              <img src="{{ asset('/bower_components/AdminLTE/dist/img/user2-160x160.jpg') }}"
                class="img-fluid rounded-circle" alt="User Image">
              <p>Hello {{ Auth::user()->username }}</p>
            </li>
            <li class="dropdown-item">
              @if (Auth::guest())
          <div class="d-flex justify-content-start">
          <a href="{{ route('login') }}" class="btn btn-default">Login</a>
          </div>
        @else

        <div class="d-flex justify-content-end">
        <a class="btn btn-info me-2" href="{{ route('get-user-manual') }}">Download User Manual</a>
        <a class="btn btn-danger" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </div>
      @endif
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  {{ csrf_field() }}
</form>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const body = document.body;

    // Check if sidebar is collapsed, if not, remove the 'sidebar-collapse' class
    if (body.classList.contains("sidebar-collapse")) {
      body.classList.remove("sidebar-collapse");
    }

    sidebarToggle.addEventListener("click", function(e) {
      e.preventDefault();
      body.classList.toggle("sidebar-collapse");
    });
  });
</script>
