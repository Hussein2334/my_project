
    @props(['post', 'full' => false])
<div class="card">
    {{--Cover photo--}}
    <div class="h-52 rounded-md mb-4 w-full object-cover overflow-hidden">
        @if ($post->image)
        <img src="{{asset('storage/' . $post->image)}}" alt="">
        @else
        <img src="{{asset('storage/posts_image/default.jpg')}}" alt="">  
        @endif  
    </div>
    
    {{-- Title --}}
    <h2 class="font-bold text-xl">{{ $post->tittle }}</h2> 

    {{-- Author and Date --}}
    <div class="text-xs font-light mb-4">
        <span>Post {{ $post->created_at->diffForHumans() }} by</span>
        <a href="{{ route('posts.user', $post->user) }}" class="text-blue-500 font-medium">{{ $post->user->username }}</a>
    </div>

    {{-- Body --}}
    @if ($full)
        <div>
            <span>{{ $post->body }}</span> {{-- Display full body if $full is true --}}
        </div>
    @else
        <div class="text-sm">
            <span>{{ Str::words($post->body, 15) }}</span> {{-- Shortened version --}}
            <a href="{{ route('posts.show', $post) }}" class="text-blue-500 ml-2">Read more &rarr;</a>
        </div>
    @endif

    <div class="flex items-center justify-end gap-4 mt-6">
        {{ $slot }}
    </div>
    
</div>



