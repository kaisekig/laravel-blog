@yield('layouts.admin.dashboard')

<div class="categories">
    @foreach ($categories as $category)
        <div class="category">
            <p><a href="/admin/dashboard/categories/{{ $category->category_id }}/edit">{{ $category->title }}</a><p>
        </div>
    @endforeach
</div>
