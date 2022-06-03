<nav>
    <div class="main-nav">
        <h1 class="main-heading"><a href="/user/dashboard">Blog</a></h1>
        <div class="nav-link">
        
            <form class="inline" method="POST" action="/user/dashboard/search" onsubmit="false">
                @csrf
                <input id="search" type="text" name="search" placeholder="Search" required>
                
            </form>
            
            <a class="nav" href="/user/dashboard/posts">All posts</a>
            <a class="nav" href="/user/dashboard/logout">Logout</a>
        </div>
    </div>
</nav>