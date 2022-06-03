<x-base>
    <x-navigation>
    </x-navigation>
    
    <section>
        <form method="POST" action="/user/login">
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