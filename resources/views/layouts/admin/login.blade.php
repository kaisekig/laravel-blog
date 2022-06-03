<x-base>
    <nav>
        <div class="main-nav">
            <h1 class="main-heading"><a href="/">Blog</a></h1>
        </div>
    </nav>

    <section>
        <form method="POST" action="/admin/login">
            @csrf 

            <x-form.login>
            </x-form.login>
        </form>
    </section>

    @if (session()->has("error"))
        <div class="alert alert-danger">
            {{ session()->get("error") }}
        </div>
    @endif
</x-base>