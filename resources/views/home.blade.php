@extends('layouts.app')

@section('content')

<main>
    <p>Join Room</p>
    <form class="w-full mx-auto" method="POST" action="">
        <div class="flex flex-col mx-auto">
            <label for="room-id">Enter Room ID</label>
            <input type="text">
        </div>
    </form>
</main>
    
@endsection
