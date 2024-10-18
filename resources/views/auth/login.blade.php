<x-layout>
    <h1 class="text-2xl font-bold mb-6 text-center">Login to Your Account</h1>

       {{--Session Message--}}
       @if (session()->has('status'))
       <x-flashMsg msg="{{ session('status') }}" />        
        @endif

    <div class="mx-auto max-w-screen-sm bg-white shadow-md rounded-lg p-8">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            {{-- Email Input --}}
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" 
                    value="{{ old('email') }}" 
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm sm:text-sm 
                    @error('email') border-red-500 ring-2 ring-red-500 focus:ring-red-500 focus:border-red-500 
                    @else border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror" 
                    placeholder="Enter your email">
                
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Input --}}
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" 
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm sm:text-sm 
                    @error('password') border-red-500 ring-2 ring-red-500 focus:ring-red-500 focus:border-red-500 
                    @else border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror" 
                    placeholder="Enter your password">
                
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me Checkbox --}}
            <div class="mb-4 flex justify-between items-center">
                <div >
                    <input type="checkbox" name="remember" id="remember" 
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Remember Me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Forgot Your Password?</a>
            </div>

            @error('failed')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- Submit Button --}}
            <div>
                <button type="submit" 
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Login
                </button>
            </div>
        </form>
    </div>
</x-layout>
