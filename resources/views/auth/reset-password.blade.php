<x-layout>

    <h1 class="text-2xl font-bold mb-6 text-center">Register your password</h1>

    <div class="mx-auto max-w-screen-sm bg-white shadow-md rounded-lg p-8">
        <form action="{{ route('password.update')}}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{$token}}">

            {{-- Email --}}
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    value="{{ old ('email')}}" 
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm sm:text-sm 
                    @error('email') border-red-500 ring-2 ring-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror" 
                    placeholder="Enter your email">
                
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" 
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm sm:text-sm 
                    @error('password') border-red-500 ring-2 ring-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror" 
                    placeholder="Enter your password">
                
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm sm:text-sm 
                    @error('password_confirmation') border-red-500 ring-2 ring-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror" 
                    placeholder="Confirm your password">
                
                @error('password_confirmation')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit" class="w-full
                 bg-indigo-600 text-white py-2 px-4 
                 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 
                 focus:ring-indigo-500 focus:ring-offset-2">Reset Password</button>
            </div>
        </form>
    </div>

</x-layout>
