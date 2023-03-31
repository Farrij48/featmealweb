<nav class="mt-2">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item ">
            <a href="#" class="nav-link">
                <i class='bx bxs-home'></i>
                <p>
                    Master
                    <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class='bx bx-radio-circle'></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class='bx bx-radio-circle'></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index3.html" class="nav-link">
                        <i class='bx bx-radio-circle'></i>
                        <p>Dashboard v3</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
                <i class='bx bxs-widget'></i>
                <p>
                    Widgets
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>

        <li class="nav-item">
            <form action="{{ route('logout') }}" method="post" id="logout">
                @csrf
                <a class="nav-link" href="#" onclick="document.getElementById('logout').submit()">
                    <i class='bx bx-log-out'></i> Logout
                </a>
            </form>
        </li>
    </ul>
</nav>