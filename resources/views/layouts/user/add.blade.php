@yield('layouts.user.dashboard')

<article class="add-post">
    <h1>Make fabulous post here!</h1>

    <form class="normal" method="POST" action="/user/dashboard/posts/add">
        @csrf

        <label for="title">Title</label>
        <input type="text" name="title" required>

        <label for="body">Body</label>
        <textarea rows="20" cols="50" name="body" required></textarea>

        <label for="category">Category</label>
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->category_id }}">
                    {{ $category->title }}
                </option>
            @endforeach
        </select>

        <button type="submit">Add</button>
    </form>
</article>