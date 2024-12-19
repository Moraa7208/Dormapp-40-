<!-- resources/views/rooms/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Create Room</h1>
    <form action="{{ route('rooms.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Room Name -->
        <div class="flex flex-col">
            <label for="name" class="text-lg font-medium">Room Name</label>
            <input type="text" class="p-2 border border-gray-300 rounded-md" id="name" name="name" required>
        </div>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Create Room</button>
    </form>
</div>
@endsection
