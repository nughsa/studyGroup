<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('dashboard') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('article') }}">
                    <i class="bi bi-journal-text me-2"></i>
                    Postingan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('categories') }}">
                    <i class="bi bi-collection me-2"></i>
                    Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="bar-chart-2"></span>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
