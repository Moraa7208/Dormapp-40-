<!-- resources/views/rooms/assign-students.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Assign Students to Room</h1>
    <form action="{{ route('rooms.assign-students') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Room Selection -->
        <div class="flex flex-col">
            <label for="room_id" class="text-lg font-medium">Room</label>
            <select class="p-2 border border-gray-300 rounded-md" id="room_id" name="room_id" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Students Selection -->
      <div class="mb-4">
            <label for="user" class="block text-sm font-medium text-gray-700">Select User</label>
            <select name="user_id" id="user" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($students as $students)
                    <option value="{{ $students->id }}">{{ $students->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Assign Students</button>
    </form>
</div>
@endsection
