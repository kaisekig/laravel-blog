<x-base>
    <x-admin.admin-navigation :role="$role">
    </x-admin.admin-navigation>

    <section>
        <form method="POST" action="/admin/dashboard/register">
            @csrf 

            <x-form.admin-register>
            </x-form.admin-register>
        </form>
    </section>

    @if (session()->has("error"))
        <div class="alert alert-danger">
            {{ session()->get("error") }}
        </div>
    @endif
</x-base>