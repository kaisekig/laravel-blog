<x-base>
    <x-user.user-navigation>
    </x-user.user-navigation>

    <div class="content-wrapp">

        @include("layouts.user.add")

        <div class="grid-container">
            @foreach ($posts as $post)
                <div class="grid-item">
                    <h1><a class="nm styled-link" href="/user/dashboard/posts/{{ $post->post_id }}">
                        {{ $post->title }}
                    </a></h1>
                    <p> {{ $post->body }}  </p>
                    @if ($post->comments_count > 0)
                    <i class="fa-regular fa-comments fa-xl"></i>
                        {{ $post->comments_count }}
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-base>