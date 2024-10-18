<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
    <header class="bg-slate-800 shadow-lg">
        <nav class="flex items-center gap-4 p-4">
           <a href="{{ route('posts.index') }}" class="nav-link text-white">Home</a>
           
           @auth
               <div class="relative grid place-items-center" x-data="{ open: false }">
                   {{-- Drop Down menu button --}}
                   <button type="button" class="round-btn" @click="open = !open">
                       <img src="https://picsum.photos/200">
                   </button>

                   {{-- Drop down menu --}}
                   <div x-show="open" 
                        @click.away="open = false"
                        x-transition
                        class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light">
                       <p class="p-2">{{ auth()->user()->username }}</p>
                       <a href="{{ route('dashboard') }}" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Dashboard</a>
                       <form method="POST" action="{{ route('logout') }}" class="block hover:bg-slate-100 pl-4 pr-8 py-2">
                           @csrf
                           <button type="submit">Logout</button>
                       </form>
                   </div>
               </div>
           @endauth

           @guest
               <div class="flex gap-4">
                   <a href="{{ route('login') }}" class="nav-link text-white">Login</a>
                   <a href="{{ route('register') }}" class="nav-link text-white">Register</a>
               </div>
           @endguest
        </nav>
    </header>

    <main class="py-8 px-4 mx-auto max-w-screen-lg">
        {{ $slot }}
    </main>

</body>
</html>
