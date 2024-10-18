<x-layout>

<h1 class="mb-4">Pleae Verify your email through the email we've sent you.</h1>

<p>Didn't get the email?</p>

<form action="{{ route('verification.send') }}" method="POST">
    @csrf

    <button class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 
    focus:outline-none focus:ring-2
     focus:ring-indigo-500 focus:ring-offset-2">Send again</button>

</form>



</x-layout>