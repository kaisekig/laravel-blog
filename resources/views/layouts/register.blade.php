<x-base>
    <x-navigation>
    </x-navigation>

    <section>
        <form method="POST" action="/user/register">
            @csrf

            <x-form.register>
            </x-form.register>

        </form>
    </section>

    @if (session()->has("error"))
        <div class="alert alert-danger">
            {{ session()->get("error") }}
        </div>
    @endif
    
</x-base>