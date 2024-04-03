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
          @if(Auth::user()->usertype == 'Loan Officer' && Auth::user()->role == 'None')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
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
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Loans
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(Auth::user()->category == 'Individual')
                
                <li class="nav-item">
                  <a href="/apply/ind/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Individual Loan</p>
                  </a>
                </li>
                @elseif(Auth::user()->category == 'Group')
                <li class="nav-item">
                  <a href="/apply/grp" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Group Loan</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
            <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>Reports
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/apply/report/loan/payout/" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Loan Payouts
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/apply/report/loan/outstanding/" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Loan Outstandings
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/apply/report/loan/overdue/" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Loan Overdue
                        </p>
                      </a>
                    </li>
                  </ul>
            </li>
          @elseif(Auth::user()->usertype == 'Loan Officer' && Auth::user()->role == 'Supervisor')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
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
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Loans
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(Auth::user()->category == 'Individual')
                <li class="nav-item">
                  <a href="/apply/ind/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Individual Loan</p>
                  </a>
                </li>
                @elseif(Auth::user()->category == 'Group')
                <li class="nav-item">
                  <a href="/apply/grp" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Group Loan</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
            
            <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>Reports
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/apply/report/loan/payout/" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Loan Payouts
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/apply/report/loan/outstanding/" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Loan Outstandings
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/apply/report/loan/overdue/" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Loan Overdue
                        </p>
                      </a>
                    </li>
                    <!-- <li class="nav-item">
                      <a href="/apply/report/loan/recovery/" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Loan Recovery
                        </p>
                      </a>
                    </li> -->
                  </ul>
                </li>
            <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>
                     Settings
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/apply/settings/groups" class="nav-link">
                          <i class="fas fa-angle-right nav-icon"></i>
                          <p>Loan Groups</p>
                        </a>
                    </li>
                  </ul>
                </li>
          @elseif(Auth::user()->usertype == 'Teller')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Accounts
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/accounts/applications" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Account Application</p>
                  </a>
                </li>
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
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Loans
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/ind/teller/" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Individual Loan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp/teller/" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Group Loan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/loan/repayment" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Loan Repayment</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="/apply/teller/transaction/" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>Transactions</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Reports
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/report/loan_disbursements/" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Loan Disbursements</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/loan_recovery" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Loan Recovery</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/cashbook" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cashbook</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/report/balance_sheet" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Balance Sheet</p>
                  </a>
                </li>  
              </ul>
            </li>
          @elseif(Auth::user()->usertype == 'Manager')
            <li class="nav-item">
              <a href="/apply/admin/accounts" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Accounts
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Loans
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="apply/ind/" class="nav-link">
                    <i class="fas fa-angle-right left"></i>
                    <p>Individual Loans    
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/grp/" class="nav-link">
                    <i class="fas fa-angle-right left"></i>
                    <p>Group Loans      
                    </p>
                  </a>
                </li>
                
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Reports
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/report/collections" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Loans
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">                    <li class="nav-item">
                      <a href="/apply/report/loan_disbursements" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Loan Disbursements
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/apply/report/loan_recovery" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Loan Recovery
                        </p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Teller
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/apply/report/cash_outflow" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cash Outflows</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/apply/report/cash_inflow" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cash Inflows</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/apply/report/cashbook" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cashbook</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/apply/report/balance_sheet" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Balance Sheet</p>
                      </a>
                    </li>  
                  </ul>
                </li>
              </ul>
            </li>
            <!-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bars"></i>
                <p>
                  Analysis
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/apply/analysis/loan" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                        <p>Loan Performance</p>
                  </a>
                </li>
              </ul>
            </li> -->
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
                  <a href="/apply/settings/groups" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Loan Groups</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/apply/settings/users" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>System Users</p>
                  </a>
                </li>
              </ul>
            </li>
          @elseif(Auth::user()->usertype == 'admin')
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