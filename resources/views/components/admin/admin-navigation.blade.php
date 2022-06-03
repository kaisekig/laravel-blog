<nav>
    <div class="main-nav">
        <h1 class="main-heading"><a href="/admin/dashboard">Blog</a></h1>
        <div class="nav-link">
            @if ($role == "super")
                <a class="nav" href="/admin/dashboard/register">Create admin</a>
            @endif
            <a class="nav" href="/admin/dashboard/logout">Logout</a>
        </div>
    </div>
</nav>