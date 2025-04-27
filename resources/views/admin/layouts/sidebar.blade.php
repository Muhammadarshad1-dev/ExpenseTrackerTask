<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.dashboard')}}">
                            <i class="ri-dashboard-line me-2"></i>Dashboard
                        </a>
                    </li>


                    {{-- Add New Category --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button">
                            <i class="ri-apps-2-line me-2"></i>Category<div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="{{route('category.index')}}" class="dropdown-item">Add New Category</a>
                        </div>
                    </li>


                    {{-- Add New Expenses --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button">
                            <i class="ri-apps-2-line me-2"></i>Expenses<div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="{{route('expense.index')}}" class="dropdown-item">Add New Expense</a>
                        </div>
                    </li>


                    {{-- Expense Monthly Report --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button">
                            <i class="ri-apps-2-line me-2"></i>Reports<div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="{{route('expense.monthlyReport')}}" class="dropdown-item">Monthly Reports</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
