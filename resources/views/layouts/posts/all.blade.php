<x-base>
    <x-user.user-navigation>
    </x-user.user-navigation>

    <div class="content-wrapp">
        @foreach ($posts as $post)
            <div class="post m">
                <h1>{{ $post->title }}</h1>
                <p class="sm-m"> {{  $post->body }}</p>
                
                <div class="com-sec">
                    <a href="/user/dashboard/posts/{{ $post->post_id }}/comments">
                        <i class="fa-regular fa-comments fa-xl"></i>
                        @if ($post->comments_count > 0)
                        {{$post->comments_count}}
                        @endif
                    </a>
                </div>
                
                <div class="user">
                    <i class="fa-solid fa-user fa-xl"></i>
                    {{$post->username}}
                </div>
                
            </div>
        @endforeach
    </div>

</x-base>