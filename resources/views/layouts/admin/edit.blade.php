<x-base>
    <x-admin.admin-navigation :role="$role">
    </x-admin.admin-navigation>

    <article class="art">
        <form method="POST" action="/admin/dashboard/categories/{{ $category->category_id }}/edit">
        @csrf

            <div class="flex-pair">
                <label for="category">Category</label>
                <input type="text" name="title" value="{{ $category->title }}"  required>
            </div>

            <div class="btn">
                <button type="submit">Edit</button>
                <a class="btn-hover" href="/admin/dashboard/categories/{{ $category->category_id }}/delete">Delete</a>
            </div>
        </form>
    </article>
</x-base>