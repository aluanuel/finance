 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
      <img src="{{ asset('theme/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('theme/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(Auth::user()->usertype == 'loanOfficer')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Individual Loan
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/ind" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Application</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/ind/assess" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assessment</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/admin/processed" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Processed Loan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Clients
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Group Loan
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/grp" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Application
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp/assess" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assessment
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp/processed" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Processed Loan
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp/list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Loan Groups
                    </p>
                  </a>
                </li>
              </ul>
            </li>
          @elseif(Auth::user()->usertype == 'teller')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Individual Loan (Sales)
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/view/ind" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Applications</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/view" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Processed Loan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/trans" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Loan Payments</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/trans/record" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Record</p>
                  </a>
                </li>

              </ul>
            </li>
          @elseif(Auth::user()->usertype == 'manager')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Individual Loan
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/view" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Loan Application</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/admin/ind/assess" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Loan Assessment
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/admin/processed" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Processed Loan</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Reports
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/report/collections" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Collections</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/expenses" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Expenses</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/incomes" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Incomes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/sales" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sales</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/ind/assess" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cashbook</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Balance Sheet</p>
                  </a>
                </li>
                
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Settings
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/settings/interest" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Interest on Loans
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/settings/groups" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Loan Groups
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/settings/users" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>System Users
                    </p>
                  </a>
                </li>
              </ul>
            </li>
          @elseif(Auth::user()->usertype == 'admin')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Individual Loan
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/ind" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Application</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/ind/assess" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assessment</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/admin/processed" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Processed Loan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Clients
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Group Loan
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/grp" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Application
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp/assess" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assessment
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp/processed" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Processed Loan
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp/list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Loan Groups
                    </p>
                  </a>
                </li>
              </ul>
            </li>
          @endif
            <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link"
              onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off nav-icon"></i>
                <p>Sign out</p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>