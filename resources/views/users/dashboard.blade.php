<x-layout>
    
    <h1 class="title">Welcome {{ auth()->user()->username }} you have {{ $posts->total()}} posts</h1>

    {{--Create Post Form--}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create a new post</h2>

        {{--Session Message--}}
        @if (session()->has('success'))
                <x-flashMsg msg="{{ session('success') }}" />    
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />    
        @endif

        <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Post title --}}
            <div class="mb-4">
                <label for="tittle">Post Title</label>
                <input type="text" name="tittle" value="{{ old('tittle') }}" 
                    class="input {{ $errors->has('tittle') ? 'ring-red-500' : '' }}">

                @error('tittle')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea name="body" rows="4" 
                    class="input {{ $errors->has('body') ? 'ring-red-500' : '' }}">{{ old('body') }}</textarea>

                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror

            </div>
            
                {{--Image --}}
                <div class="mb-4">
                    <label for="image">Cover Photo</label>
                    <input type="file" name="image" id="image"
                        class="input {{ $errors->has('image') ? 'ring-red-500' : '' }}">
                    @error('image')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                

            <button type="submit" 
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Create
            </button>
        </form>
    </div>

    {{--User Post--}}
    <h2 class="font-bold mb-4">Your Latest Posts</h2>

    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
       
        <x-postCard :post="$post">
            {{--Update Post--}}
            
            <a href="{{ route('posts.edit', $post)}}" class="bg-green-500 text-white px-2 py-1 text-xs rounded-md" >Update</a>

            {{--Delete posts--}}
            <form action="{{route('posts.destroy', $post)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
            </form>
        
        </x-postCard>
        
        @endforeach
        </div>
        <div>
            {{$posts->links()}}
        </div>
</x-layout>
