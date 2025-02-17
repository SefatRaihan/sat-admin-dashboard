<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Navigation</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">

            <ul class="nav nav-sidebar" data-nav-type="accordion">
            
                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fas fa-key"></i> <span>Users Management</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                        @if( auth()->user()->role_id == 1)
                        <li class="nav-item"><a href="{{ route('types.index') }}" title="Types" class="nav-link legitRipple"><i class="fas fa-user-tag"></i> <span>Type</span></a></li>
                        <li class="nav-item"><a href="{{ route('structures.index') }}" title="Structures" class="nav-link legitRipple"><i class="fas fa-street-view"></i> <span>Structures</span></a></li>
                        <li class="nav-item"><a href="{{ route('roles.index') }}" title="Roles" class="nav-link legitRipple"><i class="fas fa-user-tag"></i> <span>Roles</span></a></li>
                        @endif
                        <li class="nav-item"><a href="{{ route('users.index') }}" title="Users" class="nav-link legitRipple"><i class="fas fa-keyboard"></i> <span>Users</span></a></li>
                    </ul>
                </li>

                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs"> <i class="fas fa-wallet"></i>  Financial</div></li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fas fa-file-invoice"></i> <span>Accounting Cofiguration</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Accounting Cofiguration" style="display: none;">
                        <li class="nav-item"><a href="/fiscalyears" title="Fiscal Year" class="nav-link legitRipple"><i class="far fa-calendar-alt"></i> <span>Fiscal Year</span></a></li>
                        <li class="nav-item"><a href="/currencies" title="Currency" class="nav-link legitRipple"><i class="fas fa-money-bill-alt"></i> <span>Currency</span></a></li>
                        <li class="nav-item"><a href="/exchangerates" title="Exchange Rate" class="nav-link legitRipple"><i class="fas fa-dollar-sign"></i> <span>Exchange Rate</span></a></li>
                        <li class="nav-item"><a href="/accounttypes" title="Account Types" class="nav-link legitRipple"><i class="fas fa-file-invoice-dollar"></i> <span>Account Types</span></a></li>
                        <li class="nav-item"><a href="/chartofaccounts" title="Chart Of Accounts" class="nav-link legitRipple"><i class="far fa-chart-bar"></i> <span>Chart Of Accounts</span></a></li>
                        <li class="nav-item"><a href="/ledgers" title="Ledger" class="nav-link legitRipple"><i class="fas fa-table"></i> <span>Ledger</span></a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fas fa-journal-whills"></i> <span>Transaction</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Transaction" style="display: none;">
                        <li class="nav-item"><a href="/transactions" title="Payment" class="nav-link legitRipple"><i class="fas fa-list"></i> <span>List</span></a></li>
                        <li class="nav-item"><a href="/transaction/receipt" title="Receipt" class="nav-link legitRipple"><i class="fas fa-receipt"></i> <span>Receipt</span></a></li>
                        <li class="nav-item"><a href="/transaction/payment" title="Payment" class="nav-link legitRipple"><i class="fas fa-money-check-alt"></i> <span>Payment</span></a></li>
                        <li class="nav-item"><a href="/transaction/journal" title="Journal Posting" class="nav-link legitRipple"><i class="fas fa-caret-square-down"></i> <span>Journal</span></a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="far fa-file-alt"></i> <span>Reports</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Reports" style="display: none;">
                        <li class="nav-item"><a href="/balancesheets" title="Balance Sheet" class="nav-link legitRipple"><i class="fas fa-money-check-alt"></i> <span>Balance Sheet</span></a></li>
                        <li class="nav-item"><a href="/incomestatements" title="Profit &amp; Loss" class="nav-link legitRipple"><i class="fas fa-percentage"></i> <span>Profit &amp; Loss</span></a></li>
                        <li class="nav-item"><a href="/trialbalreports" title="Trial Balance" class="nav-link legitRipple"><i class="far fa-file-alt"></i> <span>Trial Balance</span></a></li>
                        <li class="nav-item"><a href="/ledgerreports" title="Ledger Report" class="nav-link legitRipple"><i class="fas fa-file-signature"></i> <span>Ledger Report</span></a></li>
                        <li class="nav-item"><a href="/transaction/reports" title="Journal Report" class="nav-link legitRipple"><i class="fas fa-file-invoice"></i> <span>Journal Report</span></a></li>
                    </ul>
                </li>

                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs"> <i class="fas fa-user-tie"></i>  HRM</div></li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fas fa-users-cog"></i> <span>HRM Configuration</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="HRM Configuration" style="display: none;">
                        <li class="nav-item"><a href="/countries" title="Countries" class="nav-link legitRipple"><i class="fas fa-flag"></i> <span>Countries</span></a></li>
                        <li class="nav-item"><a href="/religions" title="Religions" class="nav-link legitRipple"><i class="fas fa-quran"></i> <span>Religions</span></a></li>
                        <li class="nav-item"><a href="/nationalities" title="Nationalities" class="nav-link legitRipple"><i class="fas fa-globe"></i> <span>Nationalities</span></a></li>
                        <li class="nav-item"><a href="/offices" title="Offices" class="nav-link legitRipple"><i class="fas fa-briefcase"></i> <span>Offices</span></a></li>
                        <li class="nav-item"><a href="/designations" title="Designations" class="nav-link legitRipple"><i class="fas fa-user-tag"></i> <span>Designations</span></a></li>
                        <li class="nav-item"><a href="/employmenttypes" title="Employment Type" class="nav-link legitRipple"><i class="fas fa-user-astronaut"></i> <span>Employment Type</span></a></li>
                        <li class="nav-item"><a href="/workschedules" title="Work Schedule" class="nav-link legitRipple"><i class="fas fa-clipboard-list"></i> <span>Work Schedule</span></a></li>
                        <li class="nav-item"><a href="/leavepolicies" title="Leave Policy" class="nav-link legitRipple"><i class="fas fa-pencil-ruler"></i> <span>Leave Policy</span></a></li>
                        <li class="nav-item"><a href="/holidays" title="Holidays" class="nav-link legitRipple"><i class="fab fa-hire-a-helper"></i> <span>Holidays</span></a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/employees" title="Employee" class="nav-link legitRipple">
                        <i class="fas fa-id-card-alt"></i>
                        <span>
                            Employee
                        </span>
                    </a>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="far fa-money-bill-alt"></i> <span>Payroll</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Payroll" style="display: none;">
                        <li class="nav-item"><a href="/salary-grades" title="Salary Grades" class="nav-link legitRipple"><i class="fas fa-file-invoice-dollar"></i> <span>Salary Grades</span></a></li>
                        <li class="nav-item"><a href="/salary-components" title="Salary component" class="nav-link legitRipple"><i class="fas fa-hand-holding-usd"></i> <span>Salary component</span></a></li>
                        <li class="nav-item"><a href="/salary-structures" title="Salary structure" class="nav-link legitRipple"><i class="fas fa-funnel-dollar"></i> <span>Salary structure</span></a></li>
                        <li class="nav-item"><a href="/employee-salary-structures" title="Employee Salaries" class="nav-link legitRipple"><i class="fas fa-money-bill-alt"></i> <span>Employee Salaries</span></a></li>
                        <li class="nav-item"><a href="/salaries" title="Salaries" class="nav-link legitRipple"><i class="far fa-credit-card"></i> <span>Salaries</span></a></li>
                        <li class="nav-item"><a href="/salary-list" title="Salary List" class="nav-link legitRipple"><i class="fas fa-list"></i> <span>Salary List</span></a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fas fa-sign-out-alt"></i> <span>Leaves</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Leaves" style="display: none;">
                        <li class="nav-item"><a href="/my-leaves" title="My Leaves" class="nav-link legitRipple"><i class="fas fa-sign-out-alt"></i> <span>My Leaves</span></a></li>
                        <li class="nav-item"><a href="/my-team-leaves" title="My Team Leaves" class="nav-link legitRipple"><i class="fas fa-users"></i> <span>My Team Leaves</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->
    </div>
    <!-- /sidebar content -->

</div>
