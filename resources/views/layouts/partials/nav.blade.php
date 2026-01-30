 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
      <img src="{{ asset('theme/dist/img/start.png') }}" alt="Company Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/img/'.Auth::user()->photo)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/apply/user/{{Auth::user()->id}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Main Branch
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/settings/koboko-branch" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Main Branch
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/settings/koboko-branch" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Koboko Branch
                    </p>
                  </a>
                </li>
              </ul>
            </li>
          @if(Auth::user()->usertype == 'admin')
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
                  <a href="/apply/settings/users" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>System Users
                    </p>
                  </a>
                </li>
              </ul>
            </li>
          @else
            <!-- <li class="nav-item">
              <a href="/apply/accounts/" class="nav-link">
                <i class="fas fa-user-circle nav-icon"></i>
                <p>Accounts</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>
                  Accounts
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/accounts/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>View Accounts</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-balance-scale"></i>
                <p>
                  Loans
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/ind/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>All loans</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/ind/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Individual loans</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Group loans</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- <li class="nav-item">
              <a href="/apply/loan/repayment" class="nav-link">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Loan Repayment</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-dollar"></i>
                <p>
                  Transactions
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/teller/transaction/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loan disbursement</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/teller/transaction/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loan repayment</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/teller/transaction/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Penalties</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/teller/transaction/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Expenses</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/teller/transaction/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Other Incomes</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Collection Sheets
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/report/disbursements/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Daily collections</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loan-recovery/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Missed repayments</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loans-defaulted" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Past maturity</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Collateral Register
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/report/disbursements/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loan disbursement</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loan-recovery/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loan recovery</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loans-defaulted" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loans defaulted</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loans-fully-settled/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loans fully settled</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bars"></i>
                <p>
                  Reports
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/report/disbursements/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loan disbursement</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loan-recovery/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loan recovery</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loans-defaulted" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loans defaulted</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loans-fully-settled/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loans fully settled</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Accounting
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/report/disbursements/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Cashflow</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loan-recovery/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Profit/Loss</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loans-defaulted" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Balancesheet</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                  System
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/system/backup/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Backup</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/system/restore/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Restore</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/restore/previous/loan/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Restore previous loan</p>
                  </a>
                </li>
              </ul>
            </li>
            

            <!-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Settings
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>
                      Policies
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="/apply/settings/fees/" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Fees
                          </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/apply/settings/rates/" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Rates
                          </p>
                        </a>
                      </li>
                    </ul>
                </li>
                <li class="nav-item">
                  <a href="/apply/settings/loan/groups" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loan groups</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/settings/users" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>System users</p>
                  </a>
                </li>
              </ul>
            </li> -->
          @endif

          <!-- <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link"
              onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off nav-icon"></i>
                <p>Sign out</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li> -->
            <!-- sign-out -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>