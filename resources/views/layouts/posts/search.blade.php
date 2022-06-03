<x-base>
    <x-user.user-navigation>
    </x-user.user-navigation>

    <div class="content-wrapp">
        <div class="post m">
            @if ($posts != null)
                @if (count($posts) === 0)
                    <p class="lg">Results not found...</p>
                @elseif (count($posts) > 0)
                    @foreach ($posts as $post)
                        <h2 class="lg"><a href="/user/dashboard/posts/{{$post->post_id}}/comments">{{ $post->title }}</a></h2>
                    @endforeach
                @endif
            @else 
                <p class="lg">Search again...</p>
            @endif
        </div>
    </div>
</x-base>