<x-base>
    <x-user.user-navigation>
    </x-user.user-navigation>

    <div class="content-wrapp">
        <article class="edit-post">
            <h1>Change content</h1>

            <form class="normal" method="POST" action="/user/dashboard/posts/{{ $post->post_id }}/edit">
                @csrf

                <label for="title">Title</label>
                <input type="text" name="title" value="{{ $post->title }}" required>

                <label for="body">Body</label>
                <textarea rows="20" cols="50" name="body" required>{{ $post->body }}</textarea>

                <label for="category">Category</label>
                <select name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}" @if ($post->category_id == $category->category_id) selected @endif>
                        {{ $category->title }}
                    </option>
                    @endforeach
                </select>

                <button type="submit">Edit</button>
            </form>
        </article>
    </div>


</x-base>