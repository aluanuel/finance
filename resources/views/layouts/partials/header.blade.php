  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/home" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- settings -->
      <li class="nav-item">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-cog" title="Settings"></i>
          <span class="hidden-xs">Settings</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Settings</span>
          <div class="dropdown-divider"></div>
          <a href="/apply/settings/users" class="dropdown-item">
            <i class="fas fa-angle-right"></i>Users
          </a>
          <div class="dropdown-divider"></div>
          <a href="/apply/settings/branches/" class="dropdown-item">
            <i class="fas fa-angle-right"></i>Branches
          </a>
          <div class="dropdown-divider"></div>
          <a href="/apply/settings/loans/" class="dropdown-item">
            <i class="fas fa-angle-right"></i>Loans
          </a>
          <div class="dropdown-divider"></div>
          <a href="/apply/settings/loan-groups/" class="dropdown-item">
            <i class="fas fa-angle-right"></i>Loan groups
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-angle-right"></i>System configuration
          </a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell text-warning" title="Notifications"></i>
          <span class="hidden-xs">Notifications</span>

        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 New loan applications
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 2 Loans to assess
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 1 Loan to approve
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="https://codestoreinvestments.com" target="blank">
          <i class="fas fa-question"></i>
          <span class="hidden-xs">Help</span>
        </a>
      </li> -->
      <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link"
              onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off nav-icon text-danger" title="Sign out"></i>
                <span class="hidden-xs">Sign out</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
    </ul>
  </nav>
  <!-- /.navbar -->