<x-layout>
    <a href="{{ route('dashboard') }}" class="block mb-2 text-xs text-blue-500">&larr; Go back to your Dashboard</a>
    <div class="card">
        <h2 class="font-bold mb-4">Update your post</h2>
        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Post title --}}
            <div class="mb-4">
                <label for="tittle">Post Title</label>
                <input type="text" name="tittle" value="{{ $post->tittle }}" 
                    class="input {{ $errors->has('tittle') ? 'ring-red-500' : '' }}">

                @error('tittle')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea name="body" rows="4" 
                    class="input {{ $errors->has('body') ? 'ring-red-500' : '' }}">{{ $post->body }}</textarea>

                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

           {{--Cover photo--}}
          
           @if ($post->image)
           <label>Current photo</label>
           <div class="h-52 rounded-md mb-1/4 w-full object-cover overflow-hidden">
               <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
           </div>
           @endif
         
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
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 
                focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Update
            </button>
        </form>
    </div>
</x-layout>
