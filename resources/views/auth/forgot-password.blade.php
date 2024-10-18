<x-layout>

    <h1 class="text-2xl font-bold mb-6 text-center">Request Password Reset Email</h1>

    
        {{--Session Message--}}
        @if (session()->has('status'))
                <x-flashMsg msg="{{ session('status') }}" />        
        @endif

    <div class="mx-auto max-w-screen-sm bg-white shadow-md rounded-lg p-8">
        <form action="{{ route('password.request') }}" method="POST">
            @csrf

            {{-- Email --}}
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    value="{{ old('email') }}" 
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm sm:text-sm 
                    @error('email') border-red-500 ring-2 ring-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror" 
                    placeholder="Enter your email">
                
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit" class="w-full bg-indigo-600 text-white 
                py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 
                focus:ring-indigo-500 focus:ring-offset-2">Submit</button>
            </div>
        </form>
    </div>

</x-layout>
