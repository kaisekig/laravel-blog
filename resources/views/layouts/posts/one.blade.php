<x-base>
    <x-user.user-navigation>
    </x-user.user-navigation>

    <div class="content-wrapp">
        <div class="post">
            <div class="post-content">
                <h1> {{ $post->title }} </h1>
                <p> {{ $post->body }} </p>
            </div>

            @foreach ($comments as $comment)
            <div class="post-comments">
                <p class="cmnt">{{ $comment->body }}</p>
                <p class="user"><i class="fa-solid fa-user fa"></i> {{ $comment->username }}</p>
            </div>
            @endforeach

            <div class="add-comment">
                <form class="normal" method="POST" action="/user/dashboard/posts/{{ $post->post_id }}/comments/add">
                    @csrf
                    
                    <textarea name="body" rows="10" required>Comment</textarea>
                    <button type="submit">Reply</button>
                </form>
            </div>
        </div>
    </div>
</x-base>