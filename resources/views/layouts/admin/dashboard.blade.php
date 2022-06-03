<x-base>
    <x-admin.admin-navigation :role="$role">
    </x-admin.admin-navigation>

    <div class="col">
        <article>
            @include('layouts.admin.categories')
        </article>
    </div>
    
    <x-categories.category>
    </x-categories.category>

</x-base>