<h1>Hellow {{$user->username}}</h1>

<div>
    <h2>You create {{ $post->tittle }}</h2>
    <p>{{ $post->body }}</p>


    <img src="{{ $message->embed('storage/'. $post->image) }}" alt="">
</div>